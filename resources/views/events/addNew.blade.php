@extends('layouts.app')

@section('content')
<v-container>
    <v-row class="mobile-container">
        <v-col class="add-new-event">
            <v-card class="pb-7" flat>
                <v-card-text>
                    <h3 class="mb-6">Add New Events</h3>
                    <form action="/add/new-event" method="POST" enctype="multipart/form-data">
                    @csrf
                        <!-- title -->
                        <v-text-field
                            label="Event Title"
                            name="title"
                            outlined
                            dense
                        ></v-text-field>
                        <!-- about -->
                        <v-textarea
                            outlined
                            name="about"
                            label="About Event"
                            auto-grow
                            rows="3"
                        ></v-textarea>
                        <!-- image -->
                        <v-file-input accept="image/*" label="upload Featured Image" outlined dense name="image"></v-file-input>
                        <!-- date -->
                        <v-text-field
                            label="Date"
                            name="date"
                            placeholder="25 - 25 Aug 2020"
                            outlined
                            dense
                        ></v-text-field>
                        <!-- location -->
                        <v-text-field
                            label="Location"
                            name="location"
                            placeholder="Bangalore, India"
                            outlined
                            dense
                        ></v-text-field>
                        <!-- fees -->
                        <v-text-field
                            label="fees"
                            name="fees"
                            placeholder="Free Entry, 300 Rs/-"
                            outlined
                            dense
                        ></v-text-field>
                        <!-- timming -->
                        <v-text-field
                            label="timming"
                            name="timming"
                            placeholder="10:00 AM - 5:00 PM"
                            outlined
                            dense
                        ></v-text-field>
                        <!-- highlightA -->
                        <v-textarea
                            outlined
                            name="highlightA"
                            label="Highlight Point 1"
                            placeholder="Driven by facing Industry 4.0, to figure out the demand for change for the future society."
                            auto-grow
                            rows="3"
                        ></v-textarea>
                        <!-- highlightB -->
                        <v-textarea
                            outlined
                            name="highlightB"
                            label="Highlight Point 2"
                            placeholder="The expo will present a paradigm for the renewable energy industry & prepare for climate change."
                            auto-grow
                            rows="3"
                        ></v-textarea>
                        <!-- highlightC -->
                        <v-textarea
                            outlined
                            name="highlightC"
                            label="Highlight Point 3"
                            placeholder="Need to secure competitiveness in developing renewable energy industry technologies"
                            auto-grow
                            rows="3"
                        ></v-textarea>
                        <v-btn dark block color="teal" type="submit">Post Event</v-btn>
                    </form>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</v-container>
@endsection
