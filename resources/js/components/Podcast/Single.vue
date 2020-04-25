<template>
  <div>
    <v-avatar size="20">
      <v-img lazy-src="images/lazy.jpg" aspect-ratio="1" class="grey lighten-4">
        <template v-slot:placeholder>
          <v-row class="fill-height ma-0" align="center" justify="center">
            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </v-avatar>
    <h1>hhbh {{podcast}}</h1>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data: () => ({
    podcast: null,
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
        .get("/podcast/" + this.id)
        .then(response => {
          this.podcast = response.data;
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