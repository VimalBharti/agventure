<template>
  <div class="feed" ref="feed">
    <ul v-if="contact">
      <li
        v-for="message in messages"
        :class="`message${message.receiver_id == contact.id ? ' sent' : ' received'}`"
        :key="message.id"
      >
        <div class="text">{{ message.message }}</div>
        <div class="timestamp">{{ message.created_at | formatDate}}</div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      type: Object
    },
    messages: {
      type: Array,
      required: true
    }
  },
  methods: {
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    }
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages) {
      this.scrollToBottom();
    }
  }
};
</script>

<style lang="scss" scoped>
.feed {
  background: #fff;
  height: 100%;
  max-height: 470px;
  overflow: scroll;
  ul {
    list-style-type: none;
    padding: 5px;
    li {
      &.message {
        margin: 10px 0;
        width: 100%;

        .timestamp {
          font-size: 11px;
          margin: 6px;
          color: #555;
        }

        .text {
          max-width: 200px;
          border-radius: 5px;
          padding: 8px 15px;
          display: inline-block;
        }

        &.received {
          text-align: left;
          .text {
            background: #ecebed;
          }
        }

        &.sent {
          text-align: right;
          .text {
            background: rgb(76, 167, 255);
            background: linear-gradient(
              247deg,
              rgba(76, 167, 255, 1) 0%,
              rgba(48, 108, 184, 1) 50%
            );
            color: #fff;
          }
        }
      }
    }
  }
}
</style>