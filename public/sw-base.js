importScripts(
    "https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js"
);

workbox.precaching.precacheAndRoute(self.__WB_MANIFEST);

workbox.routing.registerRoute(
    new RegExp("/storage/"),
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: "storage",
        plugins: [
            new workbox.expiration.ExpirationPlugin({
                maxEntries: 20
            }),
            new workbox.cacheableResponse.CacheableResponse({
                statuses: [200]
            })
        ]
    })
);

// Offline
const networkFirstHandler = new workbox.strategies.NetworkFirst({
    cacheName: "dynamic",
    plugins: [
        new workbox.expiration.ExpirationPlugin({
            maxEntries: 10
        }),
        new workbox.cacheableResponse.CacheableResponse({
            statuses: [200]
        })
    ]
});

const FALLBACK_URL = workbox.precaching.getCacheKeyForURL("/offline.html");
const matcher = ({ event }) => event.request.mode === "navigate";
const handler = args =>
    networkFirstHandler
        .handle(args)
        .then(response => response || caches.match(FALLBACK_URL))
        .catch(() => caches.match(FALLBACK_URL));

workbox.routing.registerRoute(matcher, handler);
