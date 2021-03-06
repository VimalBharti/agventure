importScripts(
    "https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js"
);

workbox.precaching.precacheAndRoute([{"revision":"40e9c9a47b13f7ebb75525d6fdd15380","url":"css/app.css"},{"revision":"7765aff5590d35b5730946bd2988f618","url":"css/icons.min.css"},{"revision":"3ccd1b48cbe501529d9255b8b7227728","url":"css/image-grid.css"},{"revision":"b190162194748bc84f4e19dac44474ec","url":"css/lightbox.min.css"},{"revision":"53253ff8ac63310a343a63b643153bf3","url":"css/navbar.bkp.css"},{"revision":"aca120f20f57b2c0420d130481dc43bf","url":"icons/icon-128x128.png"},{"revision":"9083820390e3de05af1251b31de21a48","url":"icons/icon-144x144.png"},{"revision":"a800a6666b4f2c8012c4f879b02ac61b","url":"icons/icon-152x152.png"},{"revision":"ae99cd0e681f61685082fa1bed881fda","url":"icons/icon-192x192.png"},{"revision":"56602c62df4b3b5bb4f6e0319cf5f90f","url":"icons/icon-384x384.png"},{"revision":"0ede18ff93b5a7ed9c9a03866bba89d3","url":"icons/icon-512x512.png"},{"revision":"a66cf480756dadf6f7b3bf288b8db859","url":"icons/icon-72x72.png"},{"revision":"4a2935c6e42dc4c11a2d4318f56b21a8","url":"icons/icon-96x96.png"},{"revision":"b49a2c55c667d26a930e48e0cb94b649","url":"images/add.png"},{"revision":"7b3ad32d656a2da916eeea2791567207","url":"images/agrishi.png"},{"revision":"e6d2a215444f21ea81ae1e80042dcfb7","url":"images/black.png"},{"revision":"96768fa5be81ad03c42b081e08fe3c05","url":"images/card-bg.jpg"},{"revision":"d9d2d0b1308cb694aa8116915592e2a9","url":"images/close.png"},{"revision":"2ff3663abf79fa7b9e45612cfdb72502","url":"images/cover-bg.jpg"},{"revision":"5721189766560297f8057a4a350a1995","url":"images/facebook.png"},{"revision":"33e51f47a4d6aa1c52f5838845ac9233","url":"images/google.png"},{"revision":"2e1b5bb12e7097f510c550a38beb8cd3","url":"images/green.png"},{"revision":"c2996b5eec4986e80f53493acfe7de8c","url":"images/hero-bg.png"},{"revision":"1886673cc3f2e609aad468a2a45a9e51","url":"images/lazy.jpg"},{"revision":"be0a2c349ab6ad6aa97212db09279243","url":"images/login-bg.jpg"},{"revision":"614f60a3d45564dae11f9ed4d9edceea","url":"images/login.png"},{"revision":"996b39634e6194b148cd287395322612","url":"images/logo.png"},{"revision":"cacb9f747706c81ec70091594c16d567","url":"images/logoB.png"},{"revision":"7f6d0000d70109d3a01d57b3b44f7230","url":"images/logoBox.png"},{"revision":"55aafb5759322de9fc91a7b604c3d019","url":"images/logoFull.png"},{"revision":"b61ebeff51bb6167efb32a5d70d0d036","url":"images/logout.png"},{"revision":"01cf2d2a9bffbfee4d21d1705327bd62","url":"images/message.png"},{"revision":"31f15875975aab69085470aabbfec802","url":"images/next.png"},{"revision":"7e4931a19b54c3913b1e48784eeaa14b","url":"images/podcast.png"},{"revision":"21c859422ad8392be2fdde6e9da392a0","url":"images/podkast-bg.jpg"},{"revision":"27c9716238f4cdcae4303f5e56b27066","url":"images/post-bg.jpg"},{"revision":"11af3cd93dd7eda0d1877d2bcc293a34","url":"images/post.png"},{"revision":"84b76dee6b27b795e89e3649078a11c2","url":"images/prev.png"},{"revision":"f6ec0e28762bf185c19c4bffb1b837a3","url":"images/red.png"},{"revision":"55708d92397c6fbc72064a0c50888efd","url":"images/sound.png"},{"revision":"e90af7b8208ef9386b81d4a152e904da","url":"images/user-profile.jpg"},{"revision":"028fc8da0adfcbd9c6736e4666cb2a11","url":"images/weather.jpg"},{"revision":"d730905449bc2e2640e75e8a1608788d","url":"images/weather.png"},{"revision":"dec2428bd65fa3ea8dc26af9d16c3f95","url":"images/weatherr copy.jpg"},{"revision":"85c29c5c9137da905b7f9fac7aa73b4d","url":"js/app.js"},{"revision":"a834d8a5e8132fa7315ecfc2c49692b1","url":"js/audio.min.js"},{"revision":"12b69d0ae6c6f0c42942ae6da2896e84","url":"js/jquery.js"},{"revision":"a831328bce88208717e8d9008b27dcd0","url":"js/lightbox.js"},{"revision":"93d0edad8eb30fe8b8e44ed860cc4e13","url":"js/vplayer.js"},{"revision":"69d015ddf0d1d454764152a2fc57a858","url":"offline.html"}]);

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
