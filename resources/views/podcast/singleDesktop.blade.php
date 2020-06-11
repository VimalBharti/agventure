@extends('layouts.admin')

@section('content')

<!-- 
=======================================
            Desktop Screen
=======================================
 -->
<v-row class="mt-5 boxed-layout">
    <div class="col-md-6">
        <v-card>
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
                        src="https://d158vexbkkk4m1.cloudfront.net/{{$podcast->image}}"
                        lazy-src="{{asset('images/lazy.jpg')}}"
                        class="align-center text-center"
                        max-height="300"
                        gradient="to top, rgba(255,255,255,.4), rgba(255,255,255,1)"
                    >
                        <v-avatar size="250" class="circle-avatar">
                            <v-img
                                src="https://d158vexbkkk4m1.cloudfront.net/{{$podcast->image}}"
                                lazy-src="{{asset('images/lazy.jpg')}}"
                            ></v-img>
                        </v-avatar>
                    </v-img>
                    <div class="audio-player-single-desktop">   
                        <audio class="audio-player" src="https://d158vexbkkk4m1.cloudfront.net/{{$podcast->audio}}" preload="auto" >
                    </div>
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
            </div>
        </v-card>
    </div>
    <div class="col-md-6">
        <v-card>
            <v-card-title>
                <div>Other Podcast by {{$podcast->user->name}}</div>
            </v-card-title>
            <v-divider></v-divider>
            @foreach($user->podcast as $audio)
                <v-row>
                    <v-col cols="2">
                        <v-img
                            src="https://d158vexbkkk4m1.cloudfront.net/{{$audio->image}}"
                            class="align-center featured-image"
                            justify="center"
                            height="32"
                        >
                            <div class="text-center">
                                <v-btn dark class="play-btn gradient-btn" elevation="1" fab small>
                                    <v-icon>mdi-play</v-icon>
                                </v-btn>
                            </div>
                        </v-img>
                    </v-col>
                    <v-col>
                        <div class="caption podcast-body">
                            <a href="">{{Str::limit($audio->about, 100, '..')}}</a>
                        </div>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
            @endforeach
        </v-card>
    </div>
</v-row>

@endsection

@section('script')
<script src="{{asset('js/audio.min.js')}}"></script>
<script>
    audiojs.events.ready(function() {
        var as = audiojs.createAll();
    });
</script>
@endsection

