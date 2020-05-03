
<v-bottom-navigation
    class="app-bar-bottom"
    grow
    color="teal"
  >
    <v-btn href="/">
      <span color="#959595">Timeline</span>
      <v-icon color="#959595">mdi-buffer</v-icon>
    </v-btn>

    <v-btn href="{{route('podcast')}}">
      <span color="#959595">Podcast</span>
      <v-icon color="#959595">mdi-headphones</v-icon>
    </v-btn>

    <v-btn href="{{route('savedpost')}}">
      <span color="#959595">Favourites</span>
      <v-icon color="#959595">mdi-heart-outline</v-icon>
    </v-btn>

    <v-btn href="{{route('allUpdates')}}">
      <span color="#959595">Updates</span>
      <v-icon color="#959595">mdi-bell-outline</v-icon>
    </v-btn>

  </v-bottom-navigation>