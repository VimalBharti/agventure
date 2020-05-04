self.addEventListener("install", function(event) {
    console.log("[Service Worker] Installing Service Worker ...", event);
    event.waitUntil(
        caches.open("static").then(function(cache) {
            cache.addAll([
                "/",
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
    console.log("[Service Worker] Activating Service Worker ....", event);
});

self.addEventListener("fetch", function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            if (response) {
                return response;
            } else {
                return fetch(event.request).then(function(res) {
                    return caches.open("dynamic").then(function(cache) {
                        cache.put(event.request.url, res.clone());
                        return res;
                    });
                });
            }
        })
    );
});