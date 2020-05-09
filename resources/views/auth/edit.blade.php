@extends('layouts.app')

@section('content')
    <v-row class="main-container boxed-layout">
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

<!--
===================================== 
            Mobile Screen 
=====================================
-->

    <div class="mobile-container pb-6 pt-3 edit-account">
        <v-card class="text-center user-image" flat>
            <v-avatar size="200">
                <v-img src="/storage/profile/{{Auth::user()->image}}" class="align-end" aspect-ratio="1">
                    <template v-slot:placeholder>
                        <v-row class="fill-height ma-0" align="center" justify="center">
                            <v-icon size="80" color="grey">mdi-image-filter</v-icon>
                        </v-row>
                    </template>
                    <form enctype="multipart/form-data" action="{{ route('avatar.update') }}" method="POST" enctype="multipart/form-data">
                        <input type="file" name="avatar" id="files" style="display:none;" onchange='this.form.submit();'>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <label for="files" class="image-upload-btn">
                            <v-icon color="white">mdi-image-filter</v-icon>  Change Photo
                        </label>
                    </form>
                </v-img>
            </v-avatar>
        </v-card>

        <div class="mobile-account-center pa-4 mb-8">
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
            {{ csrf_field() }}

                <v-text-field
                    label="Name"
                    name="name"
                    outlined
                    dense
                    value="{{$user->name}}"
                    color="primary"
                    class="body-2"
                ></v-text-field>
                <v-text-field
                    label="Email address"
                    name="email"
                    outlined
                    dense
                    color="primary"
                    value="{{$user->email}}"
                    class="body-2"
                ></v-text-field>
                <v-text-field
                    label="Contact no."
                    outlined
                    dense
                    name="mobile"
                    value="{{$user->mobile}}"
                    color="primary"
                    class="body-2"
                ></v-text-field>
                <v-text-field
                    label="City"
                    name="city"
                    outlined
                    dense
                    color="primary"
                    value="{{$user->city}}"
                    class="body-2"
                ></v-text-field>
                <v-text-field
                    label="State"
                    outlined
                    dense
                    name="state"
                    color="primary"
                    class="body-2"
                    value="{{$user->state}}"
                    background-color="white"
                ></v-text-field>
                <v-text-field
                    label="Country"
                    name="country"
                    outlined
                    dense
                    color="primary"
                    class="body-2"
                    value="{{$user->country}}"
                    background-color="white"
                ></v-text-field>
                <v-textarea
                    label="About me"
                    name="about"
                    dense
                    class="body-2"
                    background-color="white"
                    outlined
                    value="{{$user->about}}"
                ></v-textarea>
                <h5 class="mb-3">Social Links</h5>
                <v-text-field
                    label="Facebook"
                    name="country"
                    outlined
                    dense
                    color="primary"
                    class="body-2"
                    value=""
                    background-color="white"
                ></v-text-field>
                <v-text-field
                    label="Twitter"
                    name="country"
                    outlined
                    dense
                    color="primary"
                    class="body-2"
                    value=""
                    background-color="white"
                ></v-text-field>
                <v-text-field
                    label="Youtube"
                    name="country"
                    outlined
                    dense
                    color="primary"
                    class="body-2"
                    value=""
                ></v-text-field>
                <v-btn block depressed type="submit" outlined color="grey darken-3"> 
                    <v-icon left dark>mdi-content-save</v-icon>Save Changes
                </v-btn>
            </form>
        </div>

        <div class="footer">@include('mobile.footer')</div>
    </div>


@endsection
