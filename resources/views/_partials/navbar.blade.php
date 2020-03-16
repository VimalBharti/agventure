<v-app-bar flat class="main-navbar" height="58">
    <v-toolbar-title>
        <v-avatar color="cyan" size="36">
            <v-icon dark>mdi-leaf</v-icon>
        </v-avatar>
        <span class="ml-2">Agventure</span>
    </v-toolbar-title>

    <v-text-field
        hide-details
        placeholder="Search..."
        single-line
        class="ml-10"
        outlined
        dense
    ></v-text-field>

    <v-spacer></v-spacer>

    <v-btn text href="{{route('blog')}}">Blog</v-btn>
    <v-btn text>News & Updates</v-btn>
    <!-- if logout -->
    @guest
        <v-btn color="primary" href="{{route('login')}}">Log In</v-btn>
    @else
        
    @endguest
</v-app-bar>