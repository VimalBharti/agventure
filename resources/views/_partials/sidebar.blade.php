<v-col cols="2" class="left-sidebar d-none d-md-block d-lg-block">
    @guest
      <div class="sidebar-links">
        <h6>All Category</h6>
        <v-list dense nav>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-buffer</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>My Account</v-list-item-title>
            </v-list-content>
          </v-list-item>
        </v-list>
      </div>
    @else
      <div class="user-profile-detail pl-4 mt-4">
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="/storage/profile/{{Auth::user()->image}}" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{Auth::user()->name}}</v-list-item-title>
            <v-list-item-subtitle>
              {{Auth::user()->city}}, {{Auth::user()->country}}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </div>
      <div class="sidebar-links">
        <h6>Main</h6>
        <v-list dense nav>
          <v-list-item href="/">
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-buffer</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>Timeline</v-list-item-title>
            </v-list-content>
          </v-list-item>
          <v-list-item href="{{route('myaccount')}}">
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>My Account</v-list-item-title>
            </v-list-content>
          </v-list-item>
          <v-list-item href="{{route('mypost')}}">
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-video</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>My Post</v-list-item-title>
            </v-list-content>
          </v-list-item>
          <v-list-item href="{{route('inbox')}}">
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-message-text-outline</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>
                Message
                <span class="notification">6</span>
              </v-list-item-title>
            </v-list-content>
          </v-list-item>
        </v-list>
      </div>
      <div class="sidebar-links">
        <h6>Other</h6>
        <v-list dense nav>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-account-multiple-plus</v-icon>
            </v-list-item-icon>
            <v-list-content>
              <v-list-item-title>Followers</v-list-item-title>
            </v-list-content>
          </v-list-item>

          <v-list-item href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <v-list-item-icon>
              <v-icon class="grey--text">mdi-logout-variant</v-icon>
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
    @endguest
  </v-col>