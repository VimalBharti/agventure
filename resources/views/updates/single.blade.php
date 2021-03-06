@extends('layouts.app')

@section('content')
<div class="single-update-page main-container">
    <v-container>
        <v-row>
            <v-col md="4" xs="12">
                <v-img src="{{asset('uploads/updates/' . $update->image)}}" class="update-image"></v-img>
            </v-col>
            <v-col md="8" xs="12">
                <v-card flat>
                    <v-card-text>
                        <div class="single-update-details">
                            <h2 class="mb-2">{{$update->title}}</h2>
                            <p>Posted on:<span class="font-weight-bold">{{$update->created_at->format('d M, Y')}}</span></p>
                            <v-divider></v-divider>
                            <div class="mt-3">{{$update->about}}</div>
                            <div class="link mt-4 pb-6">
                                @if($update->link)
                                    <v-btn href="{{$update->link}}" target="_blank" outlined small color="teal">Read more</v-btn>
                                @else
                                @endif
                            </div>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</div>

<div class="d-md-none d-lg-none">
    @include('mobile.footer')
    <!-- footer link bar -->
</div>

@endsection

