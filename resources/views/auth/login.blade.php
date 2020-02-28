@extends('layouts.app')

@section('content')
<div class="register">

    <v-row
        align="center"
        justify="center"
    >
        <v-col lg="4" md="4" sm="12" xs="12">
            <v-card flat class="register-input-form">
                <h1>Welcome Back</h1>
                <p class="tag-text">Don't miss your next opportunity. Sign in to stay updated on your agriculture world.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <v-text-field
                            id="email" type="email" class="@error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            label="Enter Email"
                            outlined
                        ></v-text-field>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <v-text-field
                            id="password" type="password" class="@error('password') is-invalid @enderror" 
                            name="password" required autocomplete="new-password"
                            label="Enter Password"
                            outlined
                        ></v-text-field>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <v-btn block x-large outlined color="primary" type="submit">Log In</v-btn>
                </form>
                <p class="forgot-password">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </p>
                <p>New to Agventure? <a href="{{route('register')}}" class="register-link">Join Now</a></p>
            </v-card>
        </v-col>
    </v-row>

</div>
@endsection
