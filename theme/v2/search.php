<?php $newquery = bad_words(get_search_query());  include 'header.php';minify();?>
   <div class="jumbo-hero" style="background-image:url(https://i2.wp.com/tmdb.org/t/p/original/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg)">
      <div class="container">
         <div class="jumbo-hero__inner">
            <h1 class="header">Search Result for "<?php echo $newquery;?>"</h1>
         </div>
      </div>
   </div>
   <section class="mopie-fade">
      <div class="container">
         <?php echo GoogleAds();?>
         <div class="row"><?php
               if (empty($_GET['page'])) {
               $page = 1; } else { $page = $_GET['page']; }
               $Movies = unserialize(data_search_movie(limit_word($newquery, 18), $page));
               if (is_array($Movies['result'])):
               foreach ((array) array_slice($Movies['result'], 0, 18) as $row) {
               $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
               if ($rating == null) {$rating = 'N/A'; }
               $title = $row['title'].' ('.date('Y', strtotime($row['release_date'])).')';
               $url = seo_movie($row['id'], $row['title']);
               $poster = $row['poster_path'];?>

            <article id="<?php echo $row['id'];?>" class="item col-6 col-md-2">
               <div class="thumb mb-4">
                  <a href="<?php echo $url;?>" rel="bookmark" title="<?php echo $title; ?>">
                     <div class="_img_holder">
                        <img class="img-fluid rounded" src="<?php echo $poster; ?>" alt="Image Wednesday" title="Image <?php echo $title; ?>">
                        <div class="_overlay_link">
                           <button class="play-button play-button--small" type="button"></button>
                           <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $row['vote_average'];?>/10</span></div>
                        </div>
                     </div>
                  </a>
                  <header class="entry-header">
                     <h2 class="entry-title">
                        <a href="<?php echo $url;?>" class="_title" rel="bookmark" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                     </h2>
                  </header>
               </div>
            </article><?php } else: ?>

            <div class="p-0">
               <div class="small text-secondary ml-4">Btw, <?php echo $newquery; ?> is gone. try with a valid movie title i.e. superman</div>
            </div><?php endif; ?><?php if (empty($_GET['page'])) {
               $page = 1; } else { $page = $_GET['page']; }
               $Movies = unserialize(data_search_tv(limit_word($newquery, 18), $page));
               if (is_array($Movies['result'])):
               foreach ((array) array_slice($Movies['result'], 0, 18) as $row) {
               $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
               if ($rating == null) {$rating = 'N/A'; }
               $title = $row['title'].' ('.date('Y', strtotime($row['release_date'])).')';
               $url = seo_tv($row['id'], $row['title']);
               $poster = $row['poster_path'];?>

            <article id="<?php echo $row['id'];?>" class="item col-6 col-md-2">
               <div class="thumb mb-4">
                  <a href="<?php echo $url;?>" rel="bookmark" title="<?php echo $title; ?>">
                     <div class="_img_holder">
                        <img class="img-fluid rounded" src="<?php echo $poster; ?>" alt="Image Wednesday" title="Image <?php echo $title; ?>">
                        <div class="_overlay_link">
                           <button class="play-button play-button--small" type="button"></button>
                           <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $row['vote_average'];?>/10</span></div>
                        </div>
                     </div>
                  </a>
                  <header class="entry-header">
                     <h2 class="entry-title">
                        <a href="<?php echo $url;?>" class="_title" rel="bookmark" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                     </h2>
                  </header>
               </div>
            </article><?php } else : ?><?php endif;?> 

         </div>
      </div>
   </section>
<?php echo Histats(); get_footer();?>