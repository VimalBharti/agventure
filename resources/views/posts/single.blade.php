@extends('layouts.app')

@section('content')
    <v-row class="main-container boxed-layout single-post"> 
        <v-col md="8" sm="12" class="center-post-container">
            <v-card flat>
                <v-list-item>
                    <v-list-item-avatar color="grey">
                        <v-img
                            src="/storage/profile/{{$post->user->image}}"
                            lazy-src="../images/lazy.jpg"
                            aspect-ratio="1"
                            class="grey lighten-2"
                        ></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>
                            <a class="auth-name">{{ $post->user->name }}</a>
                        </v-list-item-title>
                        <v-list-item-subtitle>{{ $post->created_at }}</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                        @isset($post->community)
                        <v-btn outlined small href="/c/{{$post->community->slug}}">
                            {{ $post->community->slug }}
                        </v-btn>
                        @endisset
                    </v-list-item-action>
                    <v-list-item-action>
                        @if (Auth::check())
                            <like
                                :post={{ $post->id }}
                                :favorited={{ $post->favorited() ? 'true' : 'false' }}
                            ></like>
                        @else
                            <v-btn small depressed class="white text-capitalize" href="login">
                                <v-icon>mdi-heart</v-icon>
                            </v-btn>
                        @endif
                    </v-list-item-action>
                </v-list-item>

                <v-container>
                    <div class="post-body">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </v-container>

                <div class="gallery">
                    @foreach($images as $image)
                        <v-img
                            src="/storage/thumbnails/{{$image->thumb}}"
                            lazy-src="{{asset('images/lazy.jpg')}}"
                            class="grey lighten-2 gallery-panel"
                        >
                            <template v-slot:placeholder>
                                <v-row class="fill-height ma-0" align="center" justify="center">
                                    <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                </v-row>
                            </template>
                        </v-img>
                    @endforeach
                </div>

            </v-card>
        </v-col>
        
        <!-- right Sidebar -->
        <v-col md="4">
            @if(isset($post->audio))
            <v-card
                class="mb-4"
            >   
                <v-card-text>
                    <h3>Listen podcast</h3>
                    <div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe perferendis numquam</div>
                </v-card-text>
                <v-card-actions>
                    <audio controls preload="auto">
                        <source src="../storage/audio/{{$post->audio}}" type="audio/ogg">
                        <source src="../storage/audio/{{$post->audio}}" type="audio/mpeg">
                        Your browser does not support the audio tag.
                    </audio>
                </v-card-actions>
            </v-card>
            @endif
            <v-card>
                <v-list two-line>
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img
                            src="/storage/profile/{{$post->user->image}}"
                            lazy-src="../images/lazy.jpg"
                            ></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>{{$post->user->name}}</v-list-item-title>
                            <v-list-item-subtitle>Joined: {{$post->user->created_at->format('M, Y')}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <v-card-text>
                    <div>{{$post->user->about}}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        color="deep-purple accent-4"
                        dark
                        block
                        class="text-capitalize"
                    >
                        Follow
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>

<!-- 
=======================================
            Mobile Screen
=======================================
 -->

    <div class="mobile-container">
        <!-- App post Mobile screen -->
        <div class="single-post-mobile-page">
            <v-img
                class="white--text align-end"
                src="{{asset('images/post-bg.png')}}"
                lazy-src="{{asset('images/lazy.jpg')}}"
                gradient="to bottom, rgba(0,0,0,.4), rgba(0,0,0,.8)"
                height="90"
            >
                <v-list two-line color="transparent" dark>
                    <v-list-item>
                        <v-list-item-avatar size="45">
                            <v-img
                                src="/storage/profile/{{$post->user->image}}"
                                lazy-src="{{asset('images/lazy.jpg')}}"
                                aspect-ratio="1"
                            ></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>{{$post->user->name}}</v-list-item-title>
                            <v-list-item-subtitle>{{$post->created_at->format('d M, Y')}}</v-list-item-subtitle>
                        </v-list-item-content>
                        <div class="like-btn-box">
                            @if (Auth::check())
                            <like
                                :post={{ $post->id }}
                                :favorited={{ $post->favorited() ? 'true' : 'false' }}
                            ></like>
                            @else
                            @endif
                        </div>
                    </v-list-item>
                </v-list>
            </v-img>

            <div class="mobile-single-post-details">
                <div class="audio-player-if">
                    @if(isset($post->audio))
                        <audio controls>
                            <source src="../storage/audio/{{$post->audio}}" type="audio/ogg">
                            <source src="../storage/audio/{{$post->audio}}" type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>
                    @endif
                </div>
                <div class="community-tag">
                    @if(isset($post->community))
                        <v-btn outlined x-small dark class="text-capitalize">{{$post->community->title}}</v-btn>
                    @endif
                </div>
                <div class="about-post pa-2">{{$post->body}}</div>
            </div>

            <div class="gallery">
                @foreach($images as $image)
                    <v-img
                        src="/storage/uploads/{{$image->filename}}"
                        lazy-src="{{asset('images/lazy.jpg')}}"
                        class="grey lighten-2 gallery-panel"
                    >
                        <template v-slot:placeholder>
                            <v-row class="fill-height ma-0" align="center" justify="center">
                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                            </v-row>
                        </template>
                    </v-img>
                @endforeach
            </div>
        </div>
        <!-- footer link bar -->
        @include('mobile.footer')
    </div>

@endsection

