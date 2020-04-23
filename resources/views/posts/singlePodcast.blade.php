@extends('layouts.admin')

@section('content')

<!-- 
=======================================
            Mobile Screen
=======================================
 -->

    <div class="mobile-container">
        <v-app-bar color="white" dense flat>
            <v-toolbar-title>
                <a href="/"><v-icon color="black">mdi-keyboard-backspace</v-icon></a>
                <span class="ml-1 grey--text text--darken-4">Agrishi</span>
                </a>
            </v-toolbar-title>
        </v-app-bar>
        <!-- App post Mobile screen -->
        <div class="single-podcast-mobile-page">
            <v-card flat>
                <v-img
                    src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"
                    class="align-center text-center"
                    max-height="220"
                    gradient="to top, rgba(255,255,255,.4), rgba(255,255,255,1)"
                >
                    <v-avatar size="200" class="circle-avatar">
                        <v-img
                            src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"
                            lazy-src="../images/lazy.jpg"
                        ></v-img>
                    </v-avatar>
                </v-img>
                <v-card-text>
                    <div class="user-details-single-podcast">
                        <v-list two-line>
                            <v-list-item class="pl-0 pt-0">
                                <v-list-item-avatar>
                                    <v-img
                                        src="/storage/profile/{{$post->user->image}}"
                                        lazy-src="{{asset('images/lazy.jpg')}}"
                                    ></v-img>
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title>{{$post->user->name}}</v-list-item-title>
                                    <v-list-item-subtitle>
                                        <v-icon size="14" class="mr-1">mdi-calendar</v-icon>{{$post->created_at->format('d M, Y')}}
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </div>
                    <div>{{$post->body}}</div>
                </v-card-text>
            </v-card>
            <div class="audio-player-single">
                <audio controls src="/storage/audio/{{$post->audio}}"></audio>
            </div>
        </div>
    </div>

@endsection

