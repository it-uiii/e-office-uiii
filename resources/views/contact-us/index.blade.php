@extends('layout.main')
@section('container')
    <!-- Default box -->
<div class="card">
    <div class="card-body row">
        <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
                <img src="{{ asset('logo/logo-uiii.png') }}" class="img-fluid mb-2" style="max-width: 300px">
                <p class="lead mb-5">Jl. Raya Bogor, Cisalak  <br> Kec. Sukmajaya, Kota Depok, Jawa Barat 16416
                </p>
            </div>
        </div>
        <div class="col-7">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="inputName" class="form-control" />
            </div>
            <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" />
            </div>
            <div class="form-group">
                <label for="inputSubject">Subject</label>
                <input type="text" id="inputSubject" name="inputSubject" class="form-control" />
            </div>
            <div class="form-group">
                <label for="inputMessage">Message</label>
                <textarea id="inputMessage" name="inputMessage" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send message">
            </div>
        </div>
    </div>
</div>
@endsection