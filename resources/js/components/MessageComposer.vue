<template>
  <div class="composer">
    <textarea v-model="message" @keydown.enter="send" placeholder="Type message here ..."></textarea>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: ""
    };
  },
  methods: {
    send(e) {
      e.preventDefault();
      if (this.message == "") {
        return;
      }
      this.$emit("send", this.message);
      this.message = "";
    }
  }
};
</script>

<style lang="scss" scoped>
.composer textarea {
  width: 100%;
  margin-top: 10px;
  resize: none;
  border-radius: 3px;
  border: 1px solid lightgray;
  padding: 6px;
  background: #fff;
}
</style>