<v-col cols="3" class="left-sidebar d-none d-md-block d-lg-block">
  <div class="user-profile-detail mt-3">
    <v-card>
      @if(Auth::user()->image)
      <v-img
          src="/storage/profile/{{Auth::user()->image}}"
          aspect-ratio="1"
          position="top"
          dark
          class="align-end"
      >
      @else
        <v-img
            src="/storage/profile/default.jpg"
            aspect-ratio="1"
            position="top"
            dark
            class="align-end"
        >
      @endif
        <form enctype="multipart/form-data" action="{{ route('avatar.update') }}" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" id="files" style="display:none;" onchange='this.form.submit();'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label for="files" class="save-btn">
                <v-icon color="white">mdi-image-filter</v-icon>  Change Photo
            </label>
        </form>
      </v-img>
    </v-card>
  </div>
  <div class="sidebar-links">
    <v-list dense nav class="sidebar-link-box">
      <v-list-item href="/">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-buffer</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>Timeline</v-list-item-title>
        </v-list-content>
      </v-list-item>
      <v-list-item href="{{route('myaccount', $user->username)}}">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>My Account</v-list-item-title>
        </v-list-content>
      </v-list-item>
      <v-list-item href="{{route('mypost')}}">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-video</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>My Post</v-list-item-title>
        </v-list-content>
      </v-list-item>
      <v-list-item href="{{route('inbox')}}">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-message-text-outline</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>
            Message
          </v-list-item-title>
        </v-list-content>
      </v-list-item>
      <v-list-item href="{{route('savedpost')}}">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-bookmark-check</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>
            Saved Post
          </v-list-item-title>
        </v-list-content>
      </v-list-item>
    </v-list>
  </div>
  <v-divider></v-divider>
  <div class="sidebar-links">
    <v-list dense nav class="sidebar-link-box">
      <!-- <v-list-item href="{{route('myEvents')}}">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-ticket</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>My Event</v-list-item-title>
        </v-list-content>
      </v-list-item> -->

      <v-list-item href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        <v-list-item-icon>
          <v-icon color="grey darken-3">mdi-logout-variant</v-icon>
        </v-list-item-icon>
        <v-list-content>
          <v-list-item-title>
            Logout
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </v-list-item-title>
        </v-list-content>
      </v-list-item>
    </v-list>
  </div>
</v-col>