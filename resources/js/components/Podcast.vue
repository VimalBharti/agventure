<template>
  <div class="pl-2 pr-2 podcast-page">
    <v-list two-line class="podcast-list">
      <v-card v-for="post of posts" :key="post.id" class="mb-2" outlined>
        <v-list-item>
          <v-list-item-action>
            <v-btn icon @click="selected($event)" :id="`${post.audio}`">
              <v-icon large>mdi-play-circle-outline</v-icon>
            </v-btn>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="post.slug"></v-list-item-title>
            <v-list-item-subtitle v-text="post.body"></v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-card>
    </v-list>
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
  </div>
</template>

<script>
export default {
  data: () => ({
    posts: null,
    audio: null,
    dialog: false
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
      console.log();
    }
  }
};
</script>

<style lang="scss" scoped>
.podcast-page {
  position: relative;

  audio {
    position: fixed;
    bottom: 46px;
    width: 100%;
    border-radius: 0px;
  }
  .podcast-list {
    padding-bottom: 6em;
  }
}
</style>
