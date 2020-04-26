<template>
  <v-row>
    <v-col cols="6" class="mx-auto">
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
        <v-card>
          <v-card-text>
            <h4>
              <v-icon small>mdi-pencil</v-icon>
              <span>Share an update!</span>
            </h4>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="12">
                <v-textarea
                  required
                  v-model="about"
                  label="Whats on your mind?"
                  solo
                  flat
                  rows="2"
                  auto-grow
                  name="about"
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
            <v-progress-linear color="teal" indeterminate rounded height="4" v-if="loading"></v-progress-linear>
            <v-row class="upload-control">
              <label for="file">
                <v-icon size="30">mdi-camera</v-icon>
              </label>
              <input type="file" id="file" @change="onInputChange" multiple />

              <!-- Share Button -->
              <v-spacer></v-spacer>
              <v-btn outlined @click="upload" color="teal" small>Share Post</v-btn>
            </v-row>
          </v-card-text>
        </v-card>
      </div>
    </v-col>
    <v-snackbar v-model="toaster" :timeout="timeout" top>
      {{ text }}
      <v-btn color="teal" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-row>
</template>

<script>
export default {
  props: ["user"],
  data: () => ({
    isDragging: false,
    loading: false,
    toaster: false,
    text: "Post shared successfully!",
    timeout: 3000,
    error: "",
    dragCount: 0,
    files: [],
    photos: [],
    about: "",
    communities: [],
    community: ""
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
      this.loading = true;
      const formData = new FormData();

      formData.append("about", this.about);
      formData.append("community", this.community);

      this.files.forEach(file => {
        formData.append("photos[]", file, file.name);
      });

      let axiosConfig = {
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
          "Access-Control-Allow-Origin": "*"
        }
      };

      axios
        .post("/images-upload", axiosConfig, formData)
        .then(response => {
          this.toaster = true;
          this.loading = false;
          this.photos = [];
          this.files = [];
          this.about = "";
          this.community = [];
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~vue-toastr/src/vue-toastr.scss";

.imagePost {
  margin-top: 10%;
}

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
