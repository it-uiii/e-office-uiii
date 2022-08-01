{{-- @dd($request) --}}
@extends('layout.main')
@section('container')
<div class="card card-primary card-outline">
    <div class="text-center mt-2">
        <img class="img-fluid" src="{{ asset('img/header.png') }}">
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
    <div class="mailbox-read-info">
        <div class="text-center">
            <h2><b>SUPPORT REQUEST FORM</b></h2>
        </div>
        <div class="text-center bg-cyan">
            ORDER DETAILS
        </div>
        <table class="table table-bordered">
            <tr>
                <td style="width:20%">Project Name</td>
                <td colspan="3">{{ $request->category_code }}</td>
            </tr>
            <tr>
                <td>Requested By</td>
                <td colspan="3"><b><i>{{ $request->name }}</i></b></td>
            </tr>
            <?php 
                $temp = explode(' ',$request->created_at);
            ?>
            <tr>
                <td>Date</td>
                <td><b>{{ $temp[0] }}</b></td>
                <td style="width:10%">Time</td>
                <td><b>{{ $temp[1] }}</b></td>
            </tr>
            <tr>
                <td>Email Request</td>
                <td colspan="3">{{ $request->email }}</td>
            </tr>
            <tr>
                <td>Request Number</td>
                <td colspan="3">{{ $request->request_number }}</td>
            </tr>
        </table>
        <div class="text-center bg-cyan">
            DESCRIPTION
        </div>
        <span>{!! $request->desc !!}</span>
        <div class="text-center bg-cyan mt-4">
            REASON
        </div>
        <span>{!! $request->reason !!}</span>
        <div class="text-center bg-cyan mt-4">
            IMPACT OF CHANGES
        </div>
        <span>{!! $request->impact !!}</span>
    </div>
    <!-- /.card-footer -->
    <div class="card-footer">
    <form action="/request/{{ $request->id }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-default" onclick="return confirm('Are you sure want delete this request?')">
            <i class="far fa-trash-alt"></i> Delete
        </button>
    </form>
    <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->
@endsection