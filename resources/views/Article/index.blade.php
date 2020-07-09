
@extends('layouts.app')

@section('content')

<v-container class="new-article-page mt-12">
    <v-row>
        @foreach($articles as $article)
        <v-col md="4"> 
            <v-card>
                <h1>images is: {{$article->pic}}</h1>
                {{$article->title}}
                {!!$article->content!!}
            </v-card>
        </v-col>
        @endforeach
    </v-row>
</v-container>

@endsection
