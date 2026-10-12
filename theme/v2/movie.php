<?php $owl = true;include 'header.php';?>
      <section class="px-4r">
         <div class="backdrop" style="background-image: url(https://i3.wp.com/themoviedb.org/t/p/original/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg)"></div>
         <div class="container">
            <div id="player-1" class="row">
               <div class="embed-responsive embed-responsive-16by9">
                  <video oncontextmenu="return false;" id="play-video" class="video-js vjs-16-9 vjs-big-play-centered" controls="" preload="none" width="600" height="315" poster="<?php echo $backdrop;?>" data-setup="" webkit-playsinline="true" playsinline="true">
                     <source src="<?php echo $mp4; ?>" type="video/mp4" />
                  </video>
               </div>
            </div>
            <script>var playDuration = 129*60;</script>
         </div>
         <div class="container py-4">
            <div class="row">
               <div class="col d-flex justify-content-center">
                  <a href="javascript:void(0);" onclick="window.location.href='/register/?movie=<?php echo query($row['title']); ?>'" class="btn btn-outline-theme mx-1"><i class="fa fa-play" aria-hidden="true"></i> Watch Now</a>
                  <a href="javascript:void(0);" onclick="window.location.href='/register/?movie=<?php echo query($row['title']); ?>'" class="btn btn-outline-theme mx-1"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</a>
               </div>
            </div>
         </div>
         <div class="container">
            <?php echo GoogleAds();?>
         </div>
      </section>
      <section class="container p-3 p-md-4 rounded-lg mb-5" style="background-color: #0e1117">
         <div class="row">
            <div class="col-12">
               <div class="row">
                  <div class="col-md-2 col-sm-4 col-3 d-none d-md-block">
                     <img class="img-fluid" src="<?php echo $poster;?>?resize=300,450" alt="Poster <?php echo $title;?>" title="Poster <?php echo $title;?>">
                  </div>
                  <div class="col-md-10 col-sm-8 col-12">
                     <div class="entry-title d-flex flex-column-reverse flex-md-row justify-content-between">
                        <h1 class="h2"><?php echo $title;?> <span class="tiny text-muted"><?php echo $year;?></span></h1>
                        <div class="sub-r d-none d-md-block">
                           <a href="javascript:void(0);" onclick="window.location.href='/register/?movie=<?php echo query($row['title']); ?>'" class="btn subs">Subscribe to Watch | $0.00</a>
                        </div>
                     </div>
                     <div class="entry-info mb-3">
                        <div class="__rate">
                           <?php for($k=1;$k<=$get_rating;$k++){?><i class="fa fa-star text-warning"></i><?php }?><?php for($i=$emp_rating;$i>=1;$i--){?><i class="fa fa-star text-muted"></i><?php $k++; } ?>
                        </div>
                        <div class="__info">
                           <span class="text-muted small"><?php echo $rating; ?>/10</span> <span class="text-muted small">by <?php echo $vote_count;?> users</span>
                        </div>
                     </div>
                     <div class="entry-desciption text-muted">
                        <p><?php echo $description;?></p>
                     </div>
                     <div class="entry-table">
                        <ul>
                           <li>Released: <span><?php echo date('M d, Y', strtotime($release_date));?></span></li>
                           <li>Runtime: <span><?php echo $runtime;?></span></li>
                           <li>Genre: <span><?php echo $genre;?></span></li>
                           <li>Stars: <span><?php echo $cast;?></span></li>
                           <li>Director: <span><?php echo $director;?></span></li>
                           <li>Production: <span><?php echo $companies;?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="container p-3 p-md-4 rounded-lg mb-5" style="background-color: #0e1117">
         <div class="h6">Download : <strong class="text-color-theme">MP4</strong></div>
         <ul class="down-list">
            <li>
               <div class="dt"><strong>360p</strong></div>
               <span>GD2</span> | <span>CU</span> | <span>GD1</span> | <span>ZS</span> | <span>RC</span>
            </li>
            <li>
               <div class="dt"><strong>480p</strong></div>
               <span>GD2</span> | <span>CU</span> | <span>GD1</span> | <span>ZS</span> | <span>RC</span>
            </li>
            <li>
               <div class="dt"><strong>MP4HD</strong></div>
               <span>GD2</span> | <span>CU</span> | <span>GD1</span> | <span>ZS</span> | <span>RC</span>
            </li>
            <li>
               <div class="dt"><strong>FULLHD</strong></div>
               <span>GD2</span> | <span>CU</span> | <span>GD1</span> | <span>ZS</span> | <span>RC</span>
            </li>
         </ul>
      </section>
      <section class="container">
         <div class="divider"></div>
         <div class="row">
            <div class="col-12 mb-4">
               <h3 class="h4">Movie Recommendations</h3>
            </div>
         </div>
         <div class="owl-carousel owl-loaded owl-drag">
            <div class="owl-stage-outer">
               <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1440px;">
                  <?php
                     foreach ((array) $row['similar_movies']['results'] as $key => $similar):                  
                     $year = date('Y', strtotime($similar['release_date']));
                     $rating = number_format($similar['vote_average'] / 1, 1, ".", ".");
                     $url = seo_movie($similar['id'], $similar['title']);
                     $title = $similar['title'];
                     if ($similar['poster_path']) {
                     $poster = 'https://i1.wp.com/themoviedb.org/t/p/w300'.$similar['poster_path'].'?resize=300,450';
                     } else { $poster = cdn() .'/images/no-cover.png'; } ?>

                  <div class="owl-item active" style="width: 150px; margin-right: 30px;">
                     <article id="<?php echo $row['id'];?>" class="item">
                        <div class="thumb mb-4">
                           <a href="<?php echo $url;?>" rel="bookmark" title="<?php echo $title;?>">
                              <div class="_img_holder">
                                 <img class="img-fluid rounded" src="<?php echo $poster;?>" alt="Image <?php echo $row['title'];?>" title="Image <?php echo $title;?>">
                                 <div class="_overlay_link">
                                    <button class="play-button play-button--small" type="button"></button>
                                    <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $rating;?>/10</span></div>
                                 </div>
                              </div>
                           </a>
                           <header class="entry-header">
                              <h2 class="entry-title">
                                 <a href="<?php echo $url;?>" class="_title" rel="bookmark" title="<?php echo $title;?>"><?php echo $title;?></a>
                              </h2>
                           </header>
                        </div>
                     </article>
                  </div><?php if ($key == 20) { break; } endforeach;?>

               </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
            <div class="owl-dots disabled"></div>
         </div>
      </section>
      <div id="modal-watch" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body mopie-modal-content p-0 border" style="background-image: url('<?php echo $backdrop;?>')">
                  <div class="align-items-center d-flex flex-column justify-content-center position-relative p-3 pt-5 text-center">
                     <div class="ex-icon">
                        <i class="fa fa-exclamation fa-5x" aria-hidden="true"></i>
                     </div>
                     <div class="h3 font-bold mt-3">Activate your FREE Account!</div>
                     <p>You must create an account to continue watching</p>
                     <a href="javascript:void(0);" onclick="window.location.href='/register/?movie=<?php echo query($row['title']); ?>'" class="btn btn-lg bg-theme bg-hover-theme mb-4">Continue to watch for FREE ➞</a>
                  </div>
               </div>
               <div class="modal-footer align-items-center d-flex flex-column justify-content-center text-center text-dark">
                  <p class="text-large mb-1"><i class="fa fa-clock mr-1" aria-hidden="true"></i><span class="text-large font-bold" style="font-weight: 700">Quick Sign Up!</span></p>
                  <p class="small">It takes less then 1 minute to Sign Up, then you can enjoy Unlimited Movies &amp; TV titles.</p>
               </div>
            </div>
         </div>
      </div>
<?php Histats(); get_footer();?>