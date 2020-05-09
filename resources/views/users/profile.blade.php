@extends('layouts.plain')

@section('content')
    <div class="public-user-profile">
        <div class="user-bg">
            <v-img
                class="white--text align-top"
                height="180px"
                src="{{asset('images/user-profile.jpg')}}"
            >
                <v-btn icon href="/">
                    <v-icon color="#fff">mdi-close</v-icon>
                </v-btn>
            </v-img>
        </div>
        <v-container class="px-6 user-profile-detail-public">
            <v-row>
                <v-col>
                    <v-card class="text-center pt-12" shaped>
                        <div class="user-profile-image">
                            <v-avatar size="140" color="teal">
                                @if($auth->image)
                                    <v-img src="/storage/profile/{{$auth->image}}">
                                        <template v-slot:placeholder>
                                            <v-row class="fill-height ma-0" align="center" justify="center">
                                                <v-img src="{{asset('images/logoBox.png')}}"></v-img>
                                            </v-row>
                                        </template>
                                    </v-img>
                                @else
                                    <span class="white--text display-3">{{Str::limit($auth->name, 1, '')}}</span>
                                @endif
                            </v-avatar>
                        </div>

                        <v-card-text>
                            <div class="title">{{$auth->name}}</div>
                            <div class="subtitle teal--text">
                                <v-icon size="16" color="teal">mdi-at</v-icon>
                                {{$auth->username}}
                            </div>
                            <div class="subtitle">
                                <v-icon size="22">mdi-map-marker-radius</v-icon>
                                {{$auth->city}} {{$auth->country}}
                            </div>
                            <p>{{$auth->about}}</p>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn outlined block>Total Post - {{count($posts)}}</v-btn>
                        </v-card-actions>
                    </v-card>
                    
                    <!-- Send Message -->
                    <div class=" link-button-public">
                        @if (Auth::check())
                            <v-expansion-panels class="mt-3">
                                <v-expansion-panel>
                                <v-divider></v-divider>
                                    <v-expansion-panel-header expand-icon="mdi-message-text-outline">
                                        Send message
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <form action="/message" method="post" >
                                            {{ csrf_field() }}
                                            <v-textarea
                                                label="Your message..."
                                                auto-grow
                                                rows="1"
                                                name="message"
                                            ></v-textarea>
                                            <input hidden name="receiver_id" value="{{$auth->id}}"></input>

                                            <input type="submit" class="post-btn teal" value="Send Message"/>
                                        </form>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels> 
                            @if(session()->has('notify'))
                                <v-alert
                                    v-model="alert"
                                    color="cyan"
                                    border="left"
                                    colored-border
                                    icon="mdi-check-circle"
                                    class="mt-3"
                                >
                                    Message sent successfully
                                </v-alert> 
                            @endif 
                            <!-- End div -->
                        @else
                        @endif
                    </div>

                    <!-- All Posts and Event By User -->
                    <v-card outlined class="mt-3">
                        <v-tabs
                            centered
                            grow
                            color="teal"
                        >
                            <v-tab class="text-capitalize">
                                <v-icon size="18" class="mr-2">mdi-buffer</v-icon>
                                All Post
                            </v-tab>

                            <v-tab class="text-capitalize">
                                <v-icon size="18" class="mr-2">mdi-ticket</v-icon>
                                Events
                            </v-tab>

                            <v-tab-item>
                                <v-list>
                                    @forelse($posts as $post)
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>
                                                    <a href="{{route('singleMobile', $post->slug)}}" class="text--secondary">{{$post->about}}</a>
                                                </v-list-item-subtitle>
                                                <div class="caption">{{$post->created_at->format('d M, Y')}}</div>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                    @empty
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>No Posts by this User</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    @endforelse
                                </v-list>
                            </v-tab-item>
                            <v-tab-item>
                                <v-list>
                                    @forelse($events as $event)
                                        <v-list-item three-line>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>{{$event->about}}</v-list-item-subtitle>
                                                <div class="caption">{{$event->created_at->format('d M, Y')}}</div>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                    @empty
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>No Events by this User</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    @endforelse
                                </v-list>
                            </v-tab-item>
                        </v-tabs>
                    </v-card>

                </v-col>
            </v-row>
        </v-container>
    </div>
@endsection

@section('styles')
<style>
.user-profile-detail-public{
    position: relative;
    top: -4rem;
}
.user-profile-image{
    position: absolute;
    top: -5em;
    text-align:center;
    width:100%;
}
.public-user-profile{
    max-height: 100vh;
    overflow-y: scroll;
}
</style>
@endsection