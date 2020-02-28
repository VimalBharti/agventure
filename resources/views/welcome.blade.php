@extends('layouts.app')

@section('content')
    <v-row class="main-container">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col md="6" sm="12" class="grey lighten-5 center-post-container">
            <v-container>
                <!-- Top-Tabs -->
                @include('posts.new')

                <!-- center post area -->
                <all-post></all-post>
            </v-container>
        </v-col>
        
        <!-- right Sidebar -->
        @include('_partials.rightSidebar')
    </v-row>
@endsection

