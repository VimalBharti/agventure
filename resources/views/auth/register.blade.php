@extends('layouts.app')

@section('content')
<div class="register">
    <v-row
        align="center"
        justify="center"
    >
        <v-col cols="4">
            <v-card class="register-input-form">
                <h3>Welcome!</h3>
                <p>Create new account</p>
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
                            outlined
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
                            label="Your Email"
                            outlined
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
                            outlined
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
                            outlined
                        ></v-text-field>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- submit -->
                    <v-btn block large outlined color="primary" type="submit">Sign Up</v-btn>
                </form>
            </v-card>
        </v-col>
    </v-row>
</div>
@endsection
