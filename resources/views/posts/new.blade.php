
@extends('layouts.app')

@section('content')

<div class="main-container new-post-page">
    <div class="bg-img">
        <img src="{{asset('images/post.png')}}" />
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
                    All Video Post
                </v-tab>

                <v-tab-item>
                    <image-upload :user="{{ Auth::user() }}"></image-upload>
                </v-tab-item>

                <v-tab-item>
                    <v-row>
                        <v-col cols="6" class="mx-auto"> 
                            <form method="post" action="{{ route('upload-new-video') }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="video-title">About Post</label>
                                    <input type="text"
                                        class="form-control"
                                        name="about"
                                        placeholder="Enter video title">
                                    @if($errors->has('about'))
                                        <span class="text-danger">
                                            {{$errors->first('about')}}
                                        </span>
                                    @endif
                                </div>
                    
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Video File</label>
                                    <input type="file" class="form-control-file" name="video">
                    
                                    @if($errors->has('video'))
                                        <span class="text-danger">
                                            {{$errors->first('video')}}
                                        </span>
                                    @endif
                                </div>
                    
                                <div class="form-group">
                                    <input type="submit" class="btn btn-default">
                                </div>
                    
                                {{csrf_field()}}
                            </form>
                        </v-col>
                    </v-row>
                </v-tab-item>
            </v-tabs>
        </v-col>
    </v-row>
</div>

@endsection
