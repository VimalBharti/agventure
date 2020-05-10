@extends('layouts.app')

@section('content')
<v-container>
    <v-row class="my-events-page">
        <v-col>
            <h2>All Response</h2>
            <v-card class="mt-8">
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">Event Name</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Received On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($responses as $response)
                            <tr>
                                <td>{{ $response->title }}</td>
                                <td>{{ $response->name }}</td>
                                <td>{{ $response->email }}</td>
                                <td>{{ $response->phone }}</td>
                                <td>{{ $response->created_at->format('d M, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </template>
                </v-simple-table>
            </v-card>
        </v-col>
    </v-row>
</v-container>
@endsection
