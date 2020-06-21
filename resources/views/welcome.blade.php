@extends('layouts.app')

@section('content')
    
<div class="main-container boxed-layout">

    <v-row class="app-post-home-page">  
        <v-col cols="8">
            @include('posts.all')
        </v-col>
        
        <!-- right Sidebar -->
        <v-col cols="4" class="right-sidebar d-none d-md-block d-lg-block">
            @include('_partials.rightSidebar')
        </v-col>
    </v-row>
</div>

<div class="mobile-container">
    <!-- App post Mobile screen -->
    <div class="app-post-mobile-page">
        @include('posts.allMobile')
    </div>
    <!-- footer link bar -->
    @include('mobile.footer')
</div>

@endsection
