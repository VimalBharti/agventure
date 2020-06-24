<div class="main-navbar primary-navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-links">
        <a href="/" class="navbar-item nav-logo pad-l-r">
            <img src="{{asset('images/logoBox.png')}}" alt="Agrishi" height="32">
        </a>
        <div class="navbar-item only-desktop pad-l-r">
            <div class="field">
                <form action="{{route('search-desktop')}}" method="get">
                    <input type="text" placeholder="Search for keyword.." class="input" aria-label="Search" name="search">
                    <!-- <v-btn icon type="submit"><img src="{{asset('images/search.svg')}}"></v-btn> -->
                    <input type="submit" value="Search" class="search-button">
                </form>
            </div>
        </div>
        <div class="navbar-links text-links only-desktop">
            <a href="/all/updates" class="navbar-item pad-l-r">Updates</a>
            <a href="/all/podcasts" class="navbar-item pad-l-r">Podcast</a>
            <a href="/register" class="navbar-item pad-l-r">Join Now</a>
        </div>
        @guest
            <div class="navbar-item only-desktop login-fields pad-l-r">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" placeholder="email" name="email" required>
                    <input type="password" placeholder="password" name="password" required>
                    <button>Login</button>
                </form>
            </div>
        @else
            <div class="navbar-item only-desktop">
                <div class="other-links navbar-item">
                    <a href="{{url('new/post')}}" class="navbar-item pad-l-r" style="border:1px solid #dfdfdf;border-radius:8px">
                        Add post
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="navbar-item pad-l-r">
                        <img src="{{asset('images/logout.png')}}" style="height:24px;width:24px">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </a>
                </div>
                <div class="auth-user">
                    <div class="auth-avatar">
                        @if(Auth::user()->image)
                            <a href="{{route('myaccount', $user->username)}}" class="navbar-item" style="padding-right:1em">
                                <img src="/storage/profile/{{Auth::user()->image}}" style="width:35px;height:35px">
                            </a>
                        @else
                            <a href="{{route('myaccount', $user->username)}}" class="navbar-item" style="padding-right:0.6em">
                                <span class="username">{{Str::limit(Auth::user()->name, 1, '')}}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endguest
        <a class="navbar-item only-mobile" style="font-weight:bold">
            <span>AG</span><span style="color:#008080">RISHI</span>
        </a>
        <a href="{{url('new/post')}}" class="navbar-item only-mobile pad-l-r">
            <img src="{{asset('images/add.svg')}}">
        </a>
    </div>
</div>
