@extends('layouts.app')

@section('content')

<div class="not-found-page">
    <v-container>
        <v-row class="top-column">
            <v-col>
                <v-img
                    src="{{asset('images/404.svg')}}"
                    aspect-ratio="1"
                    max-height="300"
                    contain
                ></v-img>
            </v-col>
            <v-col class="pa-6">
                <h2 class="mt-10">Not Found!</h2>
                <p>Sorry, the page you were looking for doesn't exist. Please try another way or come back to the home</p>
                <v-btn outlined color="teal" href="/">Go To Home</v-btn>
            </v-col>
        </v-row>
    </v-container>
</div>

@endsection