require("./bootstrap");

window.Vue = require("vue");
import moment from "moment";

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("LL");
    }
});

import Toastr from "vue-toastr";
Vue.use(Toastr);

import Vuetify from "vuetify";
Vue.use(Vuetify);

Vue.component("chat", require("./components/chat.vue"));
Vue.component("image-upload", require("./components/ImageUpload.vue"));
Vue.component("new-podcast", require("./components/NewPodcast.vue"));
Vue.component("all-podcast", require("./components/Podcast/Podcast.vue"));
Vue.component(
    "mobile-podcast",
    require("./components/Podcast/MobilePodcast.vue")
);
Vue.component("single-podcast", require("./components/Podcast/Single.vue"));
Vue.component("like", require("./components/Like.vue"));
Vue.component("search", require("./components/Search.vue"));
Vue.component("new-post-mobile", require("./components/NewPostMobile.vue"));

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data() {
        return {
            comment: false,
            drawer: null,
            enrollNow: false
        };
    }
});

// Service worker
if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        navigator.serviceWorker.register("/service-worker.js").then(reg => {
            console.log("Service worker registered.", reg);
        });
    });
}
