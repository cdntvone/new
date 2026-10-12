<?php

function get_header()  {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/theme/'. config('themes') . '/header.php')) {
        include($_SERVER['DOCUMENT_ROOT'] . '/theme/'. config('themes') . '/header.php');
    }
}
function get_footer() {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/theme/'. config('themes') . '/footer.php')) {
        include($_SERVER['DOCUMENT_ROOT'] . '/theme/'. config('themes') . '/footer.php');
    }
}

function Analytics() {
    if (options('Analytics') != '') {
        echo "\n    <script async src=\"https://www.googletagmanager.com/gtag/js?id=".options('Analytics')."\"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '".options('Analytics')."');
    </script>";
    }
}

function GoogleAds() {
    if (config('slotADS')  != '') {
        echo "
        <div class=\"container bg-white\">
        <script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-".config('pubID')."\" crossorigin=\"anonymous\"></script>
        <ins class=\"adsbygoogle\" 
          style=\"display:block\" 
          data-ad-client=\"ca-pub-".config('pubID')."\" 
          data-ad-slot=\"".config('slotADS')."\" 
          data-ad-format=\"auto\" 
          data-full-width-responsive=\"true\"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>\n";
        echo file_get_contents('adstera.txt');
    } else {
        return file_get_contents('adstera.txt');
    }
}
function Blocker() {
    if (config('cache') == 'true') {
        echo "<script>document.addEventListener(\"contextmenu\", function(e) { e.preventDefault(); }, false); document.onkeydown = function(e) { if(e.ctrlKey && e.which == 85 || e.ctrlKey && e.which == 73 || e.ctrlKey && e.which == 74 || e.ctrlKey && e.which == 67 || event.keyCode == 123) { return false; } }</script>";
    }
}
function sw() {
 
        echo "<script>if ('serviceWorker' in navigator){navigator.serviceWorker.register('/sw.js');}</script>\n";
 
}
function randomuser() {
    if (config('cdn') == 'true') {
        echo "\n    <script defer src=\"".options('cdnSite')."/js/user.js\"></script>\n";
    } else {
        echo "\n    <script defer src=\"".site_url()."/include/js/user.js\"></script>\n";
    }
}
function Histats() {
    if (config('histats_ID') != '') {
        echo "\n    <script type='text/javascript'>var _Hasync=_Hasync|| [];_Hasync.push(['Histats.start', '1,".config('histats_ID').",4,0,0,0,00010000']);_Hasync.push(['Histats.fasi', '1']);_Hasync.push(['Histats.track_hits', '']);(function(){var hs=document.createElement('script'); hs.type='text/javascript'; hs.async=true;hs.src=('//s10.histats.com/js15_as.js');(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);})();</script>";
    }
}
function cdn() {
    if (config('cdn') == 'true') {
        return options('cdnSite');
    } else {
        return site_url() . "/include";
    }
}
function foot() {  
        return '&copy; ' .date('Y') .' '. options('sitename');
    }
 

