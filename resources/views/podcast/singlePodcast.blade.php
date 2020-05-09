@extends('layouts.plain')

@section('content')

<!-- 
=======================================
            Mobile Screen
=======================================
 -->

    <div class="only-mobile">
        <v-app-bar color="white" dense flat>
            <v-toolbar-title>
                <a href="/all/podcasts"><v-icon color="black">mdi-keyboard-backspace</v-icon></a>
                <span class="ml-1 grey--text text--darken-4">Agrishi</span>
                </a>
            </v-toolbar-title>
        </v-app-bar>
        <!-- App post Mobile screen -->
        <div class="single-podcast-mobile-page">
            <v-card flat>
                <v-img
                    src="https://agrishi.s3.ap-south-1.amazonaws.com/{{$podcast->image}}"
                    class="align-center text-center"
                    max-height="220"
                    gradient="to top, rgba(255,255,255,.4), rgba(255,255,255,1)"
                >
                    <v-avatar size="200" class="circle-avatar">
                        <v-img
                            src="https://agrishi.s3.ap-south-1.amazonaws.com/{{$podcast->image}}"
                            lazy-src="{{asset('images/lazy.jpg')}}"
                        ></v-img>
                    </v-avatar>
                </v-img>
                <v-card-text>
                    <div class="user-details-single-podcast">
                        <v-list two-line>
                            <v-list-item class="pl-0 pt-0">
                                <v-list-item-avatar color="teal">
                                    @if($podcast->user->image)
                                    <v-img
                                        src="/storage/profile/{{$podcast->user->image}}"
                                        lazy-src="{{asset('images/lazy.jpg')}}"
                                        aspect-ratio="1"
                                        class="grey lighten-2"
                                    >
                                        <template v-slot:placeholder>
                                            <v-row class="fill-height ma-0" align="center" justify="center">
                                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                            </v-row>
                                        </template>
                                    </v-img>
                                    @else
                                    <span class="white--text title">{{Str::limit($podcast->user->name, 1, '')}}</span>
                                    @endif
                                </v-list-item-avatar>

                                <v-list-item-content>
                                    <v-list-item-title>{{$podcast->user->name}}</v-list-item-title>
                                    <v-list-item-subtitle>
                                        <v-icon size="14" class="mr-1">mdi-calendar</v-icon>{{$podcast->created_at->format('d M, Y')}}
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </div>
                    <div>{{$podcast->about}}</div>
                </v-card-text>
            </v-card>
            <div class="audio-player-single">
                <audio class="listen" preload="none" controls>
                    <source src="https://agrishi.s3.ap-south-1.amazonaws.com/{{$podcast->audio}}">
                </audio>
            </div>
        </div>
    </div>

@endsection