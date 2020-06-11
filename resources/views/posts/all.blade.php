
@foreach($posts as $post)
<v-row class="center-post-area">
    <v-col class="pt-0 mb-2">
        <v-card class="box-shadow" flat>

            <div class="photoset square portrait">
                @isset($post->video)
                    <video src="https://d158vexbkkk4m1.cloudfront.net/{{$post->video}}" controls></video>
                @endif

                @isset($post->postdetails)
                    @foreach($post->postdetails as $image)
                        <a class="photo" href="{{route('singlePost', $post->slug)}}">
                            <v-img
                                src="/storage/thumbnails/{{$image->thumb}}"
                            ></v-img>
                        </a>
                    @endforeach
                @endisset
                @if(count($post->postdetails) > 3)
                    <span class="images-count"> + {{count($post->postdetails)}}</span>
                @endif
            </div>

            <v-list-item>
                <v-list-item-avatar color="grey">
                    @if($post->user->image)
                    <v-img
                        src="/storage/profile/{{$post->user->image}}"
                        lazy-src="{{asset('images/lazy.jpg')}}"
                        aspect-ratio="1"
                        class="grey lighten-2"
                    >
                        <template v-slot:placeholder>
                            <v-row class="fill-height ma-0" align="center" justify="center">
                                <v-img src="{{asset('images/logoBox.png')}}"></v-img>
                            </v-row>
                        </template>
                    </v-img>
                    @else
                    <span class="white--text title">{{Str::limit($post->user->name, 1, '')}}</span>
                    @endif
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title>
                        <a class="auth-name">
                            {{$post->user->name}}
                        </a>
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
                    <div class="mr-2">
                        <a href="{{route('singlePost', $post->slug)}}">
                            <v-icon size="22" color="grey">mdi-comment-outline</v-icon>
                        </a>
                        <span class="grey--text ml-1">{{$post->comments->count()}}</span>
                    </div>
                    <!-- Save post Icon -->
                    @if (Auth::check())
                        <like
                            :post={{ $post->id }}
                            :favorited={{ $post->favorited() ? 'true' : 'false' }}
                        ></like>
                    @else
                        <v-btn small depressed icon href="login">
                            <v-icon color="grey">mdi-heart-outline</v-icon>
                        </v-btn>
                    @endif
                    <span class="grey--text ml-1">{{$post->likes->count()}}</span>
                </v-card-actions>
            </v-list-item>
            
            @isset($post->about)
                <div class="post-body">
                    <a href="{{route('singlePost', $post->slug)}}">
                        {{str_limit($post->about, 250, '...')}}
                    </a>
                </div>
            @endisset

        </v-card>
    </v-col>
</v-row>
@endforeach

<div class="pagination-links">{{$posts->links()}}</div>