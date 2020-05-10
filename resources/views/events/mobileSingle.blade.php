@extends('layouts.plain')

@section('content')

<div class="mobile-single-event-page">
    <div class="top-brief-details">
        <v-img
            class="white--text align-end"
            max-height="220px"
            src="/storage/events/{{$event->image}}"
            gradient="to top right, rgba(0,0,0,.5), rgba(0,0,0,.9)"
        >
            <v-container>
                <v-row class="px-2">
                    <v-col>
                        <div class="mb-2">
                            <v-chip color="pink" label text-color="white" small>
                                Vermicomspost
                            </v-chip>
                        </div>
                        <h3 class="mb-2">{{$event->title}}</h3>
                        <h5 class="mb-2"><v-icon size="18" color="white">mdi-calendar-clock</v-icon> {{$event->date}} </h5>
                        <h5 class="mb-2"><v-icon size="18" color="white">mdi-map-marker-radius</v-icon> {{$event->location}}</h5>
                        <v-chip color="grey" x-small outlined label text-color="white">Entry:  {{$event->fees}}</v-chip>
                    </v-col>
                </v-row>
            </v-container>
        </v-img>
    </div>
    
    <div class="organized-by">
        <v-app-bar flat dense color="white">
            <v-toolbar-subtitle> Organized By: {{$event->user->name}}</v-toolbar-subtitle>
            <v-spacer></v-spacer>
            <v-btn icon><v-icon>mdi-telegram</v-icon></v-btn>
        </v-app-bar>
    </div>

    <v-divider></v-divider>
    
    <div class="all-details-event">
        <v-card>
            @if ($message = Session::get('success'))
                <v-alert text dense color="teal" icon="mdi-check-all" border="left">
                    {{ $message }}
                </v-alert>
            @endif
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
        <v-card class="mt-3" flat>
            <v-card-text>
                <v-row>
                    <v-col cols="6">
                        <h3>Venue</h3>
                        <div>{{$event->date}}</div>
                        <div>{{$event->location}}</div>
                    </v-col>
                    <v-col cols="6">
                        <h3>Timings</h3>
                        <div>{{$event->timming}}</div>
                    </v-col>
                </v-row>
            </v-card-text>

            <!-- Enroll Button -->
            <v-card-actions>
                <v-dialog v-model="enrollNow" fullscreen hide-overlay transition="dialog-top-transition">
                    <template v-slot:activator="{ on }">
                        <v-btn block color="teal" dark v-on="on">Interested</v-btn>
                    </template>

                    <!-- Enroll form -->
                    <v-card class="pt-3" flat> 
                        <v-toolbar flat color="transparent" class="mb-4">
                            <v-btn icon @click="enrollNow = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-toolbar>

                        <v-card-text class="pa-3">
                            <h2 class="text--primary">Fill Form if Interested</h2>
                            <p class="caption">Kindly send your details, so we can contact you for enrollment.</p>

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
                </v-dialog>

            </v-card-actions>
        </v-card>
    </div>
</div>

    @include('mobile.footer')

@endsection

