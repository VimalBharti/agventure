<v-app-bar flat class="main-navbar" height="48">
    <a href="/"><v-toolbar-title>
        <v-avatar color="cyan" size="36">
            <v-icon dark>mdi-leaf</v-icon>
        </v-avatar>
        <span class="ml-2 grey--text text--darken-4">Agventure</span>
    </v-toolbar-title></a>

    <v-spacer></v-spacer>

    <v-icon class="mr-2">mdi-magnify</v-icon>
    <v-text-field
        hide-details
        placeholder="Search farming, vermicompost, hyrophonic..."
        outlined
        dense
    ></v-text-field>

    <v-spacer></v-spacer>

    <!-- if logout -->
    @guest
        <v-btn outlined small color="primary" href="{{route('login')}}">Log in</v-btn>
        <v-btn depressed small color="primary" href="{{route('register')}}" class="ml-3 mr-5">Sign up</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-icon v-on="on">mdi-menu-down</v-icon>
                <v-icon>mdi-account</v-icon>
            </template>
            <v-list class="py-0" dense>
                <v-list-item href="/">
                    <v-list-item-title>User</v-list-item-title>
                </v-list-item>
                <v-list-item href="/">
                    <v-list-item-title>User</v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item href="/login">
                    <v-list-item-title>Login/Register</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    @else
        <v-btn outlined small color="primary" href="{{url('new/post')}}" class="mr-4">New Post</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-toolbar-title>
                    <v-avatar size="32">
                        <img src="/storage/profile/{{Auth::user()->image}}" />
                    </v-avatar>
                    <!-- <span class="caption">{{Auth::user()->username}}</span> -->
                    <v-btn icon v-on="on"><v-icon>mdi-menu-down</v-icon></v-btn>
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