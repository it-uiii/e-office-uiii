@extends('layout.main')
@section('container')
<style>
h4 {
  overflow: hidden;
  text-align: center;
}

h4:before,
h4:after {
  background-color: #000;
  content: "";
  display: inline-block;
  height: 1px;
  position: relative;
  vertical-align: middle;
  width: 50%;
}

h4:before {
  right: 0.5em;
  margin-left: -50%;
}

h4:after {
  left: 0.5em;
  margin-right: -50%;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
</style>

{{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1846021abd3%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1846021abd3%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.9187469482422%22%20y%3D%22217.76000022888184%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E">
      <div class="carousel-caption d-none d-md-block">
        <h5>Hallo world</h5>
        <p>ini desct</p>
        <a class="btn btn-primary" href="">read more</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1846021abd4%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1846021abd4%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.31874084472656%22%20y%3D%22217.76000022888184%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E">
      <div class="carousel-caption d-none d-md-block">
        <h5>...</h5>
        <p>...</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1846021abd5%20text%20%7B%20fill%3A%23333%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1846021abd5%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23555%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22277%22%20y%3D%22217.76000022888184%22%3EThird%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E">
      <div class="carousel-caption d-none d-md-block">
        <h5>...</h5>
        <p>...</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> --}}

<div>
  <h4>Quick Menu</h4>
</div>
<!-- Small boxes (Stat box) -->
<div class="row mb-4">
  @can('letter-list')
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box" style="background-color:#64adf5; color:white;">
      <div class="inner">
        <h3>e-archive UIII</h3>

        <p>archive</p>
      </div>
      <div class="icon">
        <i class="fas fa-envelope"></i>
      </div>
      <a href="{{ route('outgoing-letters.index') }}" target="_blank" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  @endcan
  @can('performance-report-list')
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box" style="background-color:#3275a8; color:white;">
      <div class="inner">
        <h3>LKH</h3>

        <p>Performance report</p>
      </div>
      <div class="icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <a href="{{ route('performance-reports.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  @endcan
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box" style="background-color:#0b4b8a; color:white">
      <div class="inner">
        <h3>IT UIII</h3>
        <p>Ticket & Request</p>
      </div>
      <div class="icon">
        <i class="fa-sharp fa-solid fa-circle-info"></i>
      </div>
      <a href="https://it.uiii.ac.id/form_request" class="small-box-footer" target="_blank">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box" style="background-color:azure">
      <div class="inner">
        <h3>JDIH</h3>
        <p>Jaringan Informasi Hukum</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-gavel"></i>
      </div>
      <a href="https://jdih.uiii.ac.id/" class="small-box-footer" target="_blank">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  {{-- <div class="col-lg-3 col-6">
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
  </div> --}}
  <!-- ./col -->
  @can('asset')
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>Assets</h3>

        <p>Asset & Procurement</p>
      </div>
      <div class="icon">
        <i class="fas fa-cubes"></i>
      </div>
      <a href="https://asset.uiii.ac.id/" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  @endcan
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box" style="background-color: #32a887;">
      <div class="inner">
        <h3>Library UIII</h3>

        <p>Library</p>
      </div>
      <div class="icon">
        <i class="fas fa-solid fa-book"></i>
      </div>
      <a href="https://library.uiii.ac.id/" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
{{-- <div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box" style="background-color: #0f4b5c;">
    <div class="inner">
      <h3>LMS UIII</h3>

      <p>Learning Machine System</p>
    </div>
    <div class="icon">
      <i class="fas fa-solid fa-graduation-cap"></i>
    </div>
    <a href="https://sia.lms-uiii.id/auth/signin" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div> --}}
<!-- /.row -->

<div class="mt-4">
  <h4>Quotes of the day</h4>
</div>

<div class="card mb-4">
  <div class="card-body">
    <ul>
      @foreach ($quotes as $quote)
      <li>
        <a href="" data-toggle="modal" data-target="#modal-lg-{{ $quote->id }}">
          {{ $quote->title }}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>

<div class="mt-4">
  <h4>Latest SOP</h4>
</div>
<div class="card">
  <div class="card-body">
    <ul class="list-unstyled">
      @foreach ($rules as $rule)
      <li class="media mb-3">
        <img class="mr-3 img-fluid" style="max-width: 80px;" src="{{ asset('logo/sop.png') }}">
        <div class="media-body">
          <h5 class="mt-0 mb-1">{{ $rule->title }}</h5>
          @if ($rule->status == 'Berlaku')
            <span class="badge bg-success">Berlaku</span>
          @else
            <span class="badge bg-danger">Tidak Berlaku</span>
          @endif
          <br>
          <a href="{{ $rule->file }}" target="_blank">read more</a>
        </div>
      </li>
      <hr/>
      @endforeach
    </ul>
  </div>
  <div class="card-footer clearfix text-center">
    For more information about SOP 
    <a href="https://jdih.uiii.ac.id/sop" target="_blank">click here</a>
      {{-- {{ $data->links('partials.pagination') }} --}}
  </div>
</div>

@foreach ($quotes as $quote)
<div class="modal fade" id="modal-lg-{{ $quote->id }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ $quote->title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! $quote->body !!}
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach

@endsection