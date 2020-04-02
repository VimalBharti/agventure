<v-col class="right-sidebar d-none d-md-block d-lg-block">

    <v-card class="mb-3" flat>
        <v-img
            class="white--text align-end"
            height="130px"
            src="images/podkast-bg.jpg"
            gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
        >
            <v-list-item two-line href="{{route('podcast')}}">
                <v-list-item-avatar>
                    <v-icon size="38" dark>mdi-play-circle</v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                    <v-list-item-title class="white--text">Listen Podcast</v-list-item-title>
                    <v-list-item-subtitle class="white--text">Most of the available agriculture podcasts are from farm</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-img>
    </v-card>

    <v-card class="mb-3" flat>
        <v-img
            class="white--text align-end"
            height="80px"
            src="images/card-bg.png"
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
        <v-card-action>
            <v-btn block href="{{url('/all_community')}}">View All</v-btn>
        </v-card-action>
    </v-card>

    <news></news>
</v-col>
<!-- <v-col class="right-sidebar white d-none d-md-block d-lg-block">
    <blog></blog>
</v-col> -->