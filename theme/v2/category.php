<?php
    if ( empty( $_GET['page'] ) ) {
       $pathinfo = pathinfo ($uri);
       $dirname = str_replace('/'.options('category_url').'/','',$pathinfo['dirname']);
       $filename = $pathinfo['filename'];
       $page = 1;
    } else {
       $dirname = $_GET['terms'];
       $filename = $_GET['id'];
       $page = $_GET['page'];
       $hal = ' - Pages ' .$page;
    } $hack_title = ucwords($dirname) . ' Movies'; include('header.php');?>
    <div class="jumbo-hero d-none d-md-block" style="background-image:url(https://i2.wp.com/tmdb.org/t/p/original/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg)">
        <div class="container">
            <div class="jumbo-hero__inner">
                <h1 class="header"><?php echo $hack_title . $hal; ?></h1>
            </div>
        </div>
    </div>
    <section class="mopie-fade">
        <div class="container">
        <?php echo GoogleAds();?>
            <div class="row"><?php
                    $Movies = unserialize(data_genre('genre_' . $filename . '_', $filename, $page));
                    if (is_array($Movies['result'])):
                    foreach ((array) array_slice($Movies['result'], 0, 18) as $row) {
                      $vote = $row['vote_count'];
                      $poster = $row['poster_path'];
                      $year = date('Y', strtotime($row['release_date']));
                      $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
                      $name = $row['title'];
                      $title = $row['title'] . ' (' . date('Y', strtotime($row['release_date'])) . ')';
                      $description = str_replace('"', '&#34;', $row['overview']);
                      $url = seo_movie($row['id'], $row['title']);
                    
                      ?>

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
                </article><?php } endif;?>

            </div>
            <div class="row">
                <div class="col-12 text-center pagenate">
                    <nav>
                        <ul class="pagination">
                            <?php if ($Movies['total_results'][0] > 19):
                                include 'pagination.php';if ($Movies['total_results'][0] > 1000):
                                $totalResults = 1000;else:$totalResults = $Movies['total_results'][0];
                                endif;
                                $limit = 20;
                                $link = '/?act=category&terms=' . $dirname . '&id=' . $filename . '&';
                                $pagination = new CSSPagination($totalResults, $limit, $link);
                                $pagination->setPage($_GET['page']);
                                echo $pagination->showPage();endif;?>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();?>