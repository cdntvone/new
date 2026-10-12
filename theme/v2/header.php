<?php include ('include/data/tmdb.api.php'); ?>
<!DOCTYPE html>
<html lang="en_US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php web_title();?></title>
    <meta name="description" content="<?php echo user_description();?>">
    <meta name="keywords" content="<?php echo user_keywords();?>">
    <meta property="og:title" content="<?php web_title();?>" />
    <meta property="og:description" content="<?php user_description();?>"/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo site_uri()?>"/>
    <meta name="theme-color" content="#111111">
    <?php if (isset($backdrop)) { echo '<meta property="og:image" content="'.$backdrop.'">';} else { echo '<meta property="og:image" content="'.cdn().'/images/share.png">';}  ?>

    <link rel="alternate icon" type="image/x-icon" href="<?php echo cdn();?>/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo cdn();?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo cdn();?>/images/favicon-32x32.png">
    <link rel="manifest" href="<?php echo site_url();?>/site.webmanifest">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo cdn();?>/css/v2.css">
    <script defer src="<?php echo cdn();?>/js/scripts.min.js"></script><?php if (isset($title)): ?>
    <script defer src="<?php echo cdn();?>/js/video.js"></script><?php endif; Analytics(); ?>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-mopie fixed-top">
      <a class="navbar-brand" href="/">
      <img width="168" src="<?php echo cdn();?>/images/logo.svg">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movies <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-menu mop" aria-labelledby="dropdown04">
              <div class="row">
                <div class="col-12">
                  <a class="dropdown-item" href="/index/now-playing">Now Playing</a>
                  <a class="dropdown-item" href="/index/popular-movies">Popular</a>
                  <a class="dropdown-item" href="/index/toprated-movies">Top Rated</a>
                  <a class="dropdown-item" href="/index/upcoming-movies">Coming Soon</a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="dropdown04" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">TV Shows <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-menu mop" aria-labelledby="dropdown04">
              <div class="row">
                <div class="col-12">
                  <a class="dropdown-item" href="/index/airing">Airing</a>
                  <a class="dropdown-item" href="/index/tv-popular">Popular</a>
                  <a class="dropdown-item" href="/index/on-the-air">On The Air</a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="dropdown04" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Genres <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-menu px-3" aria-labelledby="dropdown04">
              <div class="row">
                <div class="col-6 px-0">
                  <a class="dropdown-item" href="/genre/action/28">Action</a>
                  <a class="dropdown-item" href="/genre/adventure/12">Adventure</a>
                  <a class="dropdown-item" href="/genre/animation/16">Animation</a>
                  <a class="dropdown-item" href="/genre/comedy/35">Comedy</a>
                  <a class="dropdown-item" href="/genre/crime/80">Crime</a>
                  <a class="dropdown-item" href="/genre/documentary/99">Documentary</a>
                  <a class="dropdown-item" href="/genre/drama/18">Drama</a>
                  <a class="dropdown-item" href="/genre/family/10751">Family</a>
                  <a class="dropdown-item" href="/genre/fantasy/14">Fantasy</a>
                </div>
                <div class="col-6 px-0">
                  <a class="dropdown-item" href="/genre/history/36">History</a>
                  <a class="dropdown-item" href="/genre/horror/27">Horror</a>
                  <a class="dropdown-item" href="/genre/music/10402">Music</a>
                  <a class="dropdown-item" href="/genre/mystery/9648">Mystery</a>
                  <a class="dropdown-item" href="/genre/romance/10749">Romance</a>
                  <a class="dropdown-item" href="/genre/science-fiction/878">Sci-Fi</a>
                  <a class="dropdown-item" href="/genre/thriller/53">Thriller</a>
                  <a class="dropdown-item" href="/genre/war/10752">War</a>
                  <a class="dropdown-item" href="/genre/western/37">Western</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav">
          <form class="input-group my-2 my-md-0 mr-md-3 bg-faded" action="/search" method="GET"/>
            <input type="text" class="form-control" name="q" placeholder="Search..." aria-label="Search..."  autocomplete="off" required >
            <div class="input-group-append">
              <button class="btn btn-search focus-no-sh" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </form>
          <li class="nav-item">
            <button class="btn btn-outline-theme ml-md-3 mb-3 mb-md-0 sign-in">Sign In</button>
          </li>
          <li class="nav-item">
            <a href="/register" class="btn btn-theme ml-md-3">Register</i></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="sign-in-overlay"></div>
    <div class="signin js-signin-form">
      <div class="signin_close">
        <i class="fa fa-close" aria-hidden="true"></i>
      </div>
      <div class="signin_holder">
        <form id="signinfrom">
          <div class="h3">Sign In</div>
          <div class="form-group">
            <label for="signInEmail">Email</label>
            <input type="email" class="form-control bg-dark border-dark text-secondary" id="signInEmail" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We&#039;ll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="signPassword">Password</label>
            <input type="password" class="form-control bg-dark border-dark text-secondary" id="signPassword" placeholder="Password">
          </div>
          <div class="form-group">
            <label id="forgotpass" class="form-check-label small text-muted cursor text-hover-theme" for="exampleCheck1">Forgot Password?</label>
          </div>
          <div class="d-flex justify-content-center">
            <div class="spinner-border text-light loading_signIn text-center mb-3 d-none" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="text-danger sign-in-form-alert mb-3" role="alert"></div>
          <button type="submit" class="btn btn-outline-theme btn-block sign-in-submit">Sign In</button>
          <div class="divider divider--small"></div>
          <div class="text-center">
            <p class="text-small mb-3">Or</p>
            <a href="/register" class="btn btn-theme btn-block" type="button">Create Free Account</a>
          </div>
        </form>
        <form id="resetpassform">
          <div class="h3">Reset Password</div>
          <p class="text-muted">Enter your email address and we&#039;ll send you a link to reset your password.</p>
          <div class="form-group">
            <label for="resetEmail">Email</label>
            <input type="email" class="form-control bg-dark border-dark text-secondary" id="resetEmail" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="d-flex justify-content-center">
            <div class="spinner-border text-light loading_signIn text-center mb-3 d-none" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="text-danger sign-in-form-alert mb-3" role="alert"></div>
          <button type="submit" class="btn btn-outline-theme btn-block mb-3">Reset Password</button>
          <div id="backToSignIn" class="text-center cursor">Back to Sign In</div>
        </form>
      </div>
    </div>