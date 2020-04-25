<template>
  <v-row>
    <v-col cols="4" class="mx-auto mt-10">
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
        <v-card-actions class="pa-5">
          <v-btn outlined color="teal" block @click="upload">Submit Podcast</v-btn>
        </v-card-actions>
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
    body: "",
    audio: null,
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
          this.body = [];
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
