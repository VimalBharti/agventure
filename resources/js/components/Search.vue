<template>
  <div>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-top-transition">
      <template v-slot:activator="{ on }">
        <a v-on="on">
          <input type="text" placeholder="Search...." class="search-input-box" />
        </a>
      </template>

      <!-- Search Page -->
      <v-card class="search-result">
        <v-app-bar color="white" dense flat class="mobile-nav">
          <v-btn icon @click="dialog = false">
            <v-icon>mdi-arrow-left</v-icon>
          </v-btn>
          <span class="ml-1 grey--text text--darken-4">Agrishi</span>
        </v-app-bar>

        <div class="wrapper-search">
          <div class="search-box pa-2 mt-2">
            <v-text-field
              dense
              placeholder="Search..."
              autofocus
              outlined
              v-model="search"
              @keyup="searchPost()"
            ></v-text-field>
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

<style lang="scss" scoped>
.wrapper-search {
  padding-top: 3em;
}
.search-input-box {
  background-color: #efefef;
  padding: 8px 12px;
  border-radius: 10px;
}
</style>>