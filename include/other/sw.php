<?php

header('Content-Type: application/javascript');
 
echo "var CACHE_NAME = '".config('themes')."';
urlsToCache = [
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/video.js/6.9.0/video.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/video.js/6.9.0/video-js.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'
];

self.addEventListener('install', function(event) {

  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('%cKEPO KONTOL!', 'color: red;font-size:64px; font-weight:bold');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('activate', function(event) {

  var cacheAllowlist = [CACHE_NAME];

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheAllowlist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

self.addEventListener('fetch', function(e) {});";?>