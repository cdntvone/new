<?php $newquery = bad_words(get_search_query());  include 'header.php';?>

        <main class="container bg-white py-4">
         <div class="module">
            <div class="header h4">Search: <?php echo $newquery; ?></div>
         </div><?php echo GoogleAds(); ?>
         <div class="row items"><?php
            if (empty($_GET['page'])) {
            $page = 1; } else { $page = $_GET['page']; }
            $Movies = unserialize(data_search_movie(limit_word($newquery, 12), $page));
            if (is_array($Movies['result'])):
            foreach ((array) array_slice($Movies['result'], 0, 9) as $row) {
            $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
            if ($rating == null) {$rating = 'N/A'; }
            $title = $row['title'].' ('.date('Y', strtotime($row['release_date'])).')';
            $url = seo_movie($row['id'], $row['title']);
            $poster = $row['poster_path'];?>

         <div class="col-6 col-md-2 movies">
            <div class="poster">
              <div class="quality">
                <span class="hd">HD</span>
              </div>
              <a href="<?php echo $url; ?>" title="Play Now">
                <div class="play"></div>
              </a>
              <img src="<?php echo $poster; ?>" class="fluid" width="300" height="450" alt="<?php echo $title; ?>">
              <span class="rating"><?php echo $rating; ?></span>
            </div>
            <div class="title">
              <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
            </div>
         </div><?php } else: ?>

            <div class="p-0">
               <div class="small text-secondary ml-4">Btw, <?php echo $newquery; ?> is gone. try with a valid movie title i.e. superman</div>
         </div><?php endif; ?><?php if (empty($_GET['page'])) {
            $page = 1; } else { $page = $_GET['page']; }
            $Movies = unserialize(data_search_tv(limit_word($newquery, 12), $page));
            if (is_array($Movies['result'])):
            foreach ((array) array_slice($Movies['result'], 0, 3) as $row) {
            $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
            if ($rating == null) {$rating = 'N/A'; }
            $title = $row['title'].' ('.date('Y', strtotime($row['release_date'])).')';
            $url = seo_tv($row['id'], $row['title']);
            $poster = $row['poster_path'];?>
            
         <div class="col-6 col-md-2 movies">
            <div class="poster">
              <div class="quality">
                <span class="hd">HD</span>
              </div>
              <a href="<?php echo $url; ?>" title="Play Now">
                <div class="play"></div>
              </a>
              <img src="<?php echo $poster; ?>" class="fluid" width="300" height="450" alt="<?php echo $title; ?>">
              <span class="rating"><?php echo $rating; ?></span>
            </div>
            <div class="title">
              <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
            </div>
         </div><?php } else : ?><?php endif;?> 

         </div> 
      </main>
<?php Histats(); get_footer();?>