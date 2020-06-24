<template>
  <v-row>
    <v-col class="pb-0 pt-0">
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
            <v-row>
              <v-col cols="12">
                <v-textarea
                  required
                  v-model="about"
                  label="About Video"
                  solo
                  flat
                  rows="2"
                  auto-grow
                  name="about"
                ></v-textarea>
              </v-col>
            </v-row>
            <p v-if="error" class="red--text">{{error}}</p>

            <v-divider></v-divider>

            <v-progress-linear color="teal" height="10" :value="progress" striped></v-progress-linear>

            <v-row>
              <v-col>
                <input
                  type="file"
                  :rules="rules"
                  class="input-video"
                  accept="video/mp4, video/m3u8, video/mov, video/avi, video/3gp"
                  @change="handleFileUpload"
                />
              </v-col>

              <v-col>
                <input
                  type="file"
                  :rules="rules"
                  class="poster"
                  ref="poster"
                  accept="image/*"
                  @change="handlePosterUpload"
                />
              </v-col>
            </v-row>

            <v-row class="upload-control">
              <v-btn block dark @click="submitFile" color="teal">Share Post</v-btn>
            </v-row>
          </v-card-text>
        </v-card>
      </div>
    </v-col>
    <v-snackbar v-model="toastr" :timeout="timeout" top>
      {{ text }}
      <v-btn color="teal" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-row>
</template>

<script>
export default {
  props: ["user"],
  data: () => ({
    toastr: false,
    text: "Post shared successfully!",
    timeout: 3000,
    error: "",
    about: "",
    communities: [],
    community: "",
    filename: "",
    file: "",
    poster: "",
    progress: "0",
    rules: [
      value =>
        !value ||
        value.size < 200000000 ||
        "Video size should be less than 200 MB!"
    ]
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
    handleFileUpload(e) {
      console.log(e.target.files[0]);
      this.filename = e.target.files[0].name;
      this.file = e.target.files[0];
    },
    handlePosterUpload(e) {
      console.log(e.target.files[0]);
      this.poster = e.target.files[0];
    },
    submitFile(e) {
      e.preventDefault();
      let currentObj = this;

      let formData = new FormData();

      formData.append("about", this.about);
      formData.append("community", this.community);
      formData.append("file", this.file);
      formData.append("poster", this.poster);

      axios
        .post("/video-upload", formData, {
          header: {
            "Content-Type": "multipart/form-data"
          },
          onUploadProgress: e => {
            if (e.lengthComputable) {
              this.progress = (e.loaded / e.total) * 100;
              console.log(this.progress);
            }
          }
        })
        .then(response => {
          currentObj.success = response.data.success;
          currentObj.filename = "";
          this.toastr = true;
          console.log("SUCCESS!!");
        })
        .catch(error => {
          currentObj.output = error;
          console.log("FAILURE!!");
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
}
.audio-file-input {
  margin-top: 2em;
}
input.input-video {
  background: teal;
  color: #fff;
  height: 40px;
  padding-top: 6px;
}
input#file-upload-button {
  background: teal;
  color: #fff;
}
</style>
