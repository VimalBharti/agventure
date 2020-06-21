@extends('layouts.app')

@section('content')
<v-row class="main-container boxed-layout">
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
                <v-card height="200px">
                    <v-card-text>
                        <div class="post-auth-details border-bottom pb-3 mb-2">
                            <span class="indigo--text text--darken-3">Posted on:</span> 
                            {{$myFavorite->created_at->format('M, Y')}}
                        </div>
                        <div>
                            <a class="text--primary" href="{{route('singlePost', $myFavorite->slug)}}">
                                {{str_limit($myFavorite->about, 100, '...')}}
                            </a>
                        </div>
                    </v-card-text>
                    <v-card-actions class="pt-0">
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

<!--
===========================
    Mobile Screen 
===========================
-->
<div class="mobile-container pb-6">
    <div class="saved-post-mobile pa-3">
        @forelse ($myFavorites as $myFavorite)
            <v-card class="pa-1 mb-3">
                <v-card-actions>
                    <div class="body-2">{{$myFavorite->user->name}}, </div>
                    <h5>{{$myFavorite->created_at->format('M, Y')}}</h5>
                    <v-spacer></v-spacer>
                    <like
                        :post={{ $myFavorite->id }}
                        :favorited={{ $myFavorite->favorited() ? 'true' : 'false' }}
                    ></like>
                </v-card-actions>
                <v-divider></v-divider>
                <div class="body-2 pa-2 grey--text text--darken-3">{{str_limit($myFavorite->about, 180, '...')}}</div>
            </v-card>
        @empty
            <p>You have no favorite posts.</p>
        @endforelse
    </div>

    <div class="footer">@include('mobile.footer')</div>
</div>

@endsection
