@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/lightbox.min.css')}}">
@endsection

@section('content')

    <div class="mobile-container">
        <!-- App post Mobile screen -->
        <div class="single-post-mobile-page">
            <v-img
                class="white--text align-end"
                src="{{asset('images/post-bg.jpg')}}"
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
                <div class="community-tag">
                    @isset($post->community)
                        <v-btn outlined block small href="/c/{{$post->community->slug}}">
                            {{ $post->community->slug }}
                        </v-btn>
                    @endisset
                </div>
                <div class="audio-player-if">
                    @if(isset($post->audio))
                        <audio controls id="audio-player-mobile">
                            <source src="../storage/audio/{{$post->audio}}" type="audio/ogg">
                            <source src="../storage/audio/{{$post->audio}}" type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>
                    @endif
                </div>
                <div class="about-post px-3 py-3 body-2">{{$post->body}}</div>
            </div>

            <div class="comments px-3">
                @include('Comments.comment')
            </div>

            <div class="gallery px-3">
                @foreach($images as $image)
                    <a href="/storage/thumbnails/{{$image->thumb}}" data-lightbox="mygallery">
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
        </div>
        <!-- footer link bar -->
        @include('mobile.footer')
    </div>

@endsection

@section('script')
    <script src="{{asset('js/lightbox.js')}}"></script>
@endsection

