<template>
  <div class="pl-2 pr-2 podcast-page">
    <v-container>
      <v-row>
        <v-col md="3" cols="6" v-for="podcast of podcasts" :key="podcast.id" class="mb-2">
          <v-card class="single-posdcast-home">
            <v-img
              :src="`https://agrishi.s3.ap-south-1.amazonaws.com/${podcast.image}`"
              aspect-ratio="1.7"
              class="align-center"
              justify="center"
            >
              <div class="text-center">
                <v-btn
                  class="play-btn"
                  elevation="1"
                  fab
                  @click="selected($event)"
                  :id="`${podcast.audio}`"
                >
                  <v-icon>mdi-play</v-icon>
                </v-btn>
              </div>
            </v-img>
            <div class="postTitle pa-1">{{podcast.about.substring(0,100)+".."}}</div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <!-- Audio Player -->
    <div class="audio-player" v-if="audio">
      <audio
        crossorigin
        controls
        :src="audio"
        ref="player"
        id="audio-player"
        preload="auto"
        autoplay
      ></audio>
    </div>
    <!-- Audio Player Ends -->
  </div>
</template>

<script>
export default {
  data: () => ({
    podcasts: null,
    audio: null,
    dialog: false
  }),
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      let axiosConfig = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };
      axios
        .get("/api-podcasts", axiosConfig)
        .then(response => {
          this.podcasts = response.data;
        })
        .catch(e => {
          this.error.push(e);
        });
    },
    selected(event) {
      this.audio = "";
      this.audio =
        "https://agrishi.s3.ap-south-1.amazonaws.com/" + event.currentTarget.id;
      console.log();
    },
    stop(event) {
      var a = this.$refs.player;
      if (a.paused) {
        a.play();
      } else {
        a.pause();
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.podcast-page {
  position: relative;

  audio {
    position: fixed;
    bottom: 0;
    width: 100%;
    border-radius: 0px;
    left: 0;
    right: 0;
  }
  .single-posdcast-home {
    padding: 0.3em;
    .play-btn {
      opacity: 0.8;
    }
    .postTitle {
      font-size: 0.8em;
      margin-top: 6px;
      color: #444;
    }
  }
}
</style>
