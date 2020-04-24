
@foreach($posts as $post)
    <div class="single-mobile-post box-shadow">
        <v-list two-line class="pa-0">
            <v-list-item class="px-3 py-0">
                <v-list-item-avatar>
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
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>{{$post->user->name}}</v-list-item-title>
                    <div class="caption grey--text">{{$post->created_at->format('d M, Y')}}</div>
                </v-list-item-content>
            </v-list-item>
        </v-list>
        <div class="px-3 mb-2 post-body">
            <a href="{{route('singleMobile', $post->slug)}}">{{str_limit($post->about, 200, '...')}}</a>
        </div>
        <a href="{{route('singleMobile', $post->slug)}}">
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
        </a>
        <v-card-actions class="px-8 py-2">
            <a href="{{route('singleMobile', $post->slug)}}">
                <v-icon size="22" color="grey">mdi-share-variant</v-icon>
            </a>

            <v-spacer></v-spacer>

            <a href="{{route('singleMobile', $post->slug)}}">
                <v-icon size="22" color="grey">mdi-comment-outline</v-icon>
            </a>
            <span class="grey--text ml-1">{{$post->comments->count()}}</span>

            <v-spacer></v-spacer>

            @if (Auth::check())
                <like
                    :post={{ $post->id }}
                    :favorited={{ $post->favorited() ? 'true' : 'false' }}
                ></like>
            @else
                <v-icon size="22" color="grey">mdi-heart-outline</v-icon>
            @endif
        </v-card-actions>
    </div>
@endforeach

<div class="pagination-links">{{$posts->links()}}</div>
