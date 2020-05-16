

  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  
  <div class="android-footer">
    <a class="nav__link" text href="/">
      <img src="{{asset('images/timeline.svg')}}">
    </a>

    <a class="nav__link" text href="{{route('podcast.mobile')}}">
      <img src="{{asset('images/podcast.svg')}}">
    </a>

    <a class="nav__link" text href="{{route('savedpost')}}">
      <img src="{{asset('images/fav.svg')}}">
    </a>

    <a class="nav__link" text href="{{route('allUpdates.mobile')}}">
      <img src="{{asset('images/update.svg')}}">
    </a>
  </div>