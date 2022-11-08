@extends('layout.main')
@section('container')
<form action="/users" method="post" enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter fullname" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">NRP</label>
                        <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" placeholder="Enter nrp" value="{{ old('nrp') }}">
                        @error('nrp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="position_id">
                            <option>Pilih Jabatan</option>
                            @foreach ($positions as $item)
                                <option value="{{ $item->id }}" {{ old('position_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Atasan</label>
                        <select class="form-control" name="head_id">
                            <option>Pilih Atasan</option>
                            @foreach ($heads as $item)
                                <option value="{{ $item->id }}" {{ old('head_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                        @error('roles')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
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
                    <div class="col-sm-10">
                        <img class="img-preview img-fluid mb-3">
                    </div>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            {{-- <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImage()"> --}}
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
    function previewImage(){
        const avatar = document.querySelector('#avatar');
        const imgPreview = document.querySelector('.img-preview');


        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(avatar.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
