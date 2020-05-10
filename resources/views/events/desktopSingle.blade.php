@extends('layouts.app')

@section('content')

<div class="single-event-page">
    <v-row>  
        <v-col class="single-event">
            <v-img
                class="white--text align-end"
                max-height="255px"
                src="/storage/events/{{$event->image}}"
                gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
            >
                <v-row class="boxed-layout">
                    <v-col cols="3">
                        <v-card shaped>
                            <v-img src="/storage/events/{{$event->image}}" aspect-ratio="1"></v-img>
                        </v-card>
                    </v-col>
                    <v-col cols="9">
                        <div>
                            <v-chip color="pink" label small text-color="white">
                                <v-icon left>mdi-label</v-icon> Event
                            </v-chip>
                        </div>
                        <h1>{{$event->title}}</h1>
                        <h3><v-icon size="18" color="white">mdi-calendar-clock</v-icon> {{$event->date}} </h3>
                        <h3><v-icon size="18" color="white">mdi-map-marker-radius</v-icon> {{$event->location}}</h3>
                        <v-chip color="grey" outlined label text-color="white">
                            {{$event->fees}}
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
                    <v-toolbar-title> Organized By: {{$event->user->name}}</v-toolbar-title>
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
                    <h3>{{$event->title}}</h3>
                    <p>{{$event->about}}</p>
                    <h3>Highlights</h3>
                    <ul class="mt-3">
                        <li>{{$event->highlightA}}</li>
                        <li>{{$event->highlightB}}</li>
                        <li>{{$event->highlightC}}</li>
                    </ul>
                    <v-chip class="ma-2" color="success" outlined small>
                        {{$event->fees}}
                    </v-chip>
                </v-card-text>
            </v-card>
            <v-card class="mt-3">
                <v-card-text>
                    <v-row>
                        <v-col cols="4">
                            <h3>Venue</h3>
                            <div>{{$event->date}}</div>
                            <div>{{$event->location}}</div>
                        </v-col>
                        <v-col cols="4">
                            <h3>Timings</h3>
                            <div>{{$event->timming}}</div>
                        </v-col>
                        <v-col cols="4">
                            <h3>Entry Fees</h3>
                            <div>{{$event->fees}}</div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col cols="4">
            <v-card class="pa-3">
                <v-card-text>
                    <h2 class="text--primary">Fill Form if Interested</h2>
                    <p class="caption">Kindly send your details, so we can contact you for enrollment.</p>
                        @if ($message = Session::get('success'))
                            <v-alert text dense color="teal" icon="mdi-check-all" border="left">
                                {{ $message }}
                            </v-alert>
                        @endif
                    <form action="/event/enrollNow" method="POST">
                    @csrf
                        <input value="{{$event->user->id}}" name="auth_id" type="hidden">
                        <input value="{{$event->id}}" name="event_id" type="hidden">
                        <v-text-field
                            name="title"
                            readonly
                            value="{{$event->title}}"
                        ></v-text-field>

                        <v-text-field
                            name="name"
                            label="Name"
                            required
                        ></v-text-field>

                        <v-text-field
                            name="email"
                            label="E-mail"
                            type="email"
                        ></v-text-field>

                        <v-text-field
                            name="phone"
                            label="Phone Number"
                            required
                            counter="10"
                        ></v-text-field>

                        <v-btn
                            block
                            color="secondary"
                            class="mt-5"
                            type="submit"
                        >
                            Send details
                        </v-btn>
                    </form>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</div>

@endsection

