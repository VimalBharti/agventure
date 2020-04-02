@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="center-post-container">
            <div>
                <v-alert
                    color="pink"
                    border="left"
                    elevation="1"
                    colored-border
                    icon="mdi-heart"
                >
                    You have <strong>{{$counts->count()}}</strong> Saved Post.
                </v-alert>
            </div>
            <v-row>
                @forelse ($myFavorites as $myFavorite)
                <v-col cols="4">
                    <v-card class="pa-1" flat height="320">
                        <v-card-text>
                            <div class="post-auth-details border-bottom pb-3 mb-2">
                            <h3 class="indigo--text text--darken-3">Posted on:</h3>
                            <div>{{$myFavorite->created_at->format('M, Y')}}</div>
                            </div>
                            <div class="text--primary">{{str_limit($myFavorite->body, 180, '...')}}</div>
                        </v-card-text>
                        <v-card-actions>
                            <like
                                :post={{ $myFavorite->id }}
                                :favorited={{ $myFavorite->favorited() ? 'true' : 'false' }}
                            ></like>
                        </v-card-actions>
                    </v-card>
                </v-col>
                @empty
                    <p>You have no favorite posts.</p>
                @endforelse
            </v-row>
            <v-row>
                <v-col class="pagination-links ">{{$myFavorites->links()}}</v-col>
            </v-row>
        </v-col>
    
    </v-row>
@endsection
