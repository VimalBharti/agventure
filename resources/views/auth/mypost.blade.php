@extends('layouts.app')

@section('content')
    <v-row class="main-container mx-auto">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="center-post-container">
                @forelse($user->posts as $post)
                    <v-card class="mb-6 pa-2" flat>
                        <v-card-text>
                            <div class="post-auth-details border-bottom pb-3 mb-2">
                            <h3 class="indigo--text text--darken-3">Posted on:</h3>
                            <div>{{$post->created_at->format('d M, Y')}}</div>
                            </div>
                            <div class="text--primary">{{$post->body}}</div>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn text small>
                                <v-icon class="mr-1">mdi-delete</v-icon>
                                {!! Form::open(['route' => ['deletemypost', $post->id], 'method' => 'DELETE']) !!}
                                    {!! Form::submit('Delete', ['class' => 'delete-button']) !!}
                                {!! Form::close() !!}
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                @empty
                    <v-card class="pa-10" height="580" flat>
                        <p>No post!</p>
                    </v-card>
                @endforelse
        </v-col>
    
    </v-row>
@endsection
