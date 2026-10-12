<?php $owl = true; include 'header.php';?>
    <main class="container bg-white py-4">
      <div class="row">
      <div class="col-md-9 border-right">
        <div id="player" class="bg-player" >
          <video oncontextmenu="return false;" id="myvideo" class="video-js vjs-default-skin vjs-16-9">
            <source src="<?php echo $mp4; ?>" type="video/mp4" />
            <source src="<?php echo config('cdn'); ?>/include/video/tv.mp4" type="video/mp4" />
          </video>
        </div>
        <div class="d-flex justify-content-center py-4">
          <button href="" onclick="play()" type="button" class="btn btn-danger"><span class="watch"></span>Play Now</button>
          <button href="/register?movie=<?php echo query($row['name']); ?>" class="btn btn-success"><span class="download"></span>download</button>
        </div><?php echo GoogleAds();?>

        <div class="row border-top py-4">
          <div class="col-md-3 d-none d-lg-block">
            <img class="fluid" src="<?php echo $poster; ?>" alt="<?php echo $title; ?>" width="300" height="450">
          </div>
          <div class="col-md-9">
            <div class="h5"><?php echo $title; ?></div>
            <div class="d-flex flex-wrap py-1">
              <div class="rate"><?php for ($k = 1; $k <= $get_rating; $k++) {?><span class="stars"></span><?php }?><span class="stars-half"></span><?php for ($i = $emp_rating; $i >= 2; $i--) {?><span class="stars-o"></span><?php $k++;}?>
              </div>
            </div>
            <div class="text-muted small py-1">
              <?php echo $rating; ?>/10 by <?php echo $vote_count; ?> users
            </div>
            <div class="py-2 mb-2">
              <?php echo $description;?> 
            </div>
          </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Details</button>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Season</a>
            <ul class="dropdown-menu genres text-bg-light p-3"><?php if (is_array($row['seasons'])) {
                foreach ((array) $row['seasons'] as $for):
                $url = seo_tv($id . '-' . $for['season_number'], $row['name']).$ref;
                $season = 'Season ' . $for['season_number'];
                if (empty($for['air_date'])) { continue;}?> 

              <li><a class="dropdown-item" href="<?php echo $url; ?>"><?php echo $season; ?></a></li><?php endforeach;}?>

            </ul>
          </li><?php if (isset($row2)): ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Episode</a>
            <ul class="dropdown-menu genres text-bg-light p-3"><?php if (is_array($row2['episodes'])) {
                foreach ((array) $row2['episodes'] as $eps):
                $url = seo_tv($id . '-' . $eps['season_number'] . '-' . $eps['episode_number'], $row['name']);?>

              <li><a class="dropdown-item" href="<?php echo $url; ?>"><?php echo $eps['name']; ?></a></li><?php endforeach;}?>

            </ul>
          </li><?php endif;?>

        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table mt-3">
              <tbody>
                <tr>
                  <th>Released</th>
                  <td><?php echo date('M d, Y', strtotime($row['first_air_date'])); ?></td>
                </tr>
                <tr>
                  <th>Runtime</th>
                  <td><?php echo $row['episode_run_time'][0]; ?>min</td>
                </tr>
                <tr>
                  <th>Genre</th>
                  <td><?php echo $genre; ?></td>
                </tr>
                <tr>
                  <th>Actor</th>
                  <td><?php echo $cast; ?></td>
                </tr>
                <tr>
                  <th>Director</th>
                  <td><?php echo $created_by; ?></td>
                </tr>
                <tr>
                  <th>Production</th>
                  <td><?php echo $companies; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3 d-none d-md-block">
        <div class="h4 mb-1 border-bottom pb-2">Recomendations</div><?php
          foreach ((array) $row['similar']['results'] as $key => $similiar):
          $id = $similiar['id'];
          $year = date('Y', strtotime($similiar['first_air_date']));
          $rating = number_format($similiar['vote_average'] / 1, 1, ".", ".");
          $url = seo_tv($id, $similiar['name']);
          $title = $similiar['name'];
          if ($similiar['poster_path']) {
          $poster = 'https://i2.wp.com/themoviedb.org/t/p/w300'.$similiar['poster_path'].'?resize=80,110';
          } else { $poster = cdn() .'/images/no-cover.png';}; ?>

        <div class="media py-2">
          <a href="<?php echo $url; ?>">
            <img src="<?php echo $poster; ?>" width="80" class="rec d-none d-lg-block" loading="lazy" alt="<?php echo $title; ?>">
          </a>
          <div class="media-body m-3" style="line-height: 1.2">
            <a href="<?php echo $url; ?>">
              <div class="text-dark py-1" style="font-weight: 500"><?php echo $title; ?></div>
            </a>
            <span class="wdate">
            <span class="calendar"></span><?php echo $year; ?></span>
            <div class="wextra">
              <span class="rate"></span><?php echo $rating; ?></div>
          </div>
        </div><?php if ($key == 10) { break; } endforeach;?>

      </div>
      <div id="modal-video" data-bs-backdrop="static" data-bs-target="#modal-video" data-bs-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body border" style="background-image: url(<?php echo $backdrop; ?>); background-repeat: no-repeat; background-size: cover;">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
              <div class="d-flex flex-column justify-content-center align-items-center py-4">
                <div class="ex-icon">
                  <span class="rounded"></span>
                </div>
                <h2 class="mt-1 text-white">Activate your FREE trial!</h2>
                <h6 class="text-white pb-3">Create an account to continue watching</h6>
                <a class="btn btn-danger text-white" href="/register?movie=<?php echo query($row['title']); ?>">Create Account ➞</a>
              </div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
              <div class="modal-footer border border-white py-1">
                <span class="clock"></span>
                <p class="mr-2">Quick Sign Up!</p>
              </div>
              <p style="text-align: center; font-size: 66%;">It takes less then 1 minute to Sign up, then you can enjoy Movies & TV shows.</p>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script>function play(){myPlayer.play()}var pausetime=3,myPlayer=videojs("myvideo",{fluid:!0,controls:!0,autoplay:!1,playsinline:!0,preload:"none",poster:"<?php echo $backdrop; ?>","loadingSpinner":!0});myPlayer.on("timeupdate",function(e){myPlayer.currentTime()>=pausetime&&(myPlayer.pause(),$("#modal-video").modal('show'),myPlayer.exitFullscreen())});</script>
    <script>var movies = [<?php $Movies = unserialize(data_tv('getTrendingTV')); if (is_array($Movies['result'])): foreach ((array) array_slice($Movies['result'], 0, 10) as $row) { ?>"<?php echo $row['title']; ?> full series",<?php } endif;?>]</script><?php Histats(); randomuser(); get_footer();?>