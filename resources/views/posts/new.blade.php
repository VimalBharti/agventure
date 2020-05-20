
@extends('layouts.app')

@section('content')

<div class="main-container new-post-page">
    <div class="bg-img">
        <img src="{{asset('images/hero-bg.png')}}" />
    </div>

    <v-row>
        <v-col cols="6" class="mx-auto"> 
            <v-tabs
                centered
                grow
                color="teal"
            >
                <v-tab class="text-capitalize">
                    <v-icon size="18" class="mr-2">mdi-camera</v-icon>
                     Add Image Post
                </v-tab>
                <v-tab class="text-capitalize">
                    <v-icon size="18" class="mr-2">mdi-video</v-icon>
                    Add Video Post
                </v-tab>

                <v-tab-item>
                    <image-upload :user="{{ Auth::user() }}"></image-upload>
                </v-tab-item>

                <v-tab-item>
                    <video-upload :user="{{ Auth::user() }}"></video-upload>
                </v-tab-item>
            </v-tabs>
        </v-col>
    </v-row>
</div>

@endsection
