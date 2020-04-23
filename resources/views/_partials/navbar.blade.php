<v-app-bar flat class="main-navbar" height="48">
    <v-toolbar-title>
        <a href="/"><v-img 
            src="{{asset('images/logo.png')}}"
            max-height="46"
            contain
        ></v-img></a>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <form action="{{route('search-desktop')}}" method="get">
        <input
            hide-details
            placeholder="Search post..."
            class="search-input-desktop"
            name="search"
        />
        <v-btn icon type="submit"><v-icon>mdi-magnify</v-icon></v-btn>
    </form>

    <v-spacer></v-spacer>

    <!-- if logout -->
    @guest
        <v-btn outlined small color="teal" href="login">Log in</v-btn>
        <v-btn depressed small color="teal" dark href="{{route('register')}}" class="ml-3 mr-3">Sign up</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn  v-on="on" text>
                    <v-icon>mdi-account</v-icon>
                    <v-icon>mdi-menu-down</v-icon>
                </v-btn>
            </template>
            <v-list class="py-0" dense>
                <v-list-item href="/about">
                    <v-list-item-title>About Us</v-list-item-title>
                </v-list-item>
                <v-list-item href="/contact">
                    <v-list-item-title>Contact Us</v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item href="/privacy">
                    <v-list-item-title>Privacy Policy</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    @else
        <v-btn outlined small color="teal" href="{{url('new/post')}}" class="mr-4">New Post</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-toolbar-title>
                    <v-btn icon>
                        <v-avatar size="36" v-on="on">
                            <img src="/storage/profile/{{Auth::user()->image}}" />
                        </v-avatar>
                    </v-btn>
                    <!-- <span class="caption">{{Auth::user()->username}}</span> -->
                </v-toolbar-title>
            </template>
            <v-list dense nav width="200">
                <v-list-item href="/">
                    <v-list-item-title><v-icon class="grey--text mr-1">mdi-buffer</v-icon> Timeline</v-list-item-title>
                </v-list-item>
                <v-list-item href="{{route('myaccount', $user->username)}}">
                    <v-list-item-title><v-icon class="grey--text mr-1">mdi-account</v-icon> My Account</v-list-item-title>
                </v-list-item>
                <v-list-item href="{{route('mypost')}}">
                    <v-list-item-title><v-icon class="grey--text mr-1">mdi-video</v-icon> My Post</v-list-item-title>
                </v-list-item>
                <v-list-item href="{{route('inbox')}}">
                    <v-list-item-title><v-icon class="grey--text mr-1">mdi-message-text-outline</v-icon> Message</v-list-item-title>
                </v-list-item>
                <v-list-item href="{{route('savedpost')}}">
                    <v-list-item-title>
                        <v-icon class="grey--text mr-1">mdi-bookmark-check</v-icon> Saved Post
                    </v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <v-list-item-title>
                        <v-icon class="grey--text mr-1">mdi-logout-variant</v-icon> Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    @endguest
</v-app-bar>


<!-- For mobile -->
<v-app-bar color="white" dense flat class="mobile-nav">
    <v-toolbar-title>
        <a href="/"><v-img 
            src="{{asset('images/logo.png')}}"
            max-height="46"
            contain
        ></v-img></a>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <search></search>
    @guest
    @else
        <v-btn icon href="{{url('new/post/mobile')}}"><v-icon>mdi-plus</v-icon></v-btn>
    @endguest
</v-app-bar>