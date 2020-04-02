@extends('layouts.app')

@section('content')

<div class="single-event-page">
    <v-row>  
        <v-col class="single-event">
            <v-img
                class="white--text align-end"
                max-height="255px"
                src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"
                gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
            >
                <v-row class="boxed-layout">
                    <v-col cols="3">
                        <v-card shaped>
                            <v-img src="https://cdn.vuetifyjs.com/images/cards/halcyon.png" aspect-ratio="1"></v-img>
                        </v-card>
                    </v-col>
                    <v-col cols="9">
                        <div>
                            <v-chip color="pink" label text-color="white">
                                <v-icon left>mdi-label</v-icon> Vermicomspost
                            </v-chip>
                        </div>
                        <h1>Electric Power Tech Korea</h1>
                        <h3><v-icon size="18" color="white">mdi-calendar-clock</v-icon> 25 - 25 Aug 2020 </h3>
                        <h3><v-icon size="18" color="white">mdi-map-marker-radius</v-icon> New Delhi, India</h3>
                        <v-chip color="grey" small outlined label text-color="white">
                            Free Entry
                        </v-chip>
                    </v-col>
                </v-row>
            </v-img>
        </v-col>
    </v-row>

    <v-row class="white">
        <v-col>
            <div class="boxed-layout">
                <v-app-bar flat dense color="white">
                    <v-toolbar-title> Organized By: Vimal Bharti</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="grey darken-3" dark>view profile</v-btn>
                </v-app-bar>
            </div>
        </v-col>
    </v-row>

    <v-row class="boxed-layout">
        <v-col cols="8">
            <v-card>
                <v-card-text>
                    <h3>Electric Power Tech Korea</h3>
                    <p>AgWeb is the farmer’s source for agriculture news online. Stay informed with daily content from across Farm Journal's properties. We'll supply the latest news on crop and livestock farming, live future trading information, weather forecasts, market analysis, ag policy and more.</p>
                    <h3>Highlights</h3>
                    <ul class="mt-3">
                        <li>Driven by facing Industry 4.0, to figure out the demand for change for the future society</li>
                        <li>The expo will present a paradigm for the renewable energy industry & prepare for climate change.</li>
                        <li>Need to secure competitiveness in developing renewable energy industry technologies</li>
                    </ul>
                    <v-chip class="ma-2" color="success" outlined small>
                        Free Entry
                    </v-chip>
                </v-card-text>
            </v-card>
            <v-card class="mt-3">
                <v-card-text>
                    <v-row>
                        <v-col cols="4">
                            <h3>Venue</h3>
                            <div>25 - 25 Aug 2020</div>
                            <div>Pragti Maidan, Delhi</div>
                        </v-col>
                        <v-col cols="4">
                            <h3>Timings</h3>
                            <div>10:00 AM - 5:00 PM</div>
                        </v-col>
                        <v-col cols="4">
                            <h3>Entry Fees</h3>
                            <div>Free Ticket</div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col cols="4">
            <v-card class="pa-3">
                <v-card-text>
                    <h2 class="text--primary">Fill Form if Interested</h2>
                    <p>well meaning and kindly "a benevolent smile"</p>
                    <v-form>
                        <v-text-field
                            name="title"
                            label="Electric Power Tech Korea"
                        ></v-text-field>

                        <v-text-field
                            name="name"
                            label="Name"
                            required
                        ></v-text-field>

                        <v-text-field
                            name="email"
                            label="E-mail"
                            required
                        ></v-text-field>

                        <v-text-field
                            name="phone"
                            label="Phone Number"
                            counter="10"
                        ></v-text-field>

                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        outlined
                        block
                        color="deep-purple accent-4"
                    >
                        Send details
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</div>

@endsection

