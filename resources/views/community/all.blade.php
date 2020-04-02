@extends('layouts.app')

@section('content')
<v-container fluid class="pt-0">
    <v-row class="main-container mx-auto"> 
        <v-col cols="8" class="center-post-container">
            <v-card outlined>
                <v-img
                    class="white--text align-end"
                    height="80px"
                    src="images/card-bg.png"
                    gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                >
                    <v-card-title>Top Growing Communities</v-card-title>
                </v-img>
                @foreach($communities as $community)
                <v-list-item href="{{route('community', $community->slug)}}">
                    <v-list-item-avatar>
                        <v-img src="storage/community/{{$community->image}}"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{$community->title}}</v-list-item-title>
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-btn icon>
                            <v-icon color="grey lighten-1">mdi-information</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>
                <v-divider></v-divider>
                @endforeach
            </v-card>
        </v-col>

        <v-col cols="4">
            <v-card class="mb-3" flat>
                <v-img
                    class="white--text align-end"
                    height="80px"
                    src="images/card-bg.png"
                    gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                >
                    <v-card-title>Top Growing Communities</v-card-title>
                </v-img>

                @foreach($communities as $community)
                <v-list-item>
                    <v-list-item-avatar>
                        <v-img src="storage/community/{{$community->image}}"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{$community->title}}</v-list-item-title>
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-btn icon>
                            <v-icon color="grey lighten-1">mdi-information</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>
                <v-divider></v-divider>
                @endforeach
            </v-card>
        </v-col>
    </v-row>
</v-container>

@endsection

