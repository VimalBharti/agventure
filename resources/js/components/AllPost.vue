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
                <v-menu
                  v-model="menu"
                  :close-on-content-click="false"
                  :nudge-width="200"
                  offset-x
                  open-on-hover
                >
                  <template v-slot:activator="{ on }">
                    <a class="auth-name" v-on="on">{{post.user.name}}</a>
                  </template>

                  <v-card max-width="344">
                    <v-list>
                      <v-list-item>
                        <v-list-item-avatar>
                          <img :src="`/storage/profile/${post.user.image}`" />
                        </v-list-item-avatar>
                        <v-list-item-content>
                          <v-list-item-title>{{post.user.name}}</v-list-item-title>
                          <v-list-item-subtitle>
                            <span>@</span>
                            {{post.user.username}}
                          </v-list-item-subtitle>
                        </v-list-item-content>
                      </v-list-item>
                    </v-list>

                    <v-divider></v-divider>

                    <v-card-text>
                      <p>{{post.user.about}}</p>
                    </v-card-text>

                    <v-divider></v-divider>

                    <div class="public-user-hover-detail">
                      <div class="a-link">
                        <a href="#">
                          <v-icon>mdi-account-check</v-icon>Connect
                        </a>
                      </div>
                      <div class="a-link">
                        <a href="#">
                          <v-icon>mdi-message-text-outline</v-icon>Message
                        </a>
                      </div>
                    </div>
                  </v-card>
                </v-menu>
              </v-list-item-title>
              <v-list-item-subtitle>{{post.created_at}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-container v-if="post.body">
            <p class="post-body">{{post.body}}</p>
          </v-container>

          <!-- <v-container>
            <v-row>
              <v-col v-for="image in post.postdetails" :key="image.id">
                <v-img
                  :src="`/storage/uploads/${image.filename}`"
                  aspect-ratio="1"
                  :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                ></v-img>
              </v-col>
            </v-row>
          </v-container>-->
          <div class="gallery">
            <div class="gallery-panel" v-for="image in post.postdetails" :key="image.id">
              <img
                :src="`/storage/uploads/${image.filename}`"
                :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
              />
            </div>
          </div>
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
    col6: "6"
  }),

  // Fetch all post when compnent is created.
  created() {
    axios
      .get("/get_all")
      .then(response => {
        this.posts = response.data;
      })
      .catch(e => {
        this.error.push(e);
      });
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
  max-height: 21vw;
  overflow: hidden;
}
.gallery-panel {
  padding: 0.3rem;
  img {
    width: 100%;
    height: 20vw;
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
</style>