@extends('layouts.app')

@section('content')
        <v-row class="main-container boxed-layout">
            <!-- sidebar -->
            @include('_partials.sidebar')

            <v-col cols="9" class="center-post-container">
                <v-row>
                    <v-col>                        
                        <chat :user="{{ auth()->user() }}"></chat>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

    <!-- Mobile Screen -->
    <div class="mobile-container">
        <div class="center-post-container">
            <chat :user="{{ auth()->user() }}"></chat>
        </div>
        @include('mobile.footer')
    </div>
@endsection
