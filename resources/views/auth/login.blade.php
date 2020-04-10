@extends('layouts.app')

@section('content')
<div>
    <v-row
        align="center"
        justify="center"
        class="login"
    >
        <v-col lg="4" md="4" sm="12" xs="12">
            <v-card flat class="login-input-form pa-10">
                <h1>Welcome Back {{ isset($url) ? ucwords($url) : ""}}</h1>
                <p class="tag-text">Don't miss your next opportunity. Sign in to stay updated on your agriculture world.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <v-text-field
                            id="email" type="email" class="@error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            label="Enter Email"
                            dense
                            placeholder="  "
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
                            dense
                            placeholder="  "
                        ></v-text-field>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <v-btn block x-large outlined color="primary" type="submit">Log In</v-btn>
                </form>
                <v-row no-gutters class="social-login-btn mt-10">
                    <v-col>
                        <v-btn block color="blue" large depressed dark>
                            <v-icon>mdi-facebook</v-icon> Facebook
                        </v-btn>
                    </v-col>
                    <v-col>
                        <v-btn block color="red" large  depressed dark>
                            <v-icon>mdi-google</v-icon> Google
                        </v-btn>
                    </v-col>
                </v-row>
                <div class="forgot-password">
                    <p>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                    <p>New to Agventure? <a href="{{route('register')}}" class="register-link">Join Now</a></p>
                </div>
            </v-card>
        </v-col>
    </v-row>

</div>
@endsection
