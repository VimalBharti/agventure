@extends('layouts.app')

@section('content')
<div class="mobile-container">
    <v-container>
        <v-tabs
            centered
            grow
            color="teal"
        >
            <v-tab class="text-capitalize">
                <v-icon size="18" class="mr-2">mdi-buffer</v-icon>
                My Events
            </v-tab>

            <v-tab class="text-capitalize">
                <v-icon size="18" class="mr-2">mdi-ticket</v-icon>
                Response
            </v-tab>

            <v-tab-item>
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
                                <v-btn color="grey" outlined x-small>
                                    {!! Form::open(['route' => ['event.destroy', $event->id], 'method' => 'DELETE']) !!}
                                        {!! Form::submit('Delete', ['class' => 'delete-button']) !!}
                                    {!! Form::close() !!}
                                </v-btn>
                            </v-card-actions>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                @endforeach
            </v-tab-item>

            <!-- response -->
            <v-tab-item>
                @foreach($responses as $response)
                    <v-row justify="center">
                        <v-expansion-panels accordion>
                            <v-expansion-panel>
                                <v-expansion-panel-header>{{$response->title}}</v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-simple-table>
                                        <template v-slot:default>
                                        <tbody>
                                            <tr>
                                                <th>Event Name</th>
                                                <th>{{$response->title}}</th>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{ $response->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $response->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td>{{ $response->phone }}</td>
                                            </tr>
                                        </tbody>
                                        </template>
                                    </v-simple-table>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                @endforeach
            </v-tab-item>
        </v-tabs>

        <v-btn dark fab color="teal" class="add-new-event-mobile-link" href="{{route('mobile-new-event-page')}}">
            <v-icon>mdi-plus</v-icon>
        </v-btn>
    </v-container>

    @include('mobile.footer')
</div>
@endsection
