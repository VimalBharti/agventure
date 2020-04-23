
    <v-row class="login">
        <v-col class="login-box">
            <div class="social-logins px-8 pt-8 pb-4">
                <a href="{{url('/login/facebook')}}">
                    <div class="social-link-btn">
                        <v-icon color="#3b5998" size="36">mdi-facebook-box</v-icon> 
                        <span class="ml-8">Login with facebook</span>
                    </div>
                </a>
                <a href="{{url('/login/google')}}">
                    <div class="social-link-btn">
                        <v-icon color="#db4a39" size="36">mdi-google-plus-box</v-icon> 
                        <span class="ml-8">Login with Google</span>
                    </div>
                </a>
            </div>
            <div class="px-8 py-2" flat>
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
                    <p>New to Agrishi? <a href="{{route('register')}}" class="register-link">Create new account</a></p>
                </div>
            </div>
        </v-col>
    </v-row>