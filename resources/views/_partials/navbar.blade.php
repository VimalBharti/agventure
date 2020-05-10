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
        <v-btn text small color="teal" href="{{url('new/podcast')}}" class="mr-4">
            <v-icon class="mr-2">mdi-radio-tower</v-icon> Add Podcast
        </v-btn>
        <v-btn outlined small color="teal" href="{{url('new/post')}}" class="mr-4">Add New Post</v-btn>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-toolbar-title>
                    <v-btn icon>
                        @if(Auth::user()->image)
                        <v-avatar size="36" v-on="on">
                            <img src="/storage/profile/{{Auth::user()->image}}" />
                        </v-avatar>
                        @else
                            <v-avatar color="teal" size="40" v-on="on">
                                <span class="white--text title">{{Str::limit(Auth::user()->name, 1, '')}}</span>
                            </v-avatar>
                        @endif
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
                <v-list-item href="{{route('myEvents')}}">
                    <v-list-item-subtitle><v-icon class="grey--text mr-3" size="20">mdi-ticket</v-icon> My Events</v-list-item-subtitle>
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


<!--======================================
========================================== 
                For mobile 
==========================================
=======================================-->
<v-app-bar color="white" dense flat class="mobile-nav">
    <v-toolbar-title>
        <v-avatar tile size="32">
            <img
                src="{{asset('images/logo2.png')}}"
                alt="agrishi"
            >
        </v-avatar>
        <span>agrishi</span>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <search></search>

    <a @click.stop="drawer = !drawer" class="ml-3">
        <v-icon>mdi-dots-vertical</v-icon>
    </a>

    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
      class="navigation-drawer"
    >
        @guest
            <v-list>
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