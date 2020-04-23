<template>
  <div>
    <v-avatar size="20">
      <v-img
        :src="`/storage/profile/${post.user.image}`"
        lazy-src="images/lazy.jpg"
        aspect-ratio="1"
        class="grey lighten-4"
      >
        <template v-slot:placeholder>
          <v-row class="fill-height ma-0" align="center" justify="center">
            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </v-avatar>
    {{post.user.name}}
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
        .get("/podcast/{slug}")
        .then(response => {
          this.posts = response.data;
        })
        .catch(e => {
          this.error.push(e);
        });
    }
  }
};
</script>

<style>
</style>