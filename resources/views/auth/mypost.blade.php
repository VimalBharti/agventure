@extends('layouts.app')

@section('content')
    <v-row class="main-container boxed-layout">
        <!-- sidebar -->
        @include('_partials.sidebar')

        <v-col cols="9" class="my-saved-post-container">
                @forelse($user->posts->reverse() as $post)
                    <v-list>
                        <v-list-item two-line>
                            <v-list-item-content>
                                <v-list-item-subtitle>
                                    Posted on: {{$post->created_at->format('d M, Y')}}
                                </v-list-item-subtitle>
                                <v-list-item-title>{{$post->body}}</v-list-item-title>
                            </v-list-item-content>
                            <v-list-actions>
                                <v-btn outlined small>
                                    {!! Form::open(['route' => ['deletemypost', $post->id], 'method' => 'DELETE']) !!}
                                        {!! Form::submit('Delete', ['class' => 'delete-button']) !!}
                                    {!! Form::close() !!}
                                </v-btn>
                            </v-list-actions>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                @empty
                    <v-card class="pa-10" height="580" flat>
                        <p>No post!</p>
                    </v-card>
                @endforelse
        </v-col>
    
    </v-row>
@endsection
