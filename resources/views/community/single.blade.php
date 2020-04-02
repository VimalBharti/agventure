@extends('layouts.app')

@section('content')
<v-container fluid class="pt-0">
    <v-row> 
        <v-col class="single-community">
            <v-card outlined tile>
                <v-img
                    class="white--text align-end"
                    height="100px"
                    src="../storage/community/{{$community->image}}"
                    gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                >
                </v-img>
                <v-container>
                    <v-row>
                        <v-col cols="3">
                            <v-card shaped>
                                <v-img src="../storage/community/{{$community->image}}" aspect-ratio="1"></v-img>
                            </v-card>
                        </v-col>
                        <v-col cols="9">
                            <h2>{{$community->title}}</h2>
                            <div class="grey--text caption">Community Created: {{$community->created_at->format('d M, Y')}}</div>
                            <p class="mt-2">{{$community->about}}</p>
                            <v-card shaped max-width="200" class="pa-6" outlined>
                                <h3>Total Post: {{$counts->count()}}</h3>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-divider class="mt-4 mb-4"></v-divider>
                    <v-row>
                        @foreach($posts as $post)
                            <v-col md="4">
                                <div class="single-community-post">
                                    <v-list-item>
                                        <v-list-item-avatar color="grey">
                                            <v-img
                                                src="../storage/profile/{{ $post->user->image }}"
                                                lazy-src="images/lazy.jpg"
                                                aspect-ratio="1"
                                                class="grey lighten-2"
                                            ></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title>
                                                <a href="{{route('public-profile', $post->user->username)}}" class="auth-name">{{ $post->user->name }}</a>
                                            </v-list-item-title>
                                            <v-list-item-subtitle>
                                                {{$post->created_at}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                            @if (Auth::check())
                                                <like
                                                    :post={{ $post->id }}
                                                    :favorited={{ $post->favorited() ? 'true' : 'false' }}
                                                ></like>
                                            @else
                                                <v-btn small depressed class="white text-capitalize" href="../login">
                                                    <v-icon>mdi-bookmark-check</v-icon> save
                                                </v-btn>
                                            @endif
                                        </v-list-item-action>
                                    </v-list-item>

                                    <a href="{{route('singlePost', $post->slug)}}">
                                        <v-container>
                                            <p class="post-body">{{ $post->body }}</p>
                                        </v-container>
                                        
                                        <div class="gallery">
                                            @foreach($post->postdetails as $file)
                                            <div class="gallery-panel">
                                                <img src="../storage/uploads/{{$file->filename}}" lazy-src="images/lazy.jpg"/>
                                            </div>
                                            @endforeach
                                        </div>
                                    </a>
                                </div>
                            </v-col>
                        @endforeach
                    </v-row>
                    <v-row>
                        <v-col class="pagination-links">
                            {{ $posts->links() }}
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-col>
    </v-row>
</v-container>

@endsection

