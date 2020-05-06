@extends('layouts.admin')

@section('content')
<div class="register">
    <v-container>  
        <v-row justify="center" align="center">
            <v-col md="7" class="left-logo-box d-none d-md-flex" align-end>
                <a href="/">
                <v-img
                    src="{{asset('images/logoFull.png')}}"
                    max-height="62" 
                    max-width="228"
                ></v-img></a>
            </v-col>
            <v-col md="5" sm="12" xs="12" class="right-form-box">
                <v-card class="register-input-form" flat>
                    <h2>Create an account</h2>
                    <p>Already have an account? <a href="login">Sign in</a></p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="field">
                            <v-text-field
                                id="name" 
                                type="text" 
                                class="@error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" 
                                autofocus
                                label="Your Name"
                                placeholder="  "
                                dense
                            ></v-text-field>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="field">
                            <v-text-field
                                id="email" type="email" class="@error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                label="Email Address"
                                placeholder="  "
                                dense
                            ></v-text-field>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- password -->
                        <div class="field">
                            <v-text-field
                                id="password" type="password" class="@error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password"
                                label="Enter Password"
                                placeholder="  "
                                dense
                            ></v-text-field>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="field">
                            <v-text-field
                                id="password-confirm" type="password" class="form-control" 
                                name="password_confirmation" required autocomplete="new-password"
                                label="Confirm Password"
                                placeholder="  "
                                dense
                            ></v-text-field>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <p>By clicking Create account, I agree that:</p>
                        <ul>
                            <li>I have read and accepted the Terms of Use.</li>
                            <li>The Agrishi family of companies may keep me informed with personalized emails about products and services.</li>
                        </ul>
                        <p class="mt-6">See our <a href="/privacy">Privacy Policy</a> for more details or to opt-out at any time.</p>
                        <!-- submit -->
                        <v-btn block large outlined color="primary" type="submit">Sign Up</v-btn>
                    </form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>
<div class="only-mobile">
    @include('mobile.footer')
</div>
@endsection