function _seo($query) {
    if (options('_seo') == 'true'):
    return site_url().'/'.options('search_url').'/'.permalink($query); else:
    return site_url().'/search?q='.permalink($query);
    endif;
}
function get_search_query($escaped = true) {
    global $url_str;
    if ($escaped):
    if ($_GET['q']):
    if (strpos($_GET['q'], 'https://') !== false) {
    $query = $_GET['q'];
    } else {
    $query = permalink($_GET['q'], array( 'delimiter' => ' ' ));
    } else:
    $query = str_replace('.html', '', $url_str);
    $query = str_replace('/', '', $query);
    $query = permalink($query, array( 'delimiter' => ' ' ));
    endif; else:
    $query = permalink($_GET['q']);
    endif;
    return trim(str_replace(range(0, 9), '', $query));
}
function web_title($separate = '', $options = array()) {
    global $title,$hack_title,$title_before,$title_after,$uri;
    $defaults = array(
        'term' => $hack_title,
        'before' => $title_before,
        'after' => $title_after
    );

    // Merge options
    $options = array_merge($defaults, $options);
    // If there is a post
    if ($title) {
        if ($options['term']) : $term = $options['term']; else: $term = $title;
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = $separate; else: $after = $options['after'];
        endif;
        $web_title = $before . $term . $after;
    }
    // If it's a category or tag
    elseif (isset($_GET['terms']) || strposa(dirname($uri), options('category_url')) !== false) {
    if ($options['term']) :
        $deskripsi = $options['term']; else:
        if (strposa(dirname($uri), options('category_url')) !== false) :
        $explode = explode('/', $uri);
        $deskripsi = ucwords(permalink($explode[2], array( 'delimiter' => '' ))); else :
        $deskripsi = ucwords(permalink($_GET['terms'], array( 'delimiter' => '' )));
        endif;
        endif;
        if ($options['before'] == ' ') : $before = ucwords(options('category_url')).' '; else: $before = $options['before'];
        endif;
        if ($options['after'] == ' ') : $after = ' '; else: $after = $options['after'];
        endif;
        $web_title = $before . $deskripsi . $separate;
    }
    // If it's a page on view folder
    elseif (isset($_GET['act']) || strpos(dirname($uri), options('url_page')) !== false) {
        if ($options['term']) :
            $deskripsi = $options['term']; else:
        if (strpos(dirname($uri), options('url_page')) !== false) :
        $pathinfo = pathinfo($uri) ;
        $deskripsi = ucwords(permalink($pathinfo['filename'], array( 'delimiter' => '' ))); else :
        $deskripsi = ucwords(permalink($_GET['act'], array( 'delimiter' => '' )));
        endif;
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $web_title = $before . $deskripsi . $after; //. $separate . $sep;
    }
    // If it's a 404
    elseif (isset($_GET['e']) == '404') {
        $web_title = 'Nothing Found';
    }
    // If it's a search
    elseif (isset($_GET['q']) || strpos(dirname($uri), options('search_url')) !== false) {
        if ($options['before'] == '') : $before = 'Search results for '; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after']. $separate;
        endif;
        $web_title =  'Search '. strtolower(bad_words(get_search_query())) . ' │ '. options('sitename');
    }
    // If there is a home or empty
    else {
        $web_title = options('sitename') ;
    }
    // Send it out
     echo $web_title;
}
function user_description($separate = '', $options = array()) {
    global $description,$hack_description,$description_before,$description_after,$uri;
    $defaults = array(
    'term' => $hack_description,
    'before' => $description_before,
    'after' => $description_after
    );

    $sep = options('sitedescription');
    // Merge options
    $options = array_merge($defaults, $options);
    // If there is a post
    if ($description) {
        if ($options['term']) :
        $deskripsi = ucwords(short($options['term'], 140)); elseif ($description):
        $deskripsi = ucwords(short($description, 140)); else:
        $pathinfo = pathinfo($uri);
        $deskripsi = ucwords(permalink($pathinfo['filename'], array( 'delimiter' => ' ' )));
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $user_description = $before . $deskripsi . $after. $options['after'];
    }
    // If it's a category or tag
    elseif (isset($_GET['terms']) || strpos(dirname($uri), 'category') !== false) {
        $tungtung = preg_split('/(?=\.[^.]+$)/', $_SERVER['SERVER_NAME']);
        $wwwwwwwwwwww = ucfirst(strtolower($tungtung[0]));
        if ($options['term']) :
        $deskripsi = $options['term']; else:
        if (strpos(dirname($uri), 'category') !== false) :
        $explode = explode('/', $uri);
        $deskripsi = ucwords(permalink($explode[2], array( 'delimiter' => ' ' ))); else :
        $deskripsi = ucwords(permalink($_GET['terms'], array( 'delimiter' => ' ' )));
        endif;
        endif;
        if ($options['before'] == '') : $before = 'Archives for Movies '; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ' - ' . $wwwwwwwwwwww; else: $after = $options['after'];
        endif;
        $user_description = $before . $deskripsi . $after;
    }
    // If it's a page on view folder
    elseif (isset($_GET['act']) || strpos(dirname($uri), options('url_page')) !== false) {
        if ($options['term']) :
        $deskripsi = short($options['term']); else:
        if (strpos(dirname($uri), options('url_page')) !== false) :
        $pathinfo = pathinfo($uri);
        $deskripsi = ucwords(permalink($pathinfo['filename'], array( 'delimiter' => '' ))); else :
        $deskripsi = ucwords(permalink($_GET['act'], array( 'delimiter' => '' )));
        endif;
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $user_description = $before . $deskripsi . $after . $separate;
    }
    // If it's a 404
    elseif (isset($_GET['e']) == '404') {
        $user_description = 'This is somewhat embarrassing, isn’t it?';
    }

    // If it's a search
    elseif (isset($_GET['q']) || strpos(dirname($uri), options('search_url')) !== false) {
        if ($options['before'] == '') : $before = 'Search results for '; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ' on ' . site_path() . $separate; else: $after = $options['after'];
        endif;
        $user_description = $before . ucwords(bad_words(get_search_query())) . $after ;
    }
    // If there is a home or empty
    else {
        $user_description = $sep;
    }
    // Send it out
    echo $user_description;
}
function user_keywords($separate = '', $options = array()) {
    global $keywords,$hack_keywords,$keywords_before,$keywords_after,$uri,$cek;
    $defaults = array(
    'term' => $hack_keywords,
    'before' => $keywords_before,
    'after' => $keywords_after
    );

    $sep = options('sitekeywords');
    // Merge options
    $options = array_merge($defaults, $options);
    // If there is a post
    if ($keywords) {
        if ($keywords) :
        $deskripsi = ucwords(short($keywords, 140)); else:
        $pathinfo = pathinfo($uri);
        $deskripsi = ucwords(permalink($pathinfo['filename'], array( 'delimiter' => ' ' )));
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $user_keywords = $before . $deskripsi . $after. $options['after'];
    }
    // If it's a category or tag
    elseif (isset($_GET['terms']) || strpos(dirname($uri), 'category') !== false) {
        $tungtung = preg_split('/(?=\.[^.]+$)/', $_SERVER['SERVER_NAME']);
        $wwwwwwwwwwww = ucfirst(strtolower($tungtung[0]));
        if ($options['term']) :
        $deskripsi = $options['term']; else:
        if (strpos(dirname($uri), 'category') !== false) :
        $explode = explode('/', $uri);
        $deskripsi = ucwords(permalink($explode[2], array( 'delimiter' => ' ' ))); else :
        $deskripsi = ucwords(permalink($_GET['terms'], array( 'delimiter' => ' ' )));
        endif;
        endif;
        if ($options['before'] == '') : $before = 'Archives for Movies '; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = '' . $wwwwwwwwwwww; else: $after = $options['after'];
        endif;
        $user_keywords = $before . $deskripsi . $after;
    }
    // If it's a page on view folder
    elseif (isset($_GET['act']) || strpos(dirname($uri), options('url_page')) !== false) {
        if ($options['term']) :
        $deskripsi = short($options['term']); else:
        if (strpos(dirname($uri), options('url_page')) !== false) :
        $pathinfo = pathinfo($uri);
        $deskripsi = ucwords(permalink($pathinfo['filename'], array( 'delimiter' => '' ))); else :
        $deskripsi = ucwords(permalink($_GET['act'], array( 'delimiter' => ' ' )));
        endif;
        endif;
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $user_keywords = $before . $deskripsi . $after . $separate;
    }
    // If it's a 404
    elseif (isset($_GET['e']) == '404') {
        $user_keywords = 'This is somewhat embarrassing, isn’t it?';
    }
    // If it's a search
    elseif (isset($_GET['q']) || strpos($uri, '/'.$cek[1].'/') !== false) {
        if ($options['before'] == '') : $before = ''; else: $before = $options['before'];
        endif;
        if ($options['after'] == '') : $after = ''; else: $after = $options['after'];
        endif;
        $user_keywords = $before . ucwords(bad_words(get_search_query())) . $after ;
    }
    // If there is a home or empty
    else {
        $user_keywords = $sep;
    }
    // Send it out
    echo $user_keywords;
}
if (config('dmca') != null) {
    if (strposa(canonical(), preg_split('/[,.\s;]+/', config('dmca')))) :
        header("Location: /");
    endif;
}

if (config('cache') == 'true') {
    $folder = array(
    'home' =>  $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/home/',
    'movie' =>  $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/movie/',
    'single' =>  $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/single/',
    );

    foreach ($folder as $key => $value) {
    cache_folder($value);
    }
}

function minify() {
    if (config('cache') == 'true') {
    global $hooks;
    $hooks->do_action('kompres');
    }
}

$robot = $_SERVER['DOCUMENT_ROOT'];
$hostname = $_SERVER['HTTP_HOST'];
$rname  = "/robots.txt";
if (! file_exists($robot.'/robots.txt')) {
    $txt = "";
    $txt .= "User-Agent: *\n";
    $txt .= "Disallow: \n\n";
    $txt .= "Sitemap: https://$hostname/sitemap.xml";
    file_put_contents($robot . $rname, $txt);
}

$adstxt = $_SERVER['DOCUMENT_ROOT'];
$rname  = "/ads.txt";
if (! file_exists($adstxt.'/ads.txt')) {
    $txt = "google.com, pub-".config('pubID').", DIRECT, f08c47fec0942fa0";
if (config('pubID') != '') {
    file_put_contents($adstxt . $rname, $txt);
    }
}