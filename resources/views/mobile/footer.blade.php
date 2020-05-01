
<v-bottom-navigation
    class="app-bar-bottom"
    grow
    color="teal"
  >
    <v-btn href="/">
      <span>Home</span>
      <v-icon>mdi-buffer</v-icon>
    </v-btn>

    <v-btn href="{{route('podcast')}}">
      <span>Podcast</span>
      <v-icon>mdi-headphones</v-icon>
    </v-btn>

    @guest
    <v-btn href="../login">
      <span>Login</span>
      <v-icon>mdi-account-outline</v-icon>
    </v-btn>
    @else
    <v-btn href="{{route('myaccount', $user->username)}}">
        <v-avatar size="48" class="mobile-auth-bottom-text" outlined>
            @if(Auth::user()->image)
                <v-img 
                    src="/storage/profile/{{Auth::user()->image}}"
                    lazy-src="{{asset('images/lazy.jpg')}}"
                    aspect-ratio="1"
                    class="grey lighten-4"
                ></v-img>
            @else
                <span class="white--text title">{{Str::limit(Auth::user()->name, 1, '')}}</span>
            @endif
        </v-avatar>
    </v-btn>
    @endguest

    <v-btn href="{{route('savedpost')}}">
      <span>Favourites</span>
      <v-icon>mdi-heart-outline</v-icon>
    </v-btn>

    <v-btn href="{{route('allUpdates')}}">
      <span>Updates</span>
      <v-icon>mdi-bell-outline</v-icon>
    </v-btn>

  </v-bottom-navigation>