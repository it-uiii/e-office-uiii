<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Portal | {{ $title }}</title>

{{-- icon --}}
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('logo/logo_bulet.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('logo/logo_bulet.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo/logo_bulet.png') }}">

<link rel="icon" href="">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    @if (session()->has('success'))
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('change'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('change') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="/login" class="h1">
            <img class="img-fluid" src="{{ asset('logo/gold_uiii.png') }}" alt="">
        </a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login.auth') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                    Remember Me
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{-- <p class="mb-1 mt-4 text-center">
    <a href="forgot-password.html">I forgot my password</a>
    </p> --}}
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
