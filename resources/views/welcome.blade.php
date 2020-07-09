@extends('layouts.app')

@section('content')
    

<v-container>
    <v-row class="app-post-home-page">  
        <!-- Left Sidebar -->
        <v-col md="3" class="d-none d-md-block mt-12">
            <leftsidebar></leftsidebar>
        </v-col>

        <v-col md="6" class="homepage-all-post">
            <all-post></all-post>
        </v-col>
        
        <!-- right Sidebar -->
        <v-col md="3" class="right-sidebar d-none d-md-block mt-12">
            <RightSidebar></RightSidebar>
        </v-col>
    </v-row>
</v-container>

<div class="mobile-nav only-mobile">
    @include('mobile.footer');
</div>

@endsection
