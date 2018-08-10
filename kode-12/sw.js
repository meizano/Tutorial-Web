self.addEventListener('install', function (event) {
  console.log('SW terinstal');
  event.waitUntil(
    caches.open('static')
      .then(function (cache) {
        // cache.add('./');
        // cache.add('./index.html');
        // cache.add('./js/app.js');
        cache.addAll([
          './',
          './index.html',
          './js/app.js',
          './css/app.css',
          './images/pwa.jpg'
        ]);
      })
  );
});

self.addEventListener('activate', function () {
  console.log('SW aktif');
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(res) {
        if (res) {
          return res;
        } else {
          return fetch(event.request);
        }
      })
  );
});
