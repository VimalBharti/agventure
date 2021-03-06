@extends('layouts.admin')

@section('content')

<div class="admin-dashboard">
    <v-toolbar>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Admin Dashboard</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn outlined href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
        <v-icon class="mr-2">mdi-logout-variant</v-icon> Logout
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
      </v-btn>
    </v-toolbar>

    <v-row>
        <v-col>
            <v-container>
                <v-row>
                    <v-col cols="4">
                        <v-card class="text-center">
                            <v-img
                                class="white--text align-end"
                                height="100px"
                                src="{{asset('images/user-bg.png')}}"
                            >
                                <v-card-title class="font-weight-bold">Total User</v-card-title>
                            </v-img>
                            <v-card-text>
                                <div class="display-4">{{$user->count()}}</div>
                            </v-card-text>
                            <v-btn block>View</v-btn>
                        </v-card>
                    </v-col>
                    <v-col cols="4">
                        <v-card class="text-center">
                            <v-img
                                class="white--text align-end"
                                height="100px"
                                src="{{asset('images/post-bg.jpg')}}"
                            >
                                <v-card-title class="font-weight-bold">Total Posts</v-card-title>
                            </v-img>
                            <v-card-text>
                                <div class="display-4">{{$post->count()}}</div>
                            </v-card-text>
                            <v-btn block>View</v-btn>
                        </v-card>
                    </v-col>
                    <v-col cols="4">
                        <v-card class="text-center">
                            <v-img
                                class="white--text align-end"
                                height="100px"
                                src="{{asset('images/podkast-bg1.jpg')}}"
                            >
                                <v-card-title class="font-weight-bold">Total Podcast</v-card-title>
                            </v-img>
                            <v-card-text>
                                <div class="display-4">{{$podcast->count()}}</div>
                            </v-card-text>
                            <v-btn block>View</v-btn>
                        </v-card>
                    </v-col>
                </v-row>
                <v-divider class="mt-8"></v-divider>
                <!-- Add Events -->
                <v-row>
                    <v-col cols="6">
                        <v-card class="pa-4 mt-4">
                            <h3 class="mb-4">Add Market trends</h3>
                            <form action="{{route('saveMarketTrends')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <v-text-field
                                        label="Crop Name"
                                        outlined
                                        name="crop"
                                        dense
                                    ></v-text-field>
                                    <v-text-field
                                        label="Month"
                                        outlined
                                        name="month"
                                        dense
                                    ></v-text-field>
                                    <v-text-field
                                        label="Rate"
                                        outlined
                                        name="rate"
                                        dense
                                    ></v-text-field>
                                    <v-card-actions>
                                        <v-btn outlined color="teal" block type="submit">Save Market Trends</v-btn>
                                    </v-card-actions>
                                </div>
                            </form>
                        </v-card>
                    </v-col>
                    <v-col cols="6">
                        <v-card class="pa-4 mt-4">
                            <h3 class="mb-4">Add Short News</h3>
                            <form action="{{route('saveShortNews')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <v-textarea
                                    outlined
                                    name="content"
                                    label="Short News"
                                    dense
                                ></v-textarea>
                                <v-btn block large outlined type="submit">Post News</v-btn>
                            </form>
                        </v-card>
                    </v-col>
                </v-row>

                <v-divider class="my-8"></v-divider>

                <!-- Add new Community -->
                <v-row>
                    <v-col cols="6">
                        <v-card class="pa-4 mt-4">
                            <h3 class="mb-4">Add Community</h3>
                            <form action="/add/community" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <v-text-field
                                        label="Outlined"
                                        outlined
                                        name="title"
                                    ></v-text-field>
                                    <v-file-input
                                        accept="image/png, image/jpeg, image/bmp"
                                        placeholder="Select featured Image"
                                        prepend-icon="mdi-camera"
                                        label="Upload jpg, png"
                                        name="image"
                                    ></v-file-input>
                                    <v-textarea
                                        required
                                        name="about"
                                        label="About Community..."
                                        outlined
                                        rows="4"
                                        auto-grow
                                    ></v-textarea>
                                    <v-card-actions class="pa-5">
                                        <v-btn outlined color="teal" block type="submit">Add Community</v-btn>
                                    </v-card-actions>
                                </div>
                            </form>
                        </v-card>
                    </v-col>
                    <v-col cols="6">
                        <v-card class="pa-4 mt-4">
                            <h3 class="mb-4">Add new update</h3>
                            <form action="{{route('newUpdate')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <v-text-field
                                    label="Event Title"
                                    outlined
                                    dense
                                    name="title"
                                ></v-text-field>
                                <v-textarea
                                    outlined
                                    name="about"
                                    label="About Event/Policy"
                                    dense
                                ></v-textarea>
                                <v-file-input
                                    color="deep-purple accent-4"
                                    counter
                                    label="Select featured Image"
                                    placeholder="Select your file"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    accept="image/png, image/jpeg, image/bmp"
                                    dense
                                    name="image"
                                >
                                </v-file-input>
                                <v-btn block large outlined type="submit">Submit</v-btn>
                            </form>
                        </v-card>
                    </v-col>
                </v-row>
                <h3>All Updates</h3>
                <v-row>
                    @foreach($updates as $update)
                    <v-col cols="4" class="d-flex flex-column">
                        <v-card class="flex d-flex flex-column">
                            <v-img
                                class="white--text align-end"
                                height="120px"
                                src="{{asset('uploads/updates/' . $update->image)}}"
                            >
                            </v-img>
                            <div class="px-3 pt-2">
                                <p class="text--primary mb-0">{{$update->title}}</p>
                                <p class="caption text--secondary">{{str_limit($update->about, 100, '...')}}</p>
                            </div>
                            <v-btn block>View</v-btn>
                        </v-card>
                    </v-col>
                    @endforeach
                </v-row>
            </v-container>
        </v-col>
    </v-row>
</div>

@endsection
