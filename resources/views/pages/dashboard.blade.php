@extends('layout.student')
@section('body')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Profile</h5>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                    @if (empty(auth()->user()->avatar))
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('dist/img/user.png') }}"
                            alt="User profile picture">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset(Storage::url(auth()->user()->avatar)) }}"
                            alt="User profile picture">
                    @endif
                    </div>
                    <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                    <p class="text-muted text-center">
                        {{ auth()->user()->nrp }}
                        <br>
                        {{ auth()->user()->jabatan }}
                        <br>
                        {{ auth()->user()->position->name }}
                    </p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Role</b> <a class="float-right">{{ auth()->user()->jabatan }}</a>
                        </li>
                        <li class="list-group-item">
                            @if (empty(auth()->user()->phone))
                                <b>Phone</b> <a class="float-right">-</a>
                            @else
                                <b>Phone</b> <a class="float-right">{{ auth()->user()->phone }}</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                        </li>
                        <a href="#" class="btn btn-warning btn-block"><b>Edit Profile</b></a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Academic</h5>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">News</h5>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Newslatter</h5>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0"></h5>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title m-0">Facilities</h5>
        </div>
        <div class="card-body">
            
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title m-0">Appications & Services</h5>
        </div>
        <div class="card-body">
            
        </div>
    </div>
@endsection