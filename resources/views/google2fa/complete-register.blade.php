@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Two Factor Authentication</div>

                <div class="panel-body" style="text-align: center;">
                    <p>You can use 2FA by scanning this barcode or use this secret code: {{ $secret }}</p>
                    <p><strong>Don't Forget to Save this Code for Backup 2FA</strong></p>
                    <div>
                        <img src="{{ $QR_Image }}">
                    </div>
                    @if (!@$reauthenticating)
                    <p>You must complete 2FA before completing your registration</p>
                    <div>
                        <a href="/complete-registration"><button class="btn-primary">Complete Registration</button></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection