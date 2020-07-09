<template>
  <div class="rightSidebar">
    <v-card outlined>
      <v-card-actions>
        <div color="grey" class="pl-2">Featured Podcast</div>
      </v-card-actions>
      <v-divider></v-divider>
      <v-list two-line class="py-0">
        <v-list-item-group v-model="activate" active-class="teal--text">
          <template v-for="(podcast, index) of podcasts">
            <v-list-item :key="podcast.id" @click="selected($event)" :id="`${podcast.audio}`">
              <template v-slot:default="{ active }">
                <v-list-item-content>
                  <v-list-item-subtitle v-text="podcast.slug"></v-list-item-subtitle>
                  <v-list-item-subtitle v-text="podcast.about"></v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                  <v-btn icon>
                    <v-icon v-if="!active" color="grey lighten-1">play_circle_filled</v-icon>
                    <v-icon v-else color="teal" @click="stop()">pause_circle_filled</v-icon>
                  </v-btn>
                </v-list-item-action>
              </template>
            </v-list-item>

            <v-divider v-if="index + 1 < podcasts.length" :key="index"></v-divider>
          </template>
          <!-- Audio Player -->
          <div class="audio-player" v-if="audio">
            <audio crossorigin :src="audio" ref="player" id="audio-player" preload="auto" autoplay></audio>
          </div>
          <!-- Audio Player Ends -->
        </v-list-item-group>
      </v-list>
      <v-divider></v-divider>
      <v-btn text small block color="grey" class="text-capitalize">View All</v-btn>
    </v-card>

    <!-- Invite Friends -->
    <v-card class="my-4 text-center" outlined>
      <v-card-text>
        <div>Let's build community</div>
        <p class="title text--primary">Invite Your Friends to Join AgRishi!</p>
        <!-- Invite Dialog -->
        <v-dialog v-model="InviteDialog" persistent width="500">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="teal"
              dark
              small
              depressed
              v-bind="attrs"
              v-on="on"
              class="text-capitalize"
            >Send an Invite</v-btn>
          </template>

          <v-card class="text-center">
            <v-card-title primary-title>
              <v-spacer></v-spacer>
              <v-btn icon @click="InviteDialog = false">
                <v-icon>close</v-icon>
              </v-btn>
            </v-card-title>
            <v-card-text>
              <h2>Invite Friends</h2>
              <div class="mt-2">
                Simply use this form to tell your friends about
                AgRishi.
              </div>
              <div class="form mt-4">
                <v-container>
                  <v-row>
                    <v-col md="11">
                      <v-text-field filled v-model="websitelink" disabled dense></v-text-field>
                    </v-col>
                    <v-col md="1" class="pl-0 ml-0">
                      <v-btn @click="copy()" fab small elevation="1">
                        <v-icon fab>content_copy</v-icon>
                      </v-btn>
                    </v-col>
                  </v-row>
                  <div class="friend-details">
                    <v-text-field label="Friend's Email" outlined dense color="teal"></v-text-field>
                    <v-textarea
                      outlined
                      value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                      rows="3"
                      auto-grow
                      dense
                      color="teal"
                    ></v-textarea>
                  </div>
                  <v-btn color="teal" class="text-capitalize" outlined>Send Invitation</v-btn>
                </v-container>
              </div>
            </v-card-text>
          </v-card>
        </v-dialog>
      </v-card-text>
    </v-card>

    <!-- Other links card -->
    <v-card outlined>
      <v-card-text>
        <ul>
          <li>
            <a href="#">About</a>
          </li>
          <li>
            <a href="#">Contact</a>
          </li>
          <li>
            <a href="#">Help</a>
          </li>
          <li>
            <a href="#">Privacy</a>
          </li>
        </ul>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    activate: [0],
    podcasts: null,
    audio: null,
    InviteDialog: false,
    websitelink: "https//:www.agrishi.com"
  }),
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios
        .get("/api-podcasts-home")
        .then(response => {
          this.podcasts = response.data.data;
        })
        .catch(e => {
          this.error.push(e);
        });
    },
    selected(event) {
      this.audio = "";
      this.audio = "audio/" + event.currentTarget.id;
      this.icon = "play_circle_filled";
      this.name = event.currentTarget.name;
      console.log();
    },
    stop(event) {
      var a = this.$refs.player;
      if (a.paused) {
        a.play();
        this.icon = "pause_circle_filled";
      } else {
        a.pause();
        this.icon = "pause_circle_filled";
      }
    },
    copy() {
      console.log(this.websitelink);
    }
  }
};
</script>

<style lang="scss" scoped>
.about-podcast {
  font-size: 0.875rem;
  color: rgba(0, 0, 0, 0.6);
}
ul {
  padding: 0px;
  li {
    display: inline;
    padding: 0 8px;
    a {
      color: rgba(0, 0, 0, 0.6);
    }
  }
}
</style>
