@extends('layouts.app')

@section('content')
    
<div class="main-container boxed-layout">
    <div class="event-list-home-page">
        <div color="grey darken-3" class="mt-2">Latest Updates</div>
        <v-row>
            @foreach($updates as $update)
            <v-col cols="3">
                <v-card>
                    <v-img
                        src="{{asset('uploads/updates/' . $update->image)}}"
                        height="180"
                        class="align-end white--text pl-3 pb-3"
                        gradient="to bottom, rgba(0,0,0,.2), rgba(0,0,0,.6)"
                    >
                        <div class="updates-details-home-page">
                            <a href="{{route('singleUpdate', $update->slug)}}">
                                <h4>{{str_limit($update->title, 24, '..')}}</h4>
                                <div class="caption">{{str_limit($update->about, 50, '...')}}</div>
                            </a>
                        </div>
                    </v-img>
                </v-card>
            </v-col>
            @endforeach
        </v-row>
    </div>

    <v-row class="app-post-home-page">  
        <v-col cols="8">
            @include('posts.all')
        </v-col>
        
        <!-- right Sidebar -->
        @include('_partials.rightSidebar')
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
