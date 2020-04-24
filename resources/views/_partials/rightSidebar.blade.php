<v-col class="right-sidebar d-none d-md-block d-lg-block" id="myRightSidebar">

    <v-card class="mb-3" flat>
        <v-img
            class="white--text align-end"
            height="110px"
            src="images/podkast-bg.jpg"
            gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
        >
            <v-list-item three-line href="{{route('podcast')}}">
                <v-list-item-avatar>
                    <v-icon size="52" dark>mdi-play-circle</v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title class="white--text title">Listen Podcast</v-list-item-title>
                    <v-list-item-subtitle class="white--text">Most of the available agriculture podcasts are from farm</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-img>
    </v-card>

    <!-- Policy and Updates -->
    <v-card class="mb-3" flat>
        <v-img
            class="white--text align-end"
            height="80px"
            src="images/post-bg.jpg"
            gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
        >
            <v-card-title>Updates & Policies</v-card-title>
        </v-img>

        @foreach($updates as $update)
        <v-list-item two-line href="/">
            <v-list-item-avatar tile>
                <v-img src="{{asset('uploads/updates/' . $update->image)}}"></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title>{{$update->title}}</v-list-item-title>
                <v-list-item-subtitle>{{$update->about}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        @endforeach
        <v-card-actions>
            <v-btn block href="{{url('/all/updates')}}">All Updates</v-btn>
        </v-card-actions>
    </v-card>

    <!-- Top Communities -->
    <v-card class="mb-3" flat>
        <v-img
            class="white--text align-end"
            height="80px"
            src="images/card-bg.jpg"
            gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
        >
            <v-card-title>Top Growing Communities</v-card-title>
        </v-img>

        @foreach($communities as $community)
        <v-list-item two-line href="{{route('community', $community->slug)}}">
            <v-list-item-avatar>
                <v-img src="storage/community/{{$community->image}}"></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title>{{$community->title}}</v-list-item-title>
                <v-list-item-subtitle>total post: {{$community->posts->count()}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        @endforeach
        <v-card-actions>
            <v-btn block href="{{url('/all_community')}}">View All</v-btn>
        </v-card-actions>
    </v-card>

    
</v-col>

