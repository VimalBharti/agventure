<template>
  <span>
    <v-btn icon v-if="isFavorited" @click.prevent="unFavorite(post)">
      <v-icon size="28" color="pink">mdi-heart</v-icon>
    </v-btn>
    <v-btn icon v-else @click.prevent="favorite(post)">
      <v-icon size="28" color="grey">mdi-heart-outline</v-icon>
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

<style></style>
