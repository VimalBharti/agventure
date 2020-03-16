@extends('layouts.app')

@section('content')
    <div class="cover-profile" style="background: url({{'images/cover-bg.jpg'}}) center center;background-size:cover;"></div>
    <div class="public-profile-main-container">
        <v-row>
            <v-col cols="12" class="grey lighten-5 center-post-container">
                <v-container>
                    <v-row>
                        <v-col cols="3">
                            <v-card
                                class="box-shadow white"
                            >
                                <v-container class="user-avatar-box-public">
                                    <div class="row text-center profile-picture">
                                        <v-col>
                                            <v-avatar
                                                class="profile"
                                                color="grey"
                                                size="164"
                                            >
                                                <v-img class="auth-image-public" src="/storage/profile/{{$user->image}}"></v-img>
                                            </v-avatar>
                                        </v-col>
                                    </div>
                                    <div class="row link-button-public">
                                        <input type="submit" class="post-btn cyan darken-2" value="connect"/>
                                        <v-expansion-panels class="mt-6" flat>
                                            <v-expansion-panel>
                                            <v-divider></v-divider>
                                                <v-expansion-panel-header expand-icon="mdi-message-text-outline">
                                                    Send message
                                                </v-expansion-panel-header>
                                                <v-expansion-panel-content>
                                                    <form action="/message" method="post" >
                                                        {{ csrf_field() }}
                                                        <v-textarea
                                                            label="Your message..."
                                                            auto-grow
                                                            rows="1"
                                                            name="message"
                                                        ></v-textarea>
                                                        <input hidden name="receiver_id" value="{{$user->id}}"></input>

                                                        <input type="submit" class="post-btn cyan darken-2" value="Send Message"/>
                                                    </form>
                                                </v-expansion-panel-content>
                                            </v-expansion-panel>
                                        </v-expansion-panels> 
                                        @if(session()->has('notify'))
                                            <v-alert
                                                v-model="alert"
                                                color="cyan"
                                                border="left"
                                                colored-border
                                                icon="mdi-check-circle"
                                                class="mt-3"
                                            >
                                                Message sent successfully
                                            </v-alert> 
                                        @endif 
                                    </div>
                                </v-container>
                            </v-card>
                        </v-col>
                        <v-col cols="6">
                            <v-card
                                class="mx-auto box-shadow"
                                flat
                            >
                                <v-card-text>
                                    <div class="mt-6 text-uppercase">User Information</div>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    label="Name"
                                                    outlined
                                                    value="{{$user->name}}"
                                                    readonly
                                                    color="primary"
                                                    background-color="white"
                                                ></v-text-field>
                                                </v-col>

                                                <v-col cols="12" sm="6">
                                                <v-text-field
                                                    label="Email address"
                                                    outlined
                                                    color="primary"
                                                    readonly
                                                    value="{{$user->email}}"
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
                                                    readonly
                                                    color="primary"
                                                    value="{{$user->city}}"
                                                    background-color="white"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <v-text-field
                                                    label="State"
                                                    outlined
                                                    readonly
                                                    color="primary"
                                                    value="{{$user->state}}"
                                                    background-color="white"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="4">
                                                <v-text-field
                                                    label="Country"
                                                    outlined
                                                    readonly
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
                                                    readonly
                                                ></v-textarea>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="3">
                            <v-card
                                class="mx-auto box-shadow"
                            >
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
                                        <v-icon color="indigo">mdi-clipboard-text</v-icon>
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
                                        <v-list-item-title>{{$user->city}}</v-list-item-title>
                                        <v-list-item-subtitle>{{$user->state}}, {{$user->country}}</v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                            <v-card class="mx-auto box-shadow mt-3">
                                <h4 class="ml-4 pt-4 pb-3">Recent posts</h4>
                                <v-divider></v-divider>
                                <v-list two-line>
                                    <v-list-item-group multiple>
                                        @foreach($posts as $post)
                                            <v-list-item>
                                                <v-list-item-content>
                                                    <v-list-item-title>{{$post->body}}</v-list-item-title>
                                                    <v-list-item-subtitle color="grey lighten-4">{{$post->created_at->format('M, Y')}}</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </v-list-item>
                                            <v-divider></v-divider>
                                        @endforeach
                                    </v-list-item-group>
                                </v-list>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-col>
        </v-row>
    </div>
@endsection
