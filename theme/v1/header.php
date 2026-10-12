<?php include ('include/data/tmdb.api.php'); //minify(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title><?php web_title();?></title>
    <meta name="description" content="<?php echo user_description();?>">
    <meta name="keywords" content="<?php echo user_keywords();?>">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="<?php echo site_url();?>/site.webmanifest">
    <link rel="alternate icon" type="image/x-icon" href="<?php echo cdn();?>/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo cdn();?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo cdn();?>/images/favicon-32x32.png">
    <meta property="og:title" content="<?php web_title();?>" />
    <meta property="og:description" content="<?php user_description();?>"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo site_uri()?>"/>
    <?php if (isset($backdrop)) { echo '<meta property="og:image" content="'.$backdrop.'">';} else { echo '<meta property="og:image" content="'.site_url().'/images/share.png">';}  echo Analytics(); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="preload" as="style">
    <link rel="stylesheet" href="<?php echo cdn();?>/css/v1.css" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"><?php if (isset($title)):?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.9.0/video-js.min.css" rel="preload" as="style">
    <link rel="stylesheet" href="<?php echo cdn();?>/css/video.css" rel="preload" as="style" onload="this.rel='stylesheet'">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.9.0/video.min.js"></script><?php endif;?>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-theme">
        <div class="container">
          <a class="navbar-brand logo" href="/" title="Movies & TV Shows" aria-label="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo site_url();?>/index/movie/" title="Movies">Movies</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url();?>/index/tv-series/"movie title="TV Series">TV Series</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Genres
                </a>
                <ul class="dropdown-menu genres text-bg-light p-3">
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/action/28">Action</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/adventure/12">Adventure</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/animation/16">Animation</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/comedy/35">Comedy</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/crime/80">Crime</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/documentary/99">Documentary</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/drama/18">Drama</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/family/10751">Family</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/fantasy/14">Fantasy</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/history/36">History</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/horror/27">Horror</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/music/10402">Music</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/mystery/9648">Mystery</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/romance/10749">Romance</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/science-fiction/878">Sci-Fi</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/thriller/53">Thriller</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/war/10752">War</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/genre/western/37">Western</a></li>
                </ul>
              </li>
            </ul>
            <form method="get" action="/search" class="d-flex search form-inline" role="search">
              <input class="form-control me-2" name="q" type="text" placeholder="Search..." autocomplete="off" required />
              <button class="search-button" type="submit" aria-label="search"></button>
            </form>
          </div>
        </div>
      </nav>
    </header>