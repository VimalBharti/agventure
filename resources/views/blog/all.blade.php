@extends('layouts.app')

@section('content')
    <v-container>
        <v-row>
            <v-col>
                <h4>Latest Blog</h4>
                <p>Latest published stories, interviews, and updates across India</p>
            </v-col>
        </v-row>
        <v-row class="blog-container">
            <v-col cols="3">
                <v-card>
                    <v-img
                    src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                    height="160px"
                    ></v-img>
                    <v-card-title>
                        Top western road trips
                        <div class="mb-3 blog-publish-date caption">27, Oct, 2002</div>
                    </v-card-title>

                    <v-card-subtitle>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam, culpa! Iure eligendi.
                    </v-card-subtitle>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
@endsection

