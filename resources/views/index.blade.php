{{-- @dd($users); --}}
@extends('layout.main')
@section('container')
<!-- Small boxes (Stat box) -->
{{-- <div class="row mb-4">
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>JDIH</h3>

        <p>Jaringan Dokumen & Informasi Hukum</p>
      </div>
      <div class="icon">
        <i class="fas fa-gavel"></i>
      </div>
      <a href="https://jdih.uiii.ac.id/" class="small-box-footer" target="_blank">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>UIII IT</h3>

        <p>IT CENTER</p>
      </div>
      <div class="icon">
        <i class="fas fa-digital-tachograph"></i>
      </div>
      <a href="https://it.uiii.ac.id/" target="_blank" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>Attendance</h3>

        <p>online attendance</p>
      </div>
      <div class="icon">
        <i class="fas fa-fingerprint"></i>
      </div>
      <a href="http://10.1.8.90/" target="_blank" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>Asset</h3>

        <p>Asset Management</p>
      </div>
      <div class="icon">
        <i class="fas fa-cubes"></i>
      </div>
      <a href="http://dev-asset.uiii.ac.id/login" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div> --}}
<!-- /.row -->
<div class="container">
  <div class="text-center">
    <h4>LATEST NEWS</h4>
  </div>

  <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-6">
      <div class="card flex-md-row mb-4 box-shadow h-md-250">
        <div class="card-body d-flex flex-column align-items-start">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">
            <a class="text-dark" href="#">Featured post</a>
          </h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#">Continue reading</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card flex-md-row mb-4 box-shadow h-md-250">
        <div class="card-body d-flex flex-column align-items-start">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">
            <a class="text-dark" href="#">Post title</a>
          </h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#">Continue reading</a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection