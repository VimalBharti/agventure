@extends('layouts.app')

@section('content')
<div class="verify-email">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-auto verify-card">
                <div class="card text-center">

                    <div class="card-body">

                        <v-img src="{{asset('images/verify.svg')}}" max-width="450" class="mx-auto"></v-img>

                        <h2>{{ __('Verify Your Email Address') }}</h2>

                        <p>Before proceeding, please check your email for a verification link. We already sent out the verification link. If you did not receive the email, click below to resend.</p>

                        @if (session('resent'))
                            <p>A fresh verification link has been sent to your email address.</p>
                        @endif

                        <div class="resend">
                            <span class="mr-6 white--text">Didn't get e-mail?</span>
                            <v-btn outlined color="white" href="{{ route('verification.resend') }}">{{ __('Send it again') }}</v-btn>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-color-teal"></div>
        </div>
    </div>
</div>
<div class="mobile-container">
    @include('mobile.footer')
</div>
@endsection
