@foreach($posts as $post)
<v-row class="center-post-area">
    <v-col class="pt-0 mb-2">
        <v-card flat>
            <v-list-item>
                <v-list-item-avatar color="grey">
                    <v-img
                        src="/storage/profile/{{$post->user->image}}"
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
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>
                        <a class="auth-name" href="{{route('public-profile', $post->user->username)}}">{{$post->user->name}}</a>
                        @isset($post->community)
                        <span>
                            <v-icon color="grey darken-2">mdi-menu-right</v-icon>
                            <span class="posted-text">posted on:</span>
                            <a
                                href="/c/{{$post->community->slug}}"
                                class="community-name"
                            >{{ $post->community->slug }}</a>
                        </span>
                        @endisset
                    </v-list-item-title>
                    <v-list-item-subtitle>{{$post->created_at->format('d M, Y')}}</v-list-item-subtitle>
                </v-list-item-content>
                <v-card-actions>
                    @if (Auth::check())
                        <like
                            :post={{ $post->id }}
                            :favorited={{ $post->favorited() ? 'true' : 'false' }}
                        ></like>
                    @else
                        <v-btn small depressed class="white text-capitalize" href="login">
                            <v-icon>mdi-bookmark-check</v-icon> save
                        </v-btn>
                    @endif
                </v-card-actions>
            </v-list-item>

            <a href="{{route('singlePost', $post->slug)}}">
                @isset($post->body)
                    <div class="post-body">{{$post->body}}</div>
                @endisset

                <div class="gallery">
                @isset($post->postdetails)
                    @foreach($post->postdetails as $image)
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
                @endisset
                </div>
            </a>
        </v-card>
    </v-col>
</v-row>
@endforeach

<div class="pagination-links">{{$posts->links()}}</div>