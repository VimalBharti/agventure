@extends('layouts.admin')

@section('content')
<div class="login">
    <v-container>
        <v-row justify="center" align="center">
            <v-col md="7" class="left-logo-box d-none d-md-flex align-center">
                <a href="/">
                <v-img
                    src="{{asset('images/logoFull.png')}}"
                    max-height="62" 
                    max-width="228"
                ></v-img></a>
            </v-col>
            <v-col md="5" sm="12" xs="12" class="right-form-box">
                <v-card class="login-input-form px-10 py-12" flat>
                    <h2>Login</h2>
                    <p>New to Agrishi? <a href="{{route('register')}}" class="register-link">Create new account</a></p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field">
                            <v-text-field
                                id="email" type="email" class="@error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                label="Enter Email"
                                placeholder="  "
                            ></v-text-field>
                        </div>

                        <div class="field">
                            <v-text-field
                                id="password" type="password" class="@error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password"
                                label="Enter Password"
                                placeholder="  "
                            ></v-text-field>
                        </div>

                        @error('email')
                            <p class="caption red--text text-center">{{ $message }}</p>
                        @enderror

                        <v-btn block rounded large color="teal" dark type="submit" class="mt-3">Log In</v-btn>
                    </form>
                    <div class="forgot-password">
                        <p>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </p>
                    </div>
                    <div class="social-login-btn">
                        <v-btn outlined block rounded large href="{{url('/login/facebook')}}" class="mb-5" color="grey">
                            <v-icon color="#3b5998" size="32">mdi-facebook-box</v-icon>
                            <span class="text-capitalize ml-4">Login with facebook</span>
                        </v-btn>
                        <v-btn outlined block rounded large href="{{url('/login/google')}}" color="grey">
                            <v-icon color="#db4a39" size="32">mdi-google-plus-box</v-icon>
                            <span class="text-capitalize ml-4">Login with facebook</span>
                        </v-btn>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>
@endsection
