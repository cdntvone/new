<?php

require_once('data/term.php');

$uri = isset($uri) ? $uri : '';

if (($pos = strrpos($uri, '/')) !== false) {
    $url_str = substr($uri, $pos+1);
}

define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('INCLUDE_PATH', DOCUMENT_ROOT . '/');

$src = array(
    options('search_url'),
    options('category_url'),
    options('url_page'),
    options('url_movie'),
    options('url_tv')
);

if (isset($_GET['q'])) {
    $destination = options('search_url');
} elseif (isset($_GET['act'])) {
    $destination = 'url_view';
} elseif (isset($_GET['watch'])) {
    $destination = 'watch';
} elseif (f($uri, 'sitemap.xml') == 'sitemap.xml') {
    $destination = 'sitemap.xml';
} elseif (f($uri, 'register') == 'register') {
    $destination = 'register';
} elseif (f($uri, 'signup') == 'signup') {
    $destination = 'signup';
} elseif (f($uri, 'about') == 'about') {
    $destination = 'about';
} elseif (f($uri, 'privacy') == 'privacy') {
    $destination = 'privacy';
} elseif (f($uri, 'dmca') == 'dmca') {
    $destination = 'dmca';
} elseif (f($uri, 'contact') == 'contact') {
    $destination = 'contact';
} elseif (f($uri, 'site.webmanifest') == 'site.webmanifest') {
    $destination = 'site.webmanifest';
} elseif (f($uri, 'sw.js') == 'sw.js') {
    $destination = 'sw.js';
} elseif (strposa(dirname($uri), $src)) {
    $destination = f(dirname($uri), $src);
} else {
    $destination = 'homepage';
}

switch ($destination) {
    default:
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/index.php';
        break;
    case 'homepage':
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/index.php';
        break;
    case 'register':
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/register.php';
        break;
    case 'signup':
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/register.php';
        break;
    case options('url_movie'):
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/movie.php';
        break;
    case options('url_tv'):
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/tv.php';
        break;
    case options('category_url'):
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/category.php';
        break;
    case options('search_url'):
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/search.php';
        break;
    case 'url_view':
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.$_GET['act'].'.php';
        break;
    case 'watch':
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.$_GET['watch'].'.php';
        break;
    case 'about':
       $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.options('url_page').'/about.php';
        break;
     case 'privacy':
       $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.options('url_page').'/privacy.php';
        break;
     case 'dmca':
       $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.options('url_page').'/dmca.php';
        break;
     case 'contact':
       $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.options('url_page').'/contact.php';
        break;
    case options('url_page'):
        $pathinfo = pathinfo($uri);
        $goto = INCLUDE_PATH.'/theme/'.config('themes').'/'.options('url_page').'/'.$pathinfo['filename'].'.php';
        break;
    case 'sitemap.xml':
        $goto = INCLUDE_PATH.'/include/other/sitemap.php';
        break;
     case 'site.webmanifest':
       $goto = INCLUDE_PATH.'/include/other/pwa.php';
        break;
     case 'sw.js':
       $goto = INCLUDE_PATH.'/include/other/sw.php';
        break;
}

if (file_exists($goto)) {
    include $goto;
    exit;
}