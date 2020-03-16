<template>
  <span>
    <a href="#" v-if="isLiked" @click.prevent="unLike(post)">
      <v-icon color="pink">mdi-heart</v-icon>
    </a>
    <a href="#" v-else @click.prevent="like(post)">
      <v-icon>mdi-heart</v-icon>
    </a>
  </span>
</template>

<script>
export default {
  props: ["post", "liked"],
  data() {
    return {
      isLiked: ""
    };
  },

  mounted() {
    this.isLiked = this.isLike ? true : false;
  },

  computed: {
    isLike() {
      return this.isLiked;
    }
  },
  methods: {
    like(post) {
      axios
        .post("/like/" + post)
        .then(response => (this.isLiked = true))
        .catch(response => console.log(reponse.data));
    },
    unLike(post) {
      axios
        .post("/unlike/" + post)
        .then(response => (this.isLiked = false))
        .catch(response => console.log(response.data));
    }
  }
};
</script>

<style>
</style>