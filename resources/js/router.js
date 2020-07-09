import Vue from "vue";
import VueRouter from "vue-router";

// All Routes

Vue.use(VueRouter);

const routes = [];

const router = new VueRouter({
    mode: "history",
    routes
});
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    window.axios.defaults.headers["Authorization"] = "Bearer " + token;
    next();
});

export default router;
