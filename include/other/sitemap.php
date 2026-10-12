<?php error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT'] . '/include/data/host.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/data/tmdb.api.php');

header("Content-Type: text/xml;charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo site_url();?></loc>
        <lastmod><?php echo date('Y-m-d');?></lastmod>
    </url><?php $Movies = unserialize(data_movie('getTrendingMovies'));
      if (is_array($Movies['result'])):
      foreach ((array) array_slice($Movies['result'], 0, 20) as $row) {
      $year = utf8_encode(date('Y-m-d',strtotime("-1 days")));
      $url = utf8_encode(seo_movie($row['id'], $row['title']));
    echo '
    <url>
        <loc>'.$url.'</loc>
        <lastmod>'.$year.'</lastmod>
    </url>';
}
endif; $Movies = unserialize(data_tv('getTrendingTV'));
      if (is_array($Movies['result'])):
      foreach ((array) array_slice($Movies['result'], 0, 20) as $row) {
      $year = date('Y-m-d',strtotime("-1 days"));
      $url = seo_tv($row['id'], $row['title']);
    echo '
    <url>
        <loc>'.$url.'</loc>
        <lastmod>'.$year.'</lastmod>
    </url>';
} endif; foreach(sitemap_search('250',',') as $sitemap) {
        $date = date('Y-m-d');
        $link = _seo($sitemap['title']);  
        echo '
    <url>
        <loc>'.$link.'</loc>
        <lastmod>'.$date.'</lastmod>
    </url>';
    } ?>

</urlset>