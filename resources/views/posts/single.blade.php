@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto single-post"> 
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
                        <v-btn small depressed class="white text-capitalize" @click="addtofav()">
                            <v-icon>mdi-bookmark-check</v-icon>save
                        </v-btn>
                    </v-list-item-action>
                    <v-list-item-action>
                        <v-btn icon class="text-capitalize">
                            <v-icon>mdi-share-variant</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>

                <v-container>
                    <div class="post-body">{{ $post->body }}</div>
                </v-container>

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
                    <audio controls>
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

@endsection

