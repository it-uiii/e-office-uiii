@extends('layout.main')
@section('container')
{{-- <div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Avatar</label>
                    <br>
                    <input type="hidden" name="oldCover" value="{{ $user->avatar }}">
                    @if ($user->avatar)
                        <img src="{{ asset(Storage::url($user->avatar)) }}" class=" img-fluid img-circle">
                    @else
                        No image
                    @endif
                    <div class="custom-file mt-2">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">NRP</label>
                    <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" placeholder="Enter nrp" value="{{ old('nrp', $user->nrp) }}">
                    @error('nrp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="position_id">
                        <option>Pilih Jabatan</option>
                        @foreach ($positions as $item)
                            <option value="{{ $item->id }}" {{ old('position_id', $user->position_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Atasan</label>
                    <select class="form-control" name="head_id">
                        <option>Pilih Atasan</option>
                        @foreach ($heads as $item)
                            <option value="{{ $item->id }}" {{ old('head_id', $user->head_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-danger" href="/users">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div> --}}

<form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter fullname" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">NRP</label>
                        <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" placeholder="Enter nrp" value="{{ old('nrp', $user->nrp) }}">
                        @error('nrp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="position_id">
                            <option>Pilih Jabatan</option>
                            @foreach ($positions as $item)
                                <option value="{{ $item->id }}" {{ old('position_id', $user->position_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Atasan</label>
                        <select class="form-control" name="head_id">
                            <option>Pilih Atasan</option>
                            @foreach ($heads as $item)
                                <option value="{{ $item->id }}" {{ old('head_id', $user->head_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a class="btn btn-danger" href="/users">Cancel</a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">Upload Gambar</label>
                    <input type="hidden" name="oldCover" value="{{ $user->avatar }}">
                    <div class="col-sm-10">
                        <input type="hidden" name="oldCover" value="{{ $user->avatar }}">
                        @if ($user->avatar)
                            <img src="{{ asset(Storage::url($user->avatar)) }}" class="img-preview img-fluid">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-2">
                        @endif
                    </div>
                    <div class="col-sm-10 mt-3">
                        <div class="custom-file">
                            <input type="file" multiple class="custom-file-input" id="avatar" name="avatar" aria-describedby="image" aria-label="Upload" onchange="previewImage()">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</form>

<script>
    // script preview image
    function previewImage(){
        const image = document.querySelector('#avatar');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
