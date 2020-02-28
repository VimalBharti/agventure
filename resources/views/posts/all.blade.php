@foreach($posts as $post)
<v-row class="center-post-area">
    <v-col>
        <v-card shaped flat>
            <v-card-text>
                <div class="post-auth-details border-bottom pb-3 mb-1">
                    <v-list-item>
                        <v-list-item-avatar color="grey">
                            <v-img
                                src="/storage/profile/{{$post->user->image}}"
                                lazy-src="https://picsum.photos/10/6"
                                aspect-ratio="1"
                                class="grey lighten-2"
                            ></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>
                                <v-menu
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :nudge-width="200"
                                    offset-x
                                    open-on-hover
                                >
                                    <template v-slot:activator="{ on }">
                                        <a class="auth-name" href="{{route('public-profile', $post->user->id)}}" v-on="on">
                                            {{$post->user->name}}
                                        </a>
                                    </template>

                                    <v-card max-width="344">
                                        <v-list>
                                            <v-list-item>
                                                <v-list-item-avatar>
                                                    <img src="/storage/profile/{{$post->user->image}}" alt="{{$post->user->name}}">
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-title>{{$post->user->name}}</v-list-item-title>
                                                    <v-list-item-subtitle><span>@</span>{{$post->user->username}}</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-list>

                                        <v-divider></v-divider>

                                        <v-card-text>
                                            <p>{{$post->user->about}}</p>
                                        </v-card-text>

                                        <v-divider></v-divider>

                                        <div class="public-user-hover-detail">
                                            <div class="a-link">
                                                <a href="#"><v-icon>mdi-account-check</v-icon> Connect</a>
                                            </div>
                                            <div class="a-link">
                                                <a href="#"><v-icon>mdi-message-text-outline</v-icon> Message</a>
                                            </div>
                                        </div>
                                    </v-card>
                                </v-menu>
                            </v-list-item-title>
                            <v-list-item-subtitle>{{$post->created_at->format('M, Y')}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </div>
                <div class="text--primary">
                    <p class="post-body">{{$post->body}}</p>
                    <v-row>
                        @isset($post->postdetails)
                        @if(count ($post->postdetails))
                            <v-col
                                class="d-flex child-flex img-box"
                            >
                                <v-img
                                    src="/storage/uploads/{{$post->postdetails[0]->filename}}"
                                    lazy-src=""
                                    aspect-ratio="1.7"
                                    class="grey lighten-2"
                                    v-on="on"
                                >
                                    <template v-slot:placeholder>
                                        <v-row
                                        class="fill-height ma-0"
                                        align="center"
                                        justify="center"
                                        >
                                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                        </v-row>
                                    </template>
                                </v-img>
                            </v-col>
                        @endif
                        @endisset
                        <!-- Video -->
                        @foreach ($post->videos as $video)
                            <v-col
                                class="d-flex child-flex"
                            >
                                <v-card flat tile class="d-flex">
                                    <video controls>
                                        <source src="/storage/uploads/{{$video->filename}}" type="video/mp4">
                                    </video>
                                </v-card>
                            </v-col>
                        @endforeach
                    </v-row>
                </div>
            </v-card-text>
            <v-card-actions>
                <a href="{{route('like.dislike')}}"><v-icon class="mr-1 pink--text">mdi-heart</v-icon></a> (34)
                <a href="" class="ml-3"><v-icon color="grey darken-3">mdi-share-variant</v-icon></a>
            </v-card-actions>
        </v-card>
    </v-col>
</v-row>
@endforeach