@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="center-post-container">
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
            {{ csrf_field() }}
                <v-card
                    class="mx-auto grey lighten-5 box-shadow"
                    flat
                >
                    <v-card-title
                        class="title white"
                        primary-title
                        >
                        <span>Edit account</span>
                        <v-spacer></v-spacer>
                        <v-btn dark small depressed color="cyan" type="submit"> 
                            <v-icon left dark>mdi-content-save</v-icon>Save Changes
                        </v-btn>
                    </v-card-title>
                    <v-card-text>
                        <div class="mt-6 text-uppercase">User Information</div>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-text-field
                                        label="Name"
                                        name="name"
                                        outlined
                                        value="{{$user->name}}"
                                        color="primary"
                                        background-color="white"
                                    ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6">
                                    <v-text-field
                                        label="Email address"
                                        name="email"
                                        outlined
                                        color="primary"
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
                                        name="mobile"
                                        value="{{$user->mobile}}"
                                        color="primary"
                                        background-color="white"
                                    ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" sm="6">
                                    <v-text-field
                                        label="Username"
                                        outlined
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
                                        name="city"
                                        outlined
                                        color="primary"
                                        value="{{$user->city}}"
                                        background-color="white"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <v-text-field
                                        label="State"
                                        outlined
                                        name="state"
                                        color="primary"
                                        value="{{$user->state}}"
                                        background-color="white"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="4">
                                    <v-text-field
                                        label="Country"
                                        name="country"
                                        outlined
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
                                        name="about"
                                        background-color="white"
                                        outlined
                                        value="{{$user->about}}"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>
            </form>
        </v-col>
    </v-row>
@endsection
