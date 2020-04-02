<template>
  <span>
    <v-btn
      small
      depressed
      class="white text-capitalize"
      v-if="isFavorited"
      @click.prevent="unFavorite(post)"
    >
      <v-icon color="pink">mdi-bookmark-check</v-icon>Saved
    </v-btn>
    <v-btn small depressed class="white text-capitalize" v-else @click.prevent="favorite(post)">
      <v-icon color="grey">mdi-bookmark-check</v-icon>Save
    </v-btn>
  </span>
</template>

<script>
export default {
  props: ["post", "favorited"],
  data() {
    return {
      isFavorited: ""
    };
  },

  mounted() {
    this.isFavorited = this.isFavorite ? true : false;
  },

  computed: {
    isFavorite() {
      return this.favorited;
    }
  },
  methods: {
    favorite(post) {
      axios
        .post("/favorite/" + post)
        .then(response => (this.isFavorited = true))
        .catch(response => console.log(reponse.data));
    },
    unFavorite(post) {
      axios
        .post("/unfavorite/" + post)
        .then(response => (this.isFavorited = false))
        .catch(response => console.log(response.data));
    }
  }
};
</script>

<style>
</style>