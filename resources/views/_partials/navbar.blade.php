<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">


<div class="main-navbar primary-navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-links">
        <a href="/" class="navbar-item">
            <img src="{{asset('images/agrishi.png')}}" alt="Agrishi" height="32">
        </a>
        <div class="navbar-item">
            <div class="field">
                <form action="{{route('search-desktop')}}" method="get">
                    <input type="text" placeholder="search..." class="input" aria-label="Search" name="search">
                    <v-btn icon type="submit"><img src="{{asset('images/search.svg')}}"></v-btn>
                </form>
            </div>
        </div>
        @guest
            <div class="navbar-item">
                <a href="/register" class="joinnow">Join Now</a>
                <a href="/login" class="signin">Sign In</a>
            </div>
        @else
            <div class="navbar-item">
                <a href="{{url('new/post')}}" class="button">&#10011; Add Post</a>
                <a href="{{url('new/podcast')}}" class="button">&#9835; Add Podcast</a>
                <div class="auth-user">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <div class="auth-avatar" v-on="on">
                                @if(Auth::user()->image)
                                    <img src="/storage/profile/{{Auth::user()->image}}" />
                                @else
                                    <span class="username">{{Str::limit(Auth::user()->name, 1, '')}}</span>
                                @endif
                                <span>{{Auth::user()->name}}</span>
                            </div>
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
                </div>
            </div>
        @endguest
    </div>
</div>

<!--======================================
========================================== 
                For mobile 
==========================================
=======================================-->
<div class="mobile-navbar primary-navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-links">
        <a href="/" class="navbar-item">
            <img src="{{asset('images/logo.png')}}" alt="Agrishi - agricultural social network" height="32">
        </a>

        <span class="showMe"><search></search></span>
        
        <a @click.stop="drawer = !drawer" class="navbar-item showMe">
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
    </div>
</div>