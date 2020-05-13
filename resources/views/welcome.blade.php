@extends('layouts.app')

@section('content')
    
<div class="main-container">
    <v-container>
        <v-row class="app-post-home-page">  
            <v-col md="8">
                @include('posts.all')
            </v-col>
            
            <!-- right Sidebar -->
            @include('_partials.rightSidebar')
        </v-row>
    </v-container>
</div>

@endsection
