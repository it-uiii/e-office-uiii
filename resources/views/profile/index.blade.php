@extends('layout.main')
@section('container')
{{-- <div class="col-md-6">
    <div class="card card-primary">
        <form method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Fullname</label>
                <input type="text" class="form-control" value="{{ session('user')->fullname }}" disabled readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="{{ session('user')->email }}" disabled readonly>
            </div>
            <div class="form-group">
                <label>Role : </label>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <input type="text" class="form-control" value="{{ $v }}" disabled readonly>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-warning" href="/profile/{{ session('user')->id }}/settings">Change Password</a>
            <a class="btn btn-danger" href="/">Back</a>
        </div>
        </form>
    </div>
</div> --}}

@php
    $user_name      = session('user')->fullname;
    $user_jabatan   = session('user')->position;
    $user_avatar    = session('user')->avatar;
    $user_email     = session('user')->email;

@endphp
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="img-fluid img-circle"
                        src="{{ asset(Storage::url($user_avatar)) }}"
                        alt="User profile picture"
                        style="max-width: 250px"
                        >
                </div>

                <h3 class="profile-username text-center">{{ $user_name }}</h3>

                <p class="text-muted text-center">
                    {{ $user_jabatan }}
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
        </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
            <!-- Post -->
            <div class="post">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                <span class="username">
                    <a href="#">Jonathan Burke Jr.</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                </span>
                <span class="description">Shared publicly - 7:30 PM today</span>
                </div>
                <!-- /.user-block -->
                <p>
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore the hate as they create awesome
                tools to help create filler text for everyone from bacon lovers
                to Charlie Sheen fans.
                </p>

                <p>
                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                <span class="float-right">
                    <a href="#" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comments (5)
                    </a>
                </span>
                </p>

                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
            </div>
            <!-- /.post -->

            <!-- Post -->
            <div class="post clearfix">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                <span class="username">
                    <a href="#">Sarah Ross</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                </span>
                <span class="description">Sent you a message - 3 days ago</span>
                </div>
                <!-- /.user-block -->
                <p>
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore the hate as they create awesome
                tools to help create filler text for everyone from bacon lovers
                to Charlie Sheen fans.
                </p>

                <form class="form-horizontal">
                <div class="input-group input-group-sm mb-0">
                    <input class="form-control form-control-sm" placeholder="Response">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.post -->

            <!-- Post -->
            <div class="post">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                <span class="username">
                    <a href="#">Adam Jones</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                </span>
                <span class="description">Posted 5 photos - 5 days ago</span>
                </div>
                <!-- /.user-block -->
                <div class="row mb-3">
                <div class="col-sm-6">
                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <div class="row">
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                        <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <p>
                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                <span class="float-right">
                    <a href="#" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comments (5)
                    </a>
                </span>
                </p>

                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
            </div>
            <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings">
            <form class="form-horizontal" action="/profile/{{ session('user')->id }}/changeName">
                @method('put')
                @csrf
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Avatar</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="oldCover" value="{{ session('user')->avatar }}">
                        @if (session('user')->avatar)
                            <img src="{{ asset(Storage::url(session('user')->avatar)) }}" class="img-preview img-fluid">
                        @else
                            <img class="img-preview img-fluid mb-3">
                        @endif
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
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" value="{{ session('user')->fullname }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" value="{{ session('user')->email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="position_id" value="{{ session('user')->position }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                    <a class="btn btn-warning" href="/profile/{{ session('user')->id }}/settings">Change Password</a>
                </div>
                </div>
            </form>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

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
