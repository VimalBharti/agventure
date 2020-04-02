require("./bootstrap");

window.Vue = require("vue");
import moment from "moment";

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("LL");
    }
});

import CoolLightBox from "vue-cool-lightbox";
Vue.use(CoolLightBox);

import VueClipboard from "vue-clipboard2";
Vue.use(VueClipboard);

import Toastr from "vue-toastr";
Vue.use(Toastr);

import Vuetify from "vuetify";
Vue.use(Vuetify);

import VueRouter from "vue-router";
import { routes } from "./routes";
Vue.use(VueRouter);
const router = new VueRouter({
    mode: "history",
    routes
});

// Vue.component("example-component",require("./components/ExampleComponent.vue").default);
Vue.component("news", require("./components/news.vue").default);
Vue.component("chat", require("./components/chat.vue").default);
Vue.component("image-upload", require("./components/ImageUpload.vue").default);
Vue.component("all-post", require("./components/AllPost.vue").default);
Vue.component("single-post", require("./components/Single.vue").default);
Vue.component("blog", require("./components/Blog.vue").default);
Vue.component("all-podcast", require("./components/Podcast.vue").default);
Vue.component("like", require("./components/Like.vue").default);

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router
});
