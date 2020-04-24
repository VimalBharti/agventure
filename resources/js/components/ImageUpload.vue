<template>
  <v-row>
    <v-col cols="7">
      <div class="imagePost">
        <v-card class="mb-2" flat>
          <select id="community-select" @change="onChange($event)">
            <option disabled selected>--- Select Commmunity ---</option>
            <option
              v-for="(community, index) in communities"
              :value="community.id"
              :key="index"
            >{{community.title}}</option>
          </select>
          <input v-model="community" hidden />
        </v-card>
        <v-card flat>
          <v-card-text>
            <h4>
              <v-icon small>mdi-pencil</v-icon>
              <span>Share an update!</span>
            </h4>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="1">
                <v-list-item-avatar color="grey">
                  <v-img
                    :src="`/storage/profile/${user.image}`"
                    lazy-src="https://picsum.photos/10/6"
                    aspect-ratio="1"
                    class="grey lighten-2"
                  ></v-img>
                </v-list-item-avatar>
              </v-col>
              <v-col cols="11">
                <v-textarea
                  required
                  v-model="about"
                  label="Whats on your mind?"
                  solo
                  flat
                  rows="1"
                  auto-grow
                ></v-textarea>
              </v-col>
            </v-row>
            <p v-if="error" class="red--text">{{error}}</p>

            <div
              class="uploader"
              @dragenter="onDragEnter"
              @dragleave="onDragLeave"
              @dragover.prevent
              @drop="onDrop"
              :class="{ dragging: isDragging }"
              v-show="photos.length"
            >
              <div class="images-preview">
                <div class="img-wrapper" v-for="(image, index) in photos" :key="index">
                  <img :src="image" :alt="`Agventure ${index}`" />
                  <div class="details">
                    <!-- <span class="name" v-text="files[index].name"></span> -->
                    <span class="size" v-text="getFileSize(files[index].size)"></span>
                  </div>
                </div>
              </div>
            </div>
            <v-divider></v-divider>
            <v-row class="upload-control">
              <label for="file">
                <v-icon>mdi-camera</v-icon>
              </label>
              <input type="file" id="file" @change="onInputChange" multiple />

              <!-- Share Button -->
              <v-spacer></v-spacer>
              <v-btn outlined @click="upload" small>Share</v-btn>
            </v-row>
          </v-card-text>
        </v-card>
      </div>
    </v-col>
    <v-col cols="5">
      <v-card>
        <v-card-text>
          <p class="title text--primary">Add Audio Podcast</p>
          <p>Upload audio podcast about this post, So people can listen the process or techniques in audio format.</p>

          <!-- Audio -->
          <div class="text--primary audio-file-input">
            <v-file-input
              v-model="audio"
              color="deep-purple accent-4"
              counter
              label="Upload Audio Podcast"
              dense
              placeholder="select mp3 file"
              prepend-icon="mdi-music"
              outlined
              name="audio"
              :show-size="1000"
              accept="audio/mp3"
            >
              <template v-slot:selection="{ index, text }">
                <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>{{ text }}</v-chip>

                <span
                  v-else-if="index === 2"
                  class="overline grey--text text--darken-3 mx-2"
                >+{{ files.length - 2 }} File(s)</span>
              </template>
            </v-file-input>

            <!-- Featured Image -->
            <v-file-input
              accept="image/png, image/jpeg, image/bmp"
              placeholder="upload jpg, png file"
              prepend-icon="mdi-camera"
              label="Select featured Image"
              v-model="featured"
            ></v-file-input>
          </div>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: ["user"],
  data: () => ({
    isDragging: false,
    error: "",
    dragCount: 0,
    files: [],
    photos: [],
    about: "",
    audio: null,
    communities: [],
    community: "",
    featured: null
  }),
  created() {
    this.fetchCommunity();
  },
  methods: {
    onChange(event) {
      console.log(event.target.value);
      this.community = event.target.value;
    },
    fetchCommunity() {
      axios.get("/get_community").then(response => {
        this.communities = response.data;
      });
    },
    onDragEnter(e) {
      e.preventDefault();

      this.dragCount++;
      this.isDragging = true;
    },
    onDragLeave(e) {
      e.preventDefault();

      this.dragCount--;
      if (this.dragCount <= 0) this.isDragging = false;
    },
    onInputChange(e) {
      const files = e.target.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;

      const files = e.dataTransfer.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);

      const img = new Image(),
        reader = new FileReader();

      reader.onload = e => this.photos.push(e.target.result);

      reader.readAsDataURL(file);
    },
    getFileSize(size) {
      const fSExt = ["Bytes", "KB", "MB", "GB"];
      let i = 0;

      while (size > 900) {
        size /= 1024;
        i++;
      }
      return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
    },
    upload() {
      const formData = new FormData();

      formData.append("body", this.body);
      formData.append("community", this.community);
      formData.append("audio", this.audio);
      formData.append("featured", this.featured);

      this.files.forEach(file => {
        formData.append("photos[]", file, file.name);
      });

      axios
        .post("/images-upload", formData)
        .then(response => {
          this.$toastr.s("Post shared successfully");
          this.photos = [];
          this.files = [];
          this.about = "";
          this.audio = null;
          this.featured = null;
          this.community = [];
        })
        .catch(error => {
          console.log(error);
          this.error = error.response.data.errors.body[0];
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~vue-toastr/src/vue-toastr.scss";

#community-select {
  width: 100%;
  border: 1px solid #dcdcdc;
  padding: 12px;
  font-size: 14px;
}
h4 {
  padding-bottom: 12px;
  font-weight: normal;
}
.uploader {
  width: 100%;
  background: #fafafa;
  color: #fff;
  padding: 10px;
  text-align: center;
  border-radius: 4px;
  border: 1px solid #dedede;
  font-size: 20px;
  position: relative;

  &.dragging {
    background: #fff;
    border: 1px dashed #888;
  }
  .images-preview {
    display: flex;
    flex-wrap: wrap;

    .img-wrapper {
      width: 10vw;
      margin-bottom: 1.6em;
      display: flex;
      flex-direction: column;
      margin: 5px;
      justify-content: space-between;
      background: #fff;
      box-shadow: 0px 0px 1px #3e3737;

      img {
        max-height: 120px;
      }
    }
    .details {
      font-size: 12px;
      background: #fff;
      color: #000;
      display: flex;
      flex-direction: column;
      align-items: self-start;
      padding: 3px 6px;
      .name {
        overflow: hidden;
        height: 18px;
      }
      .size {
        font-size: 11px;
        color: #777;
      }
    }
  }
}
.upload-control {
  padding-top: 15px;
  padding-right: 12px;
  padding-left: 12px;
  label {
    cursor: pointer;
    margin-right: 12px;
  }
  input {
    opacity: 0;
    visibility: hidden;
    z-index: -2;
  }
}
.audio-file-input {
  margin-top: 2em;
}
</style>
