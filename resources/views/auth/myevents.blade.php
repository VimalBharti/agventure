@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="center-post-container">
            <v-card class="mx-auto grey lighten-5 box-shadow" flat>
                <v-card-title class="title white" primary-title>
                    <span>My Events</span>
                    <v-spacer></v-spacer>
                    <v-icon color="purple" size="36">mdi-plus-box</v-icon>
                    <v-btn outlined dark small depressed color="purple" href="{{route('editaccount')}}"> 
                         Add New Event
                    </v-btn>
                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col>
                            <v-card href="{{route('singleEvent')}}">
                                <div class="d-flex flex-no-wrap justify-space-between">
                                    <div>
                                        <v-card-title class="headline">Ellie Goulding</v-card-title>
                                        <v-card-subtitle>
                                            <v-icon size="18" color="grey">mdi-calendar-clock</v-icon> 25 - 25 Aug 2020 <br>
                                            <v-icon size="18" color="grey">mdi-map</v-icon> New Delhi, India
                                        </v-card-subtitle>
                                        <v-divider></v-divider>
                                        <v-card-subtitle>
                                            AgWeb is the farmer’s source for agriculture news online. Stay informed with daily content from across Farm Journal's properties. We'll supply the latest news on crop and livestock farming, live future trading information, weather forecasts, market analysis, ag policy and more.
                                        </v-card-subtitle>
                                    </div>
                                    <v-avatar
                                        class=""
                                        size="180"
                                        tile
                                    >
                                        <v-img src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"></v-img>
                                    </v-avatar>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
    
    </v-row>
@endsection
