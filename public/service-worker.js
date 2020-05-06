self.addEventListener("install", function(event) {
    console.log("[Service Worker] Installing Service Worker ...", event);
    event.waitUntil(
        caches.open("static").then(function(cache) {
            cache.addAll([
                "/js/app.js",
                "/css/app.css",
                "/images/logo2.png",
                "/offline.html",
                "/manifest.json"
            ]);
        })
    );
});

self.addEventListener("activate", function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames
                    .filter(function(cacheName) {})
                    .map(function(cacheName) {
                        return caches.delete(cacheName);
                    })
            );
        })
    );
});
