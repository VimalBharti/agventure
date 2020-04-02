@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="center-post-container">
            <v-card
                class="mx-auto grey lighten-5 box-shadow"
                flat
            >
                <v-card-title
                    class="title white"
                    primary-title
                    >
                    <span>My account</span>
                    <v-spacer></v-spacer>
                    <v-btn dark dense small depressed color="cyan" href="{{route('editaccount')}}"> Edit</v-btn>
                </v-card-title>
                <v-card-text>
                    <div class="mt-6 text-uppercase">User Information</div>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Name"
                                    outlined
                                    value="{{$user->name}}"
                                    disabled
                                    color="primary"
                                    background-color="white"
                                ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Email address"
                                    outlined
                                    color="primary"
                                    disabled
                                    value="{{$user->email}}"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Contact no."
                                    outlined
                                    disabled
                                    value="{{$user->mobile}}"
                                    color="primary"
                                    background-color="white"
                                ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6">
                                <v-text-field
                                    label="Username"
                                    outlined
                                    disabled
                                    value="{{$user->username}}"
                                    color="primary"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                        <v-divider></v-divider>

                    <div class="mt-6 text-uppercase">Contact Information</div>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                    label="City"
                                    outlined
                                    disabled
                                    color="primary"
                                    value="{{$user->city}}"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                    label="State"
                                    outlined
                                    disabled
                                    color="primary"
                                    value="{{$user->state}}"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                    label="Country"
                                    outlined
                                    disabled
                                    color="primary"
                                    value="{{$user->country}}"
                                    background-color="white"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                        <v-divider></v-divider>

                    <div class="mt-6 text-uppercase">About</div>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="12">
                                <v-textarea
                                    label="About me"
                                    background-color="white"
                                    outlined
                                    value="{{$user->about}}"
                                    disabled
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
@endsection
