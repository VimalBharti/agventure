@extends('layouts.app')

@section('content')
    <v-row class="main-container">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="10" class="grey lighten-5 center-post-container">
            <v-container>
                <v-row>
                    <v-col cols="8">
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
                    <v-col cols="4">
                    <v-card
                            class="mx-auto"
                        >
                            <v-img
                                src="/storage/profile/{{Auth::user()->image}}"
                                height="300px"
                                dark
                                class="align-end"
                            >
                                <form enctype="multipart/form-data" action="{{ route('avatar.update') }}" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="avatar" id="files" style="display:none;" onchange='this.form.submit();'>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <label for="files" class="save-btn box-shadow">
                                        Change Photo
                                    </label>
                                </form>
                            </v-img>

                            <v-list two-line>
                                <v-list-item @click="">
                                    <v-list-item-icon>
                                        <v-icon color="indigo">mdi-account-multiple-plus</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>34</v-list-item-title>
                                        <v-list-item-subtitle>Connections</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-divider inset></v-divider>

                                <v-list-item @click="">
                                    <v-list-item-icon>
                                    <v-icon color="indigo">mdi-video</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                    <v-list-item-title>{{count($user->posts)}}</v-list-item-title>
                                    <v-list-item-subtitle>Total Post</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-divider inset></v-divider>

                                <v-list-item @click="">
                                    <v-list-item-icon>
                                    <v-icon color="indigo">mdi-map-marker</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                    <v-list-item-title>1400 Main Street</v-list-item-title>
                                    <v-list-item-subtitle>Orlando, FL 79938</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-col>
    
    </v-row>
@endsection
