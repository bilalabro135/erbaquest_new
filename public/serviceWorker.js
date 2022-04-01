const staticDevCoffee = "dev-erba-quest-v1"
const assets = [
  "/",
  "/css/style.css",
  "/js/app.js",
  "/images/logo.png",
]

self.addEventListener("install", installEvent => {
    self.skipWaiting();
  installEvent.waitUntil(
    caches.open(staticDevCoffee).then(cache => {
      cache.addAll(assets)
    })
  )
})

self.addEventListener("fetch", fetchEvent => {
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request)
    })
  )
})