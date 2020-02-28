require("./bootstrap");

window.Vue = require("vue");

import Toastr from "vue-toastr";
Vue.use(Toastr);

import VueRouter from "vue-router";
Vue.use(VueRouter);

import Vuetify from "vuetify";
Vue.use(Vuetify);

// Vue.component("example-component",require("./components/ExampleComponent.vue").default);
Vue.component("news", require("./components/news.vue").default);
Vue.component("chat", require("./components/chat.vue").default);
Vue.component("image-upload", require("./components/ImageUpload.vue").default);
Vue.component("all-post", require("./components/AllPost.vue").default);

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify()
});
