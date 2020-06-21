
  
  <div class="android-footer">
    <a class="nav__link {{ Request::is('/') ? "active-nav" : "" }}" text href="/">
      <img src="{{asset('images/timeline.svg')}}">
    </a>

    <a class="nav__link {{ Request::is('m/all/podcasts') ? "active-nav" : "" }}" text href="{{route('podcast.mobile')}}">
      <img src="{{asset('images/podcast.svg')}}">
    </a>

    @guest
    <a class="nav__link {{ Request::is('login') ? "active-nav" : "" }}" text href="{{route('login')}}">
      <img src="{{asset('images/user.svg')}}">
    </a>
    @else
    <a class="nav__link" text href="{{route('myaccount', $user->username)}}">
      <div class="auth-avatar">
          @if(Auth::user()->image)
              <img src="/storage/profile/{{Auth::user()->image}}" style="border-radius:50%;width:42px;height:42px"/>
          @else
              <span class="username">{{Str::limit(Auth::user()->name, 1, '')}}</span>
          @endif
      </div>
    </a>
    @endguest

    <a class="nav__link {{ Request::is('my_favorites') ? "active-nav" : "" }}" text href="{{route('savedpost')}}">
      <img src="{{asset('images/fav.svg')}}">
    </a>

    <a class="nav__link {{ Request::is('all/m/updates') ? "active-nav" : "" }}" text href="{{route('allUpdates.mobile')}}">
      <img src="{{asset('images/update.svg')}}">
    </a>

  </div>