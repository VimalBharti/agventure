@extends('layouts.app')

@section('content')
    <v-row class="main-container">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="10" class="grey lighten-5 center-post-container">
            <v-container>
                <v-row>
                    <v-col>                        
                        <!-- <v-list three-line>
                            <template>
                                <v-subheader>Today</v-subheader>
                                @foreach($inbox as $message)
                                    <v-divider inset="inset"></v-divider>

                                    @if($message->status=='0')
                                        <v-list-item class="grey lighten-3">
                                            <v-list-item-avatar>
                                                <v-img src="/storage/profile/{{$message->sender->image}}"></v-img>
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-title>{{$message->sender->name}}</v-list-item-title>
                                                <v-list-item-subtitle>{{$message->message}}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    @else
                                        <v-list-item>
                                            <v-list-item-avatar>
                                                <v-img src="/storage/profile/{{$message->sender->image}}"></v-img>
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-title>{{$message->sender->name}}</v-list-item-title>
                                                <v-list-item-subtitle>{{$message->message}}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    @endif
                                @endforeach
                            </template>
                        </v-list> -->
                        <h2>Chat Inbox</h2>
                        <chat :user="{{ auth()->user() }}"></chat>
                    </v-col>
                    <!-- <v-col cols="5">
                        <v-card
                            class="mx-auto"
                        >   
                            <v-card-title>
                                <v-avatar>
                                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                                </v-avatar>
                                <span class="ml-3">Pooja Arya</span>
                            </v-card-title>
                                <v-divider></v-divider>
                            <v-card-text>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti nam autem magnam et temporibus! Odit, voluptates at. Ipsam soluta distinctio optio, et, dolores ducimus cupiditate quaerat, libero facere corporis qui.</p>
                            </v-card-text>
                            <v-card-actions>
                                <v-container>
                                    <v-textarea
                                        outlined
                                        name="input-7-4"
                                        label="Reply"
                                        value=""
                                    ></v-textarea>
                                    <v-btn>Send Reply</v-btn>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-col> -->
                </v-row>
            </v-container>
        </v-col>
    
    </v-row>
@endsection
