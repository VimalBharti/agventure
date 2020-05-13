<v-app-bar flat class="main-navbar" height="48">
    
    <v-toolbar-title class="ml-1">
        <v-avatar tile size="32">
            <img
                src="{{asset('images/logo.png')}}"
                alt="agrishi"
            >
        </v-avatar>
        <span>agrishi</span>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    

    <a @click.stop="drawer = !drawer" class="ml-3 mr-1">
        <v-icon>mdi-dots-vertical</v-icon>
    </a>

    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
      class="navigation-drawer"
    >
        @guest
            <v-list class="mt-12">
                <v-list-item>
                    <v-btn rounded outlined block color="teal" href="/login">Log in</v-btn>
                </v-list-item>
                <v-list-item>
                    <v-btn rounded block color="teal" dark depressed href="/register">Sign Up</v-btn>
                </v-list-item>
            </v-list>
        @else
            <v-list-item>
                @if(Auth::user()->image)
                    <v-list-item-avatar size="36">
                        <img src="/storage/profile/{{Auth::user()->image}}" />
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{Auth::user()->name}}</v-list-item-title>
                    </v-list-item-content>
                @else
                    <v-list-item-avatar color="teal" size="40">
                        <span class="white--text title">{{Str::limit(Auth::user()->name, 1, '')}}</span>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{Auth::user()->name}}</v-list-item-title>
                    </v-list-item-content>
                @endif
            </v-list-item>

            <v-divider></v-divider>

            <v-list nav>
                <v-list-item href="{{url('new/post/mobile')}}">
                    <v-list-item-subtitle>
                        <v-icon class="grey--text mr-3" size="22">mdi-plus</v-icon>Add Post
                    </v-list-item-subtitle>
                </v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list nav>
                <v-list-item href="{{url('new/podcast')}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-music</v-icon>Add Podcast</v-list-item-subtitle>
                </v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list nav>
                <v-list-item href="/">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-buffer</v-icon> Timeline</v-list-item-subtitle>
                </v-list-item>
                <v-list-item href="{{route('myaccount', $user->username)}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-account-outline</v-icon> My Account</v-list-item-subtitle>
                </v-list-item>
                <v-list-item href="{{route('mypost')}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-database</v-icon> My Post</v-list-item-subtitle>
                </v-list-item>
                <v-list-item href="{{route('mobile.myEvents')}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-ticket</v-icon> My Events</v-list-item-subtitle>
                </v-list-item>
                <v-list-item href="{{route('inbox')}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-message-text-outline</v-icon> Message</v-list-item-subtitle>
                </v-list-item>
                <v-list-item href="{{route('savedpost')}}">
                    <v-list-item-subtitle>
                        <v-icon class="grey--text mr-3" size="20">mdi-bookmark-plus-outline</v-icon> Saved Post
                    </v-list-item-subtitle>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <v-list-item-subtitle>
                        <v-icon class="grey--text mr-3" size="20">mdi-logout-variant</v-icon> Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </v-list-item-subtitle>
                </v-list-item>
            </v-list>
        @endguest

    </v-navigation-drawer>

</v-app-bar>