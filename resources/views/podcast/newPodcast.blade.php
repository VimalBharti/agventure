
@extends('layouts.app')

@section('content')

<div class="main-container new-podcast-page">
    <div class="bg-img">
        <img src="{{asset('images/podcast.png')}}" />
    </div>
    <v-row>
        <v-col cols="4" class="mx-auto mt-10">
            <v-card>
                <v-card-text>
                <p class="title text--primary">Add Audio Podcast</p>
                <p>Upload audio podcast about this post, So people can listen the process or techniques in audio format.</p>
                
                <form action="/new/podcast" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <v-textarea
                        required
                        name="about"
                        label="About Podcast..."
                        outlined
                        rows="4"
                        auto-grow
                        ></v-textarea>
                    </div>

                    <!-- Audio -->
                    <div class="text--primary audio-file-input">
                        <v-file-input
                            color="deep-purple accent-4"
                            counter
                            label="Select mp3 file"
                            dense
                            placeholder="Upload Audio Podcast"
                            prepend-icon="mdi-music"
                            outlined
                            name="audio"
                            :show-size="1000"
                            accept="audio/mp3"
                        >
                        </v-file-input>

                        <!-- Featured Image -->
                        <v-file-input
                            accept="image/png, image/jpeg, image/bmp"
                            placeholder="Select featured Image"
                            prepend-icon="mdi-camera"
                            label="Upload jpg, png"
                            name="image"
                        ></v-file-input>
                    </div>
                    </v-card-text>
                    <v-card-actions class="pa-5">
                        <v-btn outlined color="teal" block type="submit">Submit Podcast</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-col>
    </v-row>
</div>

@endsection
