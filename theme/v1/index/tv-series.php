<?php

if (empty($_GET['page']))
{
   $pathinfo = pathinfo($uri);
   $page = 1;
}
else
{
   $page = $_GET['page'];
   $hal = ' - Page ' . $page;
   $title_after = $hal;
   
}
$hack_title = 'Popular TV Series';
get_header(); ?>
       <main class="container bg-white py-4">
         <div class="module">
            <div class="header h4">Popular TV Series <?php echo $dirname. $hal; ?></div>
         </div><?php echo GoogleAds(); ?>
         <div class="row items"><?php if (empty($_GET['page'])) {$page = 1;} else { $page = $_GET['page'];}
            $Movies = unserialize(data_tv('home_tv_', $page, 'getTopRatedTVShows'));
            if (is_array($Movies['result'])):
            foreach ((array) array_slice($Movies['result'], 0, 18) as $row) {
              $vote = $row['vote_count'];
              $poster = $row['poster_path'];
              $datePublished = date('Y-m-d', strtotime($row['release_date']));
              $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
              $name = $row['title'];
              $title = $row['title'] . ' (' . date('Y', strtotime($row['release_date'])) . ')';
              $description = str_replace('"', '&#34;', $row['overview']);
              $url = seo_tv($row['id'], $row['title']);?>

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
          </div><?php } endif;?>

         </div>
         <div class="col-12"><?php if ($Movies['total_results'][0] > 19):
            include 'pagination.php';if ($Movies['total_results'][0] > 1200):
            $totalResults = 1200;else:$totalResults = $Movies['total_results'][0];
            endif;
            $limit = 20;
            $link = '?';
            $pagination = new CSSPagination($totalResults, $limit, $link);
            $pagination->setPage($_GET['page']);
            echo $pagination->showPage();endif;?>
         </div>
      </main>
<?php get_footer();?>