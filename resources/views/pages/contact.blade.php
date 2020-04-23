@extends('layouts.app')

@section('content')
    
<div class="main-container boxed-layout contact-us">
    <v-row>
        <v-col cols="6" class="mx-auto">
            <v-card class="pa-5 text-center" flat>
                <h1>Contact Us</h1>
                <div class="title mb-12 mt-3">Contact us and clarify any doubts you have about Agrishi or report a problem.</div>
                
                <form method="post" action="{{route('sendMessage')}}">
                    @csrf
                    <div class="input-control">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="input-control">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="input-control">
                        <textarea type="text" name="body" placeholder="Enter Message" required></textarea>
                    </div>
                    <v-btn outlined block large color="teal" type="submit">Send Message</v-btn>
                </form>

            </v-card>
        </v-col>
        <div class="success-msg">
            @if (session()->has('success'))
                <v-alert dense text type="success" color="teal">
                    {{ session('success') }}
                </v-alert>
            @endif
        </div>
    </v-row>
    
</div>

@endsection

