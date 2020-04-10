@extends('layouts.app')

@section('content')
<v-row class="main-container boxed-layout">
    <!-- sidebar -->
    @include('_partials.sidebar')

    <v-col cols="9" class="center-post-container">
        <v-card
            class="mx-auto grey lighten-5 box-shadow"
            flat
        >
            <v-card-title
                class="title white"
                primary-title
                >
                <span>My account</span>
                <v-spacer></v-spacer>
                <v-btn dark dense small depressed color="cyan" href="{{route('editaccount')}}"> Edit</v-btn>
            </v-card-title>
            <v-card-text>
                <div class="mt-6 text-uppercase">User Information</div>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Name"
                                outlined
                                value="{{$user->name}}"
                                disabled
                                color="primary"
                                background-color="white"
                            ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="6">
                            <v-text-field
                                label="Email address"
                                outlined
                                color="primary"
                                disabled
                                value="{{$user->email}}"
                                background-color="white"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field
                                label="Contact no."
                                outlined
                                disabled
                                value="{{$user->mobile}}"
                                color="primary"
                                background-color="white"
                            ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="6">
                            <v-text-field
                                label="Username"
                                outlined
                                disabled
                                value="{{$user->username}}"
                                color="primary"
                                background-color="white"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                    <v-divider></v-divider>

                <div class="mt-6 text-uppercase">Contact Information</div>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="4">
                            <v-text-field
                                label="City"
                                outlined
                                disabled
                                color="primary"
                                value="{{$user->city}}"
                                background-color="white"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="4">
                            <v-text-field
                                label="State"
                                outlined
                                disabled
                                color="primary"
                                value="{{$user->state}}"
                                background-color="white"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="4">
                            <v-text-field
                                label="Country"
                                outlined
                                disabled
                                color="primary"
                                value="{{$user->country}}"
                                background-color="white"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                    <v-divider></v-divider>

                <div class="mt-6 text-uppercase">About</div>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12">
                            <v-textarea
                                label="About me"
                                background-color="white"
                                outlined
                                value="{{$user->about}}"
                                disabled
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-col>
</v-row>

<!--
===========================
    Mobile Screen 
===========================
-->
<div class="mobile-container pb-6">
    <v-card
        color="#385F73" dark
        class="text-center" tile
    >
        <v-card-actions>
            <v-btn x-small outlined class="text-capitalize" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn x-small outlined class="text-capitalize" href="{{route('editaccount')}}">
                Edit account
            </v-btn>
        </v-card-actions>

        <v-avatar size="125">
            <v-img src="/storage/profile/{{Auth::user()->image}}"></v-img>
        </v-avatar>

        <h2>{{$user->name}}</h2>
        <h5>{{$user->email}}</h5>

        <p class="caption px-3">{{$user->about}}</p>

        <v-card-actions class="justify-center">
            <v-btn icon><v-icon size="30">mdi-facebook-box</v-icon></v-btn>
            <v-btn icon><v-icon size="30">mdi-twitter-box</v-icon></v-btn>
            <v-btn icon><v-icon size="30">mdi-instagram</v-icon></v-btn>
        </v-card-actions>
    </v-card>

    <div class="mobile-account-center pa-4">
        <v-card outlined>
            <v-row class="text-center">
                <v-col>
                    <strong>{{$user->posts->count()}}</strong>
                    <span class="body-2">My Post</span>
                </v-col>
                <v-col>
                    <strong>{{$user->likes->count()}}</strong>
                    <span class="body-2">Saved Post</span>
                </v-col>
            </v-row>
        </v-card>

        <div class="my-post-account-page mt-4">
            <h5 class="mb-2">My Posts</h5>
            @isset($user->posts)
            @foreach($user->posts as $post)
                <v-card class="mb-3" outlined>
                    <v-card-text>
                        {{str_limit($post->body, 150, '...')}}
                        <h5 x-small outlined>{{$post->created_at->format('d M, Y')}}</h5>
                    </v-card-text>
                </v-card>
            @endforeach
            @endisset
        </div>
    </div>

    <div class="footer">@include('mobile.footer')</div>
</div>
@endsection
