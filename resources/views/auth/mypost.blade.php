@extends('layouts.app')

@section('content')
        <v-container>
    <v-row class="main-container">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="10" class="grey lighten-5 center-post-container">
                <v-row>
                    <v-col cols="8">
                        @foreach($user->posts as $post)
                        <v-card class="mb-6 pa-2" flat>
                            <v-card-text>
                                <div class="post-auth-details border-bottom pb-3 mb-2">
                                <h3 class="indigo--text text--darken-3">Posted on:</h3>
                                <div>{{$post->created_at->format('M, Y')}}</div>
                                </div>
                                <div class="text--primary">{{$post->body}}</div>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn text small>
                                    <v-icon class="mr-1">mdi-thumb-up-outline</v-icon>Like (34)
                                </v-btn>
                                <v-btn text small>
                                    <v-icon class="mr-1">mdi-message-text-outline</v-icon>Comment (12)
                                </v-btn>
                                <v-spacer></v-spacer>
                                <v-btn text small>
                                    <v-icon class="mr-1">mdi-delete</v-icon>Delete
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                        @endforeach
                    </v-col>
                    <v-col cols="4">
                        <v-card
                            class="mx-auto"
                        >
                            <v-card-text>
                                <v-img src="https://picsum.photos/510/300?random" aspect-ratio="1"></v-img>
                            </v-card-text>
                            <v-card-actions>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
        </v-col>
    
    </v-row>
            </v-container>
@endsection
