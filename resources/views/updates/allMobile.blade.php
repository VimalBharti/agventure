@extends('layouts.app')

@section('content')

<div class="mobile-container">
    <v-tabs
        centered
        grow
        color="teal"
    >
        <v-tab class="text-capitalize">
            <v-icon size="18" class="mr-2">mdi-bell</v-icon>
            Updates
        </v-tab>
        <v-tab class="text-capitalize">
            <v-icon size="18" class="mr-2">mdi-ticket</v-icon>
            Events
        </v-tab>

        <v-tab-item>
            @if($updates->isNotEmpty())
                @foreach($updates as $update)
                    <v-container>
                        <v-row>
                            <v-col cols="4">
                                <v-img
                                    src="{{asset('uploads/updates/' . $update->image)}}"
                                    height="100px"
                                ></v-img>
                            </v-col>
                            <v-col cols="8">
                                <div class="subtitle">{{$update->title}}</div>
                                <div class="caption">{{str_limit($update->about, 60, '...')}}</div>
                                
                                <v-card-actions class="pr-6 pl-0">
                                    <div class="overline">
                                        {{$update->created_at->format('d M, Y')}}
                                    </div>
                                    <v-spacer></v-spacer>
                                    <v-btn color="teal" outlined href="{{route('singleUpdate', $update->slug)}}" x-small class="text-capitalize">
                                        Read more
                                    </v-btn>
                                </v-card-actions>
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-divider></v-divider>
                @endforeach
            @else 
                <v-card-text>No Updates!</v-card-text>
            @endif
        </v-tab-item>

        <v-tab-item>
            @if($events->isNotEmpty())
                @foreach($events as $event)
                    <v-row>
                        <v-col cols="4">
                            <v-img
                                src="/storage/events/{{$event->image}}"
                                height="100px"
                            ></v-img>
                        </v-col>
                        <v-col cols="8">
                            <div class="subtitle">{{$event->title}}</div>
                            <div class="caption">
                                <v-icon size="14" color="grey">mdi-calendar-clock</v-icon> {{$event->date}}
                            </div>
                            <div class="caption">
                                <v-icon size="14" color="grey">mdi-map</v-icon> {{$event->location}}
                            </div>
                            
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="teal" outlined href="{{route('mobile.singleEvent', $event->slug)}}" x-small class="text-capitalize">
                                    View
                                </v-btn>
                            </v-card-actions>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                @endforeach
            @else
                <v-card-text>No Events!</v-card-text>
            @endif
        </v-tab-item>

    </v-tabs>


    <!-- footer link bar -->
    @include('mobile.footer')
</div>

@endsection

