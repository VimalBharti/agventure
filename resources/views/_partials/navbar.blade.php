<v-app-bar flat class="main-navbar" height="48">
    <a href="/"><v-toolbar-title>
        <v-avatar color="teal" size="36">
            <v-icon dark>mdi-leaf</v-icon>
        </v-avatar>
        <span class="ml-2 grey--text text--darken-4">Agventure</span>
    </v-toolbar-title></a>

    <v-spacer></v-spacer>

    <v-text-field
        hide-details
        placeholder="Search farming, vermicompost, hyrophonic..."
        outlined
        dense
    ></v-text-field>
    <v-btn icon><v-icon>mdi-magnify</v-icon></v-btn>

    <v-spacer></v-spacer>

    <!-- if logout -->
    @guest
        <v-btn outlined small color="teal" href="{{route('login')}}">Log in</v-btn>
        <v-btn depressed small color="teal" dark href="{{route('register')}}" class="ml-3 mr-5">Sign up</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-icon v-on="on">mdi-menu-down</v-icon>
                <v-icon>mdi-account</v-icon>
            </template>
            <v-list class="py-0" dense>
                <v-list-item href="/">
                    <v-list-item-title>About Us</v-list-item-title>
                </v-list-item>
                <v-list-item href="/">
                    <v-list-item-title>Contact Us</v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item href="/login">
                    <v-list-item-title>FAQ</v-list-item-title>
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
        <a href="/">
        <v-avatar color="cyan" size="32">
            <v-icon dark>mdi-leaf</v-icon>
        </v-avatar>
        <span class="ml-1 grey--text text--darken-4">Agventure</span>
        </a>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <search></search>
    @guest
    @else
        <v-btn icon href="{{url('new/post/mobile')}}"><v-icon>mdi-plus-circle-outline</v-icon></v-btn>
    @endguest
</v-app-bar>