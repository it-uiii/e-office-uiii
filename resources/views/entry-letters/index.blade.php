@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                @permission('entry-letter-create')
                    @if (session('user')->position && session('user')->position == 'Pelaksana Sekretariat')
                        <a class="btn btn-primary" href="{{ route('entry-letters.create') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endif
                @endpermission
                <form>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Diterima</th>
                            <th>Pengirim</th>
                            <th>Disposisi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->date_in)) }}</td>
                                <td>{{ $item->sender }}</td>
                                <td>{{ $item->disposition_names->pluck('name')->join(', ') }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{!! $item->display_status !!}</td>
                                <td>
                                    <a class="btn btn-info mb-1" href="#showModal"
                                        data-toggle="modal"
                                        data-url="{{ asset(Storage::url($item->file)) }}"
                                        data-number="{{ $item->number }}"
                                        data-subject="{{ $item->subject }}"
                                        data-date="{{ $item->date }}"
                                        data-sender="{{ $item->sender }}"
                                        data-disposition="{{ $item->disposition_names->pluck('name')->join(', ') }}"
                                        data-description="{{ $item->description }}"
                                        data-status="{{ $item->display_status }}"
                                        data-revisi="{{ $item->revision_description }}"><i class="fas fa-eye"></i>
                                    </a>
                                    @permission('entry-letter-edit')

                                        @if (session('user')->role == 'Admin' && session('user')->position && session('user')->position == 'Pelaksana Sekretariat' && $item->status == 0)
                                            <a class="mb-1 btn btn-warning" href="{{ route('entry-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif

                                        @if(session('user')->position && ((session('user')->position == 'KTU Sekretaris' && ($item->status == 1 || $item->status == 0)) || session('user')->position == 'Rektor'))
                                            <a class="mb-1 btn btn-warning" href="{{ route('entry-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif
                                    @endpermission
                                    @permission('entry-letter-delete')
                                        @if ($item->status == 0)
                                            <form action="{{ route('entry-letters.destroy', $item) }}" method="post"
                                                class="d-inline">
                                                @csrf @method('delete')
                                                <button class="btn btn-danger mb-1"
                                                    onclick="return confirm('Are you sure want delete this data?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endpermission
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data Tidak Tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $data->links('partials.pagination') }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="table-responsive table-hover table-striped">
                            <table class="table table-sm">
                                <tr>
                                    <td width="100px">Nomor Surat</td>
                                    <td width="5px">:</td>
                                    <td id="number"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Perihal</td>
                                    <td width="5px">:</td>
                                    <td id="subject"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Tanggal</td>
                                    <td width="5px">:</td>
                                    <td id="date"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Pengirim</td>
                                    <td width="5px">:</td>
                                    <td id="sender"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Disposisi</td>
                                    <td width="5px">:</td>
                                    <td id="disposition"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Keterangan</td>
                                    <td width="5px">:</td>
                                    <td id="description"></td>
                                </tr>
                                <tr>
                                    <td width="100px">Status</td>
                                    <td width="5px">:</td>
                                    <td id="status"></td>
                                </tr>
                                <tr id="row-revisi" class="d-none">
                                    <td width="100px">Revisi</td>
                                    <td width="5px">:</td>
                                    <td id="revisi"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <iframe id="embed-show" src="" frameborder="0" width="100%" height="450px"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#showModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $(this).find('.modal-title').text(button.data('subject'));
                $(this).find('#embed-show').attr('src', button.data('url'));
                $(this).find('#number').html(button.data('number'));
                $(this).find('#subject').html(button.data('subject'));
                $(this).find('#date').html(button.data('date'));
                $(this).find('#sender').html(button.data('sender'));
                $(this).find('#disposition').html(button.data('disposition'));
                $(this).find('#description').html(button.data('description'));
                $(this).find('#status').html(button.data('status'));
                $(this).find('#revisi').html(button.data('revisi'));
                if (button.data('revisi')) {
                    $(this).find('#row-revisi').removeClass('d-none');
                } else {
                    $(this).find('#row-revisi').addClass('d-none');
                }
            });
        });
    </script>
@endsection
