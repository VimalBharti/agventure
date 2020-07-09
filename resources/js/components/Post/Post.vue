<template>
  <div class="all-posts">
    <v-card flat class="all-post" v-for="(post, index) in posts" :key="index">
      <v-skeleton-loader v-show="sekelton" type="card"></v-skeleton-loader>

      <v-list-item>
        <v-avatar color="grey" size="36" v-if="post.user.image">
          <v-img
            aspect-ratio="1"
            class="grey lighten-2"
            :src="`/storage/profile/${post.user.image}`"
            v-if="post.user.image"
          ></v-img>
        </v-avatar>
        <v-avatar color="red" v-if="!post.user.image" size="35" clas>
          <span class="white--text title">
            {{
            post.user.name.substring(0, 1)
            }}
          </span>
        </v-avatar>
        <v-list-item-content class="ml-2">
          <v-list-item-title class="author-detail-anchor">
            <a class="auth-name">{{ post.user.name }}</a>
            <span class="only-desktop" v-if="post.community">
              <v-icon color="grey">arrow_right</v-icon>
              <span class="posted-text">posted on:</span>
              <a class="community-name">
                {{
                post.community.slug
                }}
              </a>
            </span>
          </v-list-item-title>
          <v-list-item-subtitle class="caption">{{ moment(post.created_at).fromNow() }}</v-list-item-subtitle>
        </v-list-item-content>
        <v-card-actions>
          <span class="grey--text ml-1">
            <v-icon>favorite_border</v-icon>
          </span>
        </v-card-actions>
      </v-list-item>
      <div v-if="post.postdetails.length" class="mb-3">
        <v-img
          :src="`/storage/thumbnails/${post.postdetails[0].thumb}`"
          lazy-src="images/lazy.jpg"
          :aspect-ratio="1.7"
          class="rounded-lg"
        ></v-img>
      </div>
      <div v-if="post.video" class="mb-3">
        <video
          class="video-js vjs-big-play-centered vjs-16-9 rounded-lg"
          data-setup="{}"
          controls
          preload="none"
          :poster="
                        `https://d158vexbkkk4m1.cloudfront.net/videos/${post.poster}`
                    "
        >
          <source
            :src="
                            `https://d158vexbkkk4m1.cloudfront.net/${post.video}`
                        "
            type="video/mp4"
          />
        </video>
      </div>
      <v-card-text class="post-about pt-0">
        <a :href="'/p/' + post.slug">{{ post.about.slice(0, 400) }}...</a>
      </v-card-text>
      <v-divider v-if="index + 1 < posts.length" :key="index"></v-divider>
    </v-card>

    <div class="infinite-wrapper">
      <infinite-loading
        spinner="spiral"
        force-use-infinite-wrapper=".infinite-wrapper"
        v-if="laodinIcon"
      ></infinite-loading>

      <v-btn
        @click="infiniteHandler()"
        block
        outlined
        color="grey"
        class="text-capitalize"
      >load more</v-btn>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import "video.js/dist/video-js.min.css";
import "video.js/dist/video.min.js";
import InfiniteLoading from "vue-infinite-loading";
import VueResource from "vue-resource";
import $ from "jquery";

export default {
  components: {
    InfiniteLoading
  },
  data() {
    return {
      posts: [],
      articles: [],
      sekelton: false,
      page: 1,
      laodinIcon: false
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData: async function() {
      this.sekelton = true;
      axios
        .get("/get_all")
        .then(res => {
          if (res.status == 200) {
            this.posts = res.data.data;
          }
          this.sekelton = false;
        })
        .catch(err => {
          console.log(err);
        });
    },
    moment,
    infiniteHandler($state) {
      this.laodinIcon = true;
      let vm = this;

      this.$http
        .get("/get_all?page=" + this.page)
        .then(response => {
          return response.json();
        })
        .then(newResponse => {
          $.each(newResponse.data, function(key, value) {
            vm.posts.push(value);
          });
          this.laodinIcon = false;
        });

      this.page = this.page + 1;
    }
  }
};
</script>

<style lang="scss" scoped>
.post-about {
  a {
    color: #4a4a4a !important;
    line-height: 1.38;
    font-size: 14px;
  }
}
.author-detail-anchor {
  a {
    font-size: 14px;
    // font-weight: bold;
    color: rgb(23, 65, 65);
  }
  .posted-text {
    font-size: 14px;
    color: #999;
  }
}
</style>
