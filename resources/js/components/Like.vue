<template>
  <span>
    <a v-if="isFavorited" @click.prevent="unFavorite(post)">
      <v-img src="images/green.png"></v-img>
    </a>
    <a v-else @click.prevent="favorite(post)">
      <v-img src="images/black.png"></v-img>
    </a>
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
