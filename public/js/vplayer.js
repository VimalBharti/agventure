var player = videojs("videoPlayer", {
    controls: true,
    loop: false,
    responsive: true,
    plugins: {
        hotkeys: {}
    },
    techOrder: ["youtube"]
});
