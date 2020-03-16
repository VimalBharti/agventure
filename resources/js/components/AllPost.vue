<template>
  <div class="all-post">
    <v-sheet class="px-3 pt-3 pb-3" v-if="!posts">
      <v-skeleton-loader
        class="mx-auto"
        type="list-item-avatar, divider, list-item-three-line, card-heading, image"
      ></v-skeleton-loader>
    </v-sheet>
    <v-row v-if="posts && posts.length">
      <v-col v-for="post of posts" :key="post.id" cols="12">
        <v-card flat>
          <v-list-item>
            <v-list-item-avatar color="grey">
              <v-img
                :src="`/storage/profile/${post.user.image}`"
                lazy-src="https://picsum.photos/10/6"
                aspect-ratio="1"
                class="grey lighten-2"
              ></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                <a :href="`${post.user.username}`" class="auth-name">{{ post.user.name }}</a>
              </v-list-item-title>
              <v-list-item-subtitle>{{ post.created_at | formatDate }}</v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
              <v-btn icon @click="addtofav()">
                <v-icon>mdi-bookmark-check</v-icon>
              </v-btn>
            </v-list-item-action>
            <v-list-item-action>
              <v-btn icon>
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
            </v-list-item-action>
          </v-list-item>

          <div class="gallery">
            <div class="gallery-panel" v-for="image in post.postdetails" :key="image.id">
              <img
                :src="`/storage/uploads/${image.filename}`"
                :lazy-src="
                                    `https://picsum.photos/10/6?image=${n * 5 +
                                        10}`
                                "
              />
            </div>
          </div>
          <v-container v-if="post.body">
            <p class="post-body">{{ post.body }}</p>
          </v-container>

          <div class="post-response"></div>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({
    posts: null,
    errors: []
  }),

  // Fetch all post when compnent is created.
  created() {
    this.fetchData();
  },
  // updated() {
  //   this.fetchData();
  // },
  methods: {
    fetchData() {
      axios
        .get("/get_all")
        .then(response => {
          this.posts = response.data;
        })
        .catch(e => {
          this.error.push(e);
        });
    },
    addtofav() {
      axios
        .post("/like")
        .then(response => {
          console.log("add to favourite");
        })
        .catch(e => {
          this.error.push(e);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.gallery {
  display: grid;
  grid-template-columns: auto auto auto;
  //   grid-gap: 1rem;
  max-width: 100rem;
  padding: 0 5px;
  max-height: 17vw;
  overflow: hidden;
}
.gallery-panel {
  padding: 0.3rem;
  img {
    width: 100%;
    height: 16vw;
    object-fit: cover;
    object-position: center top;
    border-radius: 0.55rem;
  }
}
.post-body {
  margin-left: 0.5rem;
  font-size: 15px;
  line-height: 21px;
  color: #444;
}
.likeBtn {
  cursor: pointer;
}
</style>
