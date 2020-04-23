<template>
  <div class="podcast-page">
    <v-container>
      <v-row>
        <v-col v-for="(post, index) in posts" :key="index" class="single-podcast-home">
          <v-row>
            <v-col cols="3">
              <v-img
                :src="`../storage/audio/${post.featured}`"
                class="align-center featured-image"
                justify="center"
                height="65"
              >
                <div class="text-center">
                  <v-btn
                    class="play-btn"
                    elevation="1"
                    fab
                    small
                    @click="selected($event)"
                    :id="`${post.audio}`"
                    :name="`${post.slug}`"
                  >
                    <v-icon>mdi-play</v-icon>
                  </v-btn>
                </div>
              </v-img>
            </v-col>
            <v-col>
              <div class="caption podcast-body">
                <a :href="`../podcast/${post.slug}`">{{post.body.substring(0,120)+"..."}}</a>
              </div>
            </v-col>
          </v-row>
          <v-divider></v-divider>
        </v-col>
      </v-row>
    </v-container>

    <!-- Audio Player -->
    <div class="audio-player" v-if="audio">
      <!-- custom player -->
      <div
        class="custom-player"
        style="background-image:url('../images/music.jpg'); background-size:cover;background-position:center"
      >
        <v-btn @click="stop()" icon depressed>
          <v-icon size="42" color="white">{{icon}}</v-icon>
        </v-btn>

        <span class="slug">{{name}}</span>
      </div>
      <!-- Audio player -->
      <audio crossorigin :src="audio" ref="player" id="audio-player" preload="auto" autoplay></audio>
    </div>
    <!-- Audio Player Ends -->
  </div>
</template>

<script>
export default {
  data: () => ({
    posts: null,
    audio: null,
    dialog: false,
    icon: "mdi-play-circle-outline",
    name: null
  }),
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios
        .get("/api-podcasts")
        .then(response => {
          this.posts = response.data;
        })
        .catch(e => {
          this.error.push(e);
        });
    },
    selected(event) {
      this.audio = "";
      this.audio = "../storage/audio/" + event.currentTarget.id;
      this.icon = "mdi-play-pause";
      this.name = event.currentTarget.name;
      console.log();
    },
    stop(event) {
      var a = this.$refs.player;
      if (a.paused) {
        a.play();
        this.icon = "mdi-play-pause";
      } else {
        a.pause();
        this.icon = "mdi-play-circle-outline";
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.podcast-page {
  position: relative;
  padding-bottom: 3em;

  audio {
    position: fixed;
    bottom: 46px;
    width: 100%;
    border-radius: 0px;
  }
  .custom-player {
    position: fixed;
    bottom: 46px;
    left: 0;
    right: 0;
    background: #348f50;
    background: -webkit-linear-gradient(to right, #56b4d3, #348f50);
    background: linear-gradient(to right, #56b4d3, #348f50);
    padding: 0.7em;
    .slug {
      color: #fff;
      font-size: 1.1em;
      margin-left: 10px;
    }
  }
  .single-podcast-home {
    padding-top: 0px;
    padding-bottom: 0px;

    .featured-image {
      border-radius: 12px;
    }

    .play-btn {
      opacity: 0.8;
    }
    .postTitle {
      font-size: 0.9em;
      margin-top: 6px;
    }
    .podcast-body {
      a {
        color: #444;
      }
    }
  }
}
</style>
