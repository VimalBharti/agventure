
<v-bottom-navigation
    class="app-bar-bottom"
    grow
    color="teal"
    height="46"
  >
    <v-btn href="/">
      <v-icon color="#454545">mdi-buffer</v-icon>
    </v-btn>

    <v-btn href="{{route('podcast')}}">
      <v-icon color="#454545">mdi-headphones</v-icon>
    </v-btn>

    <v-btn href="{{route('savedpost')}}">
      <v-icon color="#454545">mdi-heart-outline</v-icon>
    </v-btn>

    <v-btn href="{{route('allUpdates.mobile')}}">
      <v-icon color="#454545">mdi-bell-outline</v-icon>
    </v-btn>

  </v-bottom-navigation>