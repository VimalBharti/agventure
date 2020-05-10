@extends('layouts.app')

@section('content')
    
<v-container>
    <div class="all-updates-page">
        <div color="grey darken-3" class="mt-2">Latest Updates</div>
        <v-row>
            @if($updates->isNotEmpty())
            @foreach($updates as $update)
            <v-col md="3" sm="12" xs="12" class="d-flex flex-column">
                <v-card class="flex d-flex flex-column">
                    <v-img
                        src="{{asset('uploads/updates/' . $update->image)}}"
                        height="200"
                        class="align-end white--text pl-3 pb-3"
                        gradient="to bottom, rgba(0,0,0,.2), rgba(0,0,0,.6)"
                    >
                    </v-img>
                    <v-card-text>
                        <div class="event-details-home-page">
                            <h4>{{$update->title}}</h4>
                            <p>Posted on:<span class="font-weight-bold">{{$update->created_at->format('d M, Y')}}</span></p>
                            <div class="caption">{{str_limit($update->about, 250, '...')}}</div>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn outlined dense block color="grey darken-1" href="{{route('singleUpdate', $update->slug)}}">Read More</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            @endforeach
            @endif
        </v-row>
    </div>
</v-container>

@endsection

