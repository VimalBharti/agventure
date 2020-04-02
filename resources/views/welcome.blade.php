@extends('layouts.app')

@section('content')
    
<div class="main-container boxed-layout">
    <div class="event-list-home-page">
        <div color="grey darken-3" class="mt-2">Trending Events</div>
        <v-row>
            <v-col cols="3" v-for="n in 4">
                <v-card>
                    <v-img
                        src="https://cdn.vuetifyjs.com/images/cards/plane.jpg"
                        height="180"
                        class="align-end white--text pl-3 pb-3"
                        gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                    >
                        <div class="event-details-home-page">
                            <h4>Ellie Goulding</h4>
                            <div class="caption"><v-icon size="14" color="white">mdi-calendar-clock</v-icon> 25 - 25 Aug 2020</div>
                            <div class="caption"><v-icon size="14" color="white">mdi-map-marker-radius</v-icon> New Delhi, India</div>
                        </div>
                    </v-img>
                </v-card>
            </v-col>
        </v-row>
    </div>

    <v-row> 
        <v-col md="8" sm="12" xs="12" class="center-post-container">
            @include('posts.all')
        </v-col>
        
        <!-- right Sidebar -->
        @include('_partials.rightSidebar')
    </v-row>
</div>

@endsection

