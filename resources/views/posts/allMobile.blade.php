<div class="infinite-scroll">
    @foreach($posts as $post)
    <div class="single-mobile-post">
        <a href="{{route('singlePost', $post->slug)}}">
            <div class="image-box-mobile">
                @isset($post->postdetails)
                    @foreach($post->postdetails as $image)
                        <v-img
                            src="/storage/thumbnails/{{$image->thumb}}"
                            lazy-src="{{asset('images/lazy.jpg')}}"
                            class="grey lighten-2 gallery-panel"
                            aspect-ratio="1"
                        >
                            <template v-slot:placeholder>
                                <v-row class="fill-height ma-0" align="center" justify="center">
                                    <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                </v-row>
                            </template>
                        </v-img>
                    @endforeach
                @endisset
            </div>
            <div class="px-3 pt-3 body-2 grey--text text--darken-3">
                {{str_limit($post->body, 150, '...')}}
            </div>
        </a>
        <v-card-actions>
            <div class="caption grey--text pl-1">
                <v-avatar size="20">
                    <v-img
                        src="/storage/profile/{{$post->user->image}}"
                        lazy-src="{{asset('images/lazy.jpg')}}"
                        aspect-ratio="1"
                        class="grey lighten-4"
                    >
                        <template v-slot:placeholder>
                            <v-row class="fill-height ma-0" align="center" justify="center">
                                <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                            </v-row>
                        </template>
                    </v-img>
                </v-avatar>    
                {{$post->created_at->format('d M, Y')}}
            </div>
            <v-spacer></v-spacer>

            @if (Auth::check())
                <like
                    :post={{ $post->id }}
                    :favorited={{ $post->favorited() ? 'true' : 'false' }}
                ></like>
            @else
            @endif
        </v-card-actions>
    </div>
    @endforeach

    <div class="pagination-links">{{$posts->links()}}</div>
</div>
