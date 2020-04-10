<v-app-bar color="white" class="app-bar-bottom" dense flat>
    <v-btn icon href="/">
        <v-icon size="29">mdi-home-outline</v-icon>
    </v-btn>
    <v-spacer></v-spacer>
    <v-btn icon href="{{route('podcast')}}">
        <v-icon size="29">mdi-headphones</v-icon>
    </v-btn>
    <v-spacer></v-spacer>
    @guest
        <v-btn icon href="login"> 
            <v-icon>mdi-account</v-icon>
        </v-btn>
    @else
        <v-btn icon href="{{route('myaccount', $user->username)}}">
            <v-avatar size="42" outlined>
                <v-img 
                    src="/storage/profile/{{Auth::user()->image}}"
                    lazy-src="{{asset('images/lazy.jpg')}}"
                    aspect-ratio="1"
                    class="grey lighten-4"
                ></v-img>
            </v-avatar>
        </v-btn>
    @endguest
    <v-spacer></v-spacer>
    <v-btn icon href="{{route('savedpost')}}">
        <v-icon size="29">mdi-heart-outline</v-icon>
    </v-btn>
    <v-spacer></v-spacer>
    <v-btn icon href="{{route('podcast')}}">
        <v-icon size="29">mdi-newspaper</v-icon>
    </v-btn>
</v-app-bar>