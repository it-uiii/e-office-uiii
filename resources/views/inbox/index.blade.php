@extends('layout.main')
@section('container')
@if (session()->has('deleted'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('deleted') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search Mail">
                <div class="input-group-append">
                    <div class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    </div>
                </div>
                </div>
            </div>
        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
        <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-reply"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-share"></i>
            </button>
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm">
            <i class="fas fa-sync-alt"></i>
            </button>
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
            <tbody>
            @if ($mails->count())
            @foreach ($mails as $mail)
            <tr>
                <td>
                <div class="icheck-primary">
                    <input type="checkbox" value="" id="check1">
                    <label for="check1"></label>
                </div>
                </td>
                <td class="mailbox-name"><a href="/request/{{ $mail->id }}">{{ $mail->name }}</a></td>
                <td class="mailbox-subject">{{ $mail->subject }}
                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">{{ $mail->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="6">No Message Available</td>
                </tr> 
            @endif
            </tbody>
            </table>
            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
        <div class="mailbox-controls">
            <!-- Check all button -->
            <div class="float-right">
            {{ $mails->links() }}
            <!-- /.btn-group -->
            </div>
            <!-- /.float-right -->
        </div>
        </div>
    </div>
    <!-- /.card -->
@endsection