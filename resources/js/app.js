require("./bootstrap");

window.Vue = require("vue");

import vuetify from "./vuetify";
import router from "./router";
Vue.component(
    "add-article",
    require("./components/Article/addArticle.vue").default
);
Vue.component("leftsidebar", require("./components/Leftsidebar.vue").default);
Vue.component("chat", require("./components/chat.vue").default);
Vue.component("image-upload", require("./components/ImageUpload.vue").default);
Vue.component("video-upload", require("./components/VideoUpload.vue").default);
Vue.component("new-podcast", require("./components/NewPodcast.vue").default);
Vue.component("all-post", require("./components/Post/Post.vue").default);
Vue.component("rightsidebar", require("./components/Rightsidebar.vue").default);
Vue.component(
    "all-podcast",
    require("./components/Podcast/Podcast.vue").default
);
Vue.component(
    "mobile-podcast",
    require("./components/Podcast/MobilePodcast.vue").default
);
Vue.component(
    "single-podcast",
    require("./components/Podcast/Single.vue").default
);
Vue.component("like", require("./components/Like.vue").default);
Vue.component("search", require("./components/Search.vue").default);
Vue.component(
    "new-post-mobile",
    require("./components/NewPostMobile.vue").default
);

new Vue({
    el: "#app",
    vuetify,
    router,
    data() {
        return {
            comment: false,
            drawer: null,
            enrollNow: false,
            videoLazy: false
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
