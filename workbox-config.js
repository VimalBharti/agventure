module.exports = {
    globDirectory: "public/",
    globPatterns: ["**/*.{js,css,png,jpg}", "offline.html"],
    swSrc: "public/sw-base.js",
    swDest: "public/service-worker.js",
    maximumFileSizeToCacheInBytes: 5000000,
    globIgnores: ["../workbox-cli-config.js", "storage/**"]
};
