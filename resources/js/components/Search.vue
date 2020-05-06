<template>
  <div>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-top-transition">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" icon>
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
      </template>

      <!-- Search Page -->
      <v-card>
        <v-app-bar color="white" dense flat class="mobile-nav">
          <v-btn icon @click="dialog = false">
            <v-icon>mdi-arrow-left</v-icon>
          </v-btn>
          <span class="ml-1 grey--text text--darken-4">Agrishi</span>
        </v-app-bar>

        <div class="search-box pa-2 mt-2">
          <v-text-field dense placeholder="Search" outlined v-model="search" @keyup="searchPost()"></v-text-field>
        </div>

        <div v-if="showsearch==true && this.search.length">
          <v-list three-line class="pa-2">
            <v-card class="mb-2" v-for="post in posts" :key="post.id" :href="`m/${post.slug}`">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-subtitle>{{post.about}}</v-list-item-subtitle>
                  <v-list-item-subtitle>{{post.created_at | formatDate}}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-card>
          </v-list>
        </div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      search: "",
      showsearch: false,
      posts: []
    };
  },
  methods: {
    searchPost() {
      fetch("api/search?q=" + this.search)
        .then(res => res.json())
        .then(res => {
          this.posts = res;
          this.showsearch = true;
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style>
</style>