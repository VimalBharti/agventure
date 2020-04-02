<template>
  <div class="all-post">
    <v-sheet class="px-3 pt-3 pb-3 mt-3" v-if="!posts">
      <v-skeleton-loader
        class="mx-auto"
        type="list-item-avatar, divider, list-item-three-line, card-heading, image"
      ></v-skeleton-loader>
    </v-sheet>
    <v-row v-if="posts && posts.length">
      <v-col v-for="post of posts" :key="post.id" cols="12" class="pt-0 pb-5">
        <v-card flat>
          <v-list-item>
            <v-list-item-avatar color="grey">
              <v-img
                :src="`/storage/profile/${post.user.image}`"
                lazy-src="images/lazy.jpg"
                aspect-ratio="1"
                class="grey lighten-2"
              ></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                <a :href="`${post.user.username}`" class="auth-name">{{ post.user.name }}</a>
                <span v-if="post.community">
                  <v-icon color="grey darken-2">mdi-menu-right</v-icon>
                  <span class="posted-text">posted on:</span>
                  <a
                    :href="`/c/${post.community.slug}`"
                    class="community-name"
                  >{{ post.community.title }}</a>
                </span>
              </v-list-item-title>
              <v-list-item-subtitle>{{ post.created_at | formatDate }}</v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
              <!-- <v-btn
                                small
                                depressed
                                class="white text-capitalize"
                                @click="addtofav()"
                            >
                                <v-icon>mdi-bookmark-check</v-icon>save
              </v-btn>-->
              <like :post="`${post.id}`" :favorited="`${post.favorited}`"></like>
            </v-list-item-action>
            <v-list-item-action>
              <v-menu offset-y>
                <template v-slot:activator="{ on }">
                  <v-btn icon>
                    <v-icon v-on="on">mdi-share-variant</v-icon>
                  </v-btn>
                </template>
                <v-list dense class="pa-0">
                  <v-list-item
                    v-clipboard:copy="
                                            `http://localhost:8000/p/${post.slug}`
                                        "
                    v-clipboard:success="onCopy"
                    v-clipboard:error="onError"
                    @click
                  >
                    <v-list-item-title>
                      <v-icon class="mr-1">mdi-link-variant</v-icon>Copy link
                    </v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
            </v-list-item-action>
          </v-list-item>

          <div class="snackbar">
            <v-alert
              v-model="snackbar"
              dismissible
              color="cyan"
              border="left"
              colored-border
              dense
              icon="mdi-checkbox-marked-outline"
            >{{ text }}</v-alert>
          </div>

          <a :href="`p/${post.slug}`">
            <v-container v-if="post.body">
              <div class="post-body">{{ post.body }}</div>
            </v-container>

            <div class="gallery">
              <div class="gallery-panel" v-for="image in post.postdetails" :key="image.id">
                <img :src="`/storage/uploads/${image.filename}`" lazy-src="images/lazy.jpg" />
              </div>
            </div>
          </a>

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
    errors: [],
    snackbar: false,
    text: "Post link has been copied"
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
    onCopy(e) {
      this.snackbar = true;
    },
    onError(e) {
      alert("Can not copy");
    }
  }
};
</script>

<style lang="scss" scoped>
.snackbar {
  position: fixed;
  right: 0;
  bottom: 12px;
  z-index: 999;
}
.auth-name {
  color: #333;
}
.community-name {
  color: #333;
}
.posted-text {
  color: #838181;
  font-weight: 200;
}
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
  font-size: 15px;
  line-height: 21px;
  color: #444;
}
.likeBtn {
  cursor: pointer;
}
</style>
