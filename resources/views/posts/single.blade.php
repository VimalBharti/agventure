@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}">
@endsection

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
                            {{ $post->user->name }}
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
                        {!! nl2br(e($post->about)) !!}
                    </div>
                </v-container>

                <div class="gallery">
                    @foreach($images as $image)
                        <a href="/storage/uploads/{{$image->filename}}" data-lightbox="mygallery">
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
                        </a>
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
                <v-list two-line class="pb-0">
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
                <v-card-text class="pt-0">
                    <div>{{$post->user->about}}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        color="teal"
                        dark
                        block
                        class="text-capitalize"
                    >
                        View Profile
                    </v-btn>
                </v-card-actions>
            </v-card>

            <div class="comment-view mt-5">
                @include('Comments.commentDesktop')
            </div>
        </v-col>
    </v-row>
@endsection

@section('script')
    <script src="{{asset('js/lightbox.js')}}"></script>
@endsection