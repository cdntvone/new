<?php

header("Content-type: application/json; charset=utf-8");

$aa = site_url();
$dasdsada = parse_url($aa, PHP_URL_HOST);
$fsdsf = explode('.', $dasdsada);
$sep = ucwords(preg_replace("/[^a-zA-Z]+/", " ", $fsdsf[count($fsdsf)-2]));
$sht = str_replace(' ', '', strtolower($sep));

$url =  'https://'.$_SERVER['SERVER_NAME'];
$image192 = cdn() . '/images/android-chrome-192x192.png';
$image512 = cdn() .'/images/android-chrome-512x512.png';

echo '{
   "short_name":"'.$sht.'",
   "name":"Movies & TV Shows",
   "description":"Free Movies & TV Shows online",
   "icons":[
      {
         "src":"'.$image192.'",
         "sizes":"192x192",
         "type":"image/png",
         "density":"1.0"
      },
      {
         "src":"'.$image512.'",
         "sizes":"512x512",
         "type":"image/png",
         "density":"1.0",
         "purpose":"maskable"
      }
   ],
   "start_url":"'.$url.'/?source=pwa",
   "background_color":"#ffffff",
   "orientation":"landscape-primary",
   "display":"standalone",
   "scope":"/",
   "theme_color":"#231f36"
}';?>