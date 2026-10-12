<?php

require_once 'tmdb.class.php';

function tmdb_api()
{
    $arraytmdb = explode(",", options('tmdb_api'));
    return $arraytmdb[array_rand($arraytmdb)];
}
function clean($string)
{
    $string = str_replace(' ', ' ', $string);
    $string = preg_replace('/[^A-Za-z0-9\-ığşçöüÖÇŞİıĞ]/', '+', $string);

    return preg_replace('/-+/', '-', $string);
}
function data_movie($nama = 'home_m_', $page = 1, $get = 'getTrendingMovies')
{
    $apikey   = tmdb_api();
    $language = options('language');
    $tmdb     = new TMDB($apikey, $language, true);
    $path     = DOCUMENT_ROOT . '/cgi-bin/v1/home/';
    $name     = $nama . $page . '.json';
    if (file_exists($path . $name) && !user_expire($path . $name)) {
        $data = file_get_contents($path . $name);
        return $data;
    } else {
        $Movie = $tmdb->$get($page);
        if ($Movie['results']) {
            $results = array();
            foreach ((array) $Movie['results'] as $row) {
                $item['id'] = $row['id'];
                if ($row['title']) {
                    $item['title'] = $row['title'];
                } else {
                    $item['title'] = $row['original_title'];
                }
                if ($row['original_title']) {
                    $item['original_title'] = $row['original_title'];
                } else {
                    $item['original_title'] = $row['original_title'];
                }
                if ($row['poster_path']) {
                    $item['poster_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
                } else {
                    $item['poster_path'] = cdn() . '/images/no-cover.png';
                }
                if ($row['backdrop_path']) {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
                } else {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
                }
                $item['overview']     = $row['overview'];
                $item['release_date'] = $row['release_date'];
                $item['popularity']   = $row['popularity'];
                $item['vote_average'] = $row['vote_average'];
                $item['vote_count']   = $row['vote_count'];
                $results['result'][]  = $item;
            }
            $results['total_results'][] = $Movie['total_results'];
            if (config('cache') == 'true'):
                file_put_contents($path . $name, serialize($results));
            endif;
            return serialize($results);
        }
    }
}

function data_tv($nama = 'home_tv_', $page = 1, $get = 'getTrendingTV')
{
    $apikey   = tmdb_api();
    $language = options('language');
    $tmdb     = new TMDB($apikey, $language, true);
    $path     = DOCUMENT_ROOT . '/cgi-bin/home/';
    $name     = $nama . $page . '.json';
    if (file_exists($path . $name) && !user_expire($path . $name)) {
        $data = file_get_contents($path . $name);
        return $data;
    } else {
        $Movie = $tmdb->$get($page);
        if ($Movie['results']) {
            $results = array();
            foreach ((array) $Movie['results'] as $row) {
                $item['id'] = $row['id'];
                if ($row['name']) {
                    $item['title'] = $row['name'];
                } else {
                    $item['title'] = $row['original_name'];
                }
                if ($row['original_name']) {
                    $item['original_name'] = $row['original_name'];
                } else {
                    $item['original_name'] = $row['name'];
                }
                if ($row['poster_path']) {
                    $item['poster_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
                } else {
                    $item['poster_path'] = cdn() . '/images/no-cover.png';
                }
                if ($row['backdrop_path']) {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
                } else {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
                }
                $item['overview']     = $row['overview'];
                $item['release_date'] = $row['first_air_date'];
                $item['popularity']   = $row['popularity'];
                $item['vote_average'] = $row['vote_average'];
                $item['vote_count']   = $row['vote_count'];
                $results['result'][]  = $item;
            }
            $results['total_results'][] = $Movie['total_results'];
            if (config('cache') == 'true'):
                file_put_contents($path . $name, serialize($results));
            endif;
            return serialize($results);
        }
    }
}

function data_genre($nama = 'genre_', $id = '', $page = 1, $get = 'GetGenreMovies')
{
    $apikey   = tmdb_api();
    $language = options('language');
    $tmdb     = new TMDB($apikey, $language, true);
    $path     = DOCUMENT_ROOT . '/cgi-bin/home/';
    $name     = $nama . $page . '.json';
    if (file_exists($path . $name) && !user_expire($path . $name)) {
        $data = file_get_contents($path . $name);
        return $data;
    } else {
        $Movie = $tmdb->$get($id, $page);
        if ($Movie['results']) {
            $results = array();
            foreach ((array) $Movie['results'] as $row) {
                $item['id'] = $row['id'];
                if ($row['title']) {
                    $item['title'] = $row['title'];
                } else {
                    $item['title'] = $row['original_title'];
                }
                if ($row['original_title']) {
                    $item['original_title'] = $row['original_title'];
                } else {
                    $item['original_title'] = $row['title'];
                }
                if ($row['poster_path']) {
                    $item['poster_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
                } else {
                    $item['poster_path'] = cdn() . '/images/no-cover.png';
                }
                if ($row['backdrop_path']) {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
                } else {
                    $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
                }
                $item['overview']     = $row['overview'];
                $item['release_date'] = $row['release_date'];
                $item['popularity']   = $row['popularity'];
                $item['vote_average'] = $row['vote_average'];
                $item['vote_count']   = $row['vote_count'];
                $results['result'][]  = $item;
            }
            $results['total_results'][] = $Movie['total_results'];
            if (config('cache') == 'true'):
                file_put_contents($path . $name, serialize($results));
            endif;
            return serialize($results);
        }
    }
}

function data_search_movie($query = '', $page = 1)
{
    $apikey   = tmdb_api();
    $language = options('language');
    $tmdb     = new TMDB($apikey, $language, true);
    $Movie    = $tmdb->searchMovie($query, $page);
    if ($Movie['results']) {
        $results = array();
        foreach ((array) $Movie['results'] as $row) {
            $item['id'] = $row['id'];
            if ($row['title']) {
                $item['title'] = $row['title'];
            } else {
                $item['title'] = $row['original_title'];
            }
            if ($row['original_title']) {
                $item['original_title'] = $row['original_title'];
            } else {
                $item['original_title'] = $row['title'];
            }
            if ($row['poster_path']) {
                $item['poster_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
            } else {
                $item['poster_path'] = cdn() . '/images/no-cover.png';
            }
            if ($row['backdrop_path']) {
                $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
            } else {
                $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
            }
            $item['overview']     = $row['overview'];
            $item['release_date'] = $row['release_date'];
            $item['popularity']   = $row['popularity'];
            $item['vote_average'] = $row['vote_average'];
            $item['vote_count']   = $row['vote_count'];
            $results['result'][]  = $item;
        }
        $results['total_results'][] = $Movie['total_results'];
        return serialize($results);
    }
}

function data_search_tv($query = '', $page = 1)
{
    $apikey   = tmdb_api();
    $language = options('language');
    $tmdb     = new TMDB($apikey, $language, true);
    $Movie    = $tmdb->searchTVShow($query, $page);
    if ($Movie['results']) {
        $results = array();
        foreach ((array) $Movie['results'] as $row) {
            $item['id'] = $row['id'];
            if ($row['name']) {
                $item['title'] = $row['name'];
            } else {
                $item['title'] = $row['original_name'];
            }
            if ($row['original_name']) {
                $item['original_name'] = $row['original_name'];
            } else {
                $item['original_name'] = $row['name'];
            }
            if ($row['poster_path']) {
                $item['poster_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
            } else {
                $item['poster_path'] = cdn() . '/images/no-cover.png';
            }
            if ($row['backdrop_path']) {
                $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
            } else {
                $item['backdrop_path'] = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
            }
            $item['overview']     = $row['overview'];
            $item['release_date'] = $row['first_air_date'];
            $item['popularity']   = $row['popularity'];
            $item['vote_average'] = $row['vote_average'];
            $item['vote_count']   = $row['vote_count'];
            $results['result'][]  = $item;
        }
        $results['total_results'][] = $Movie['total_results'];
        return serialize($results);
    }
}

if ($_GET['act'] == 'movie' || strposa($uri, options('url_movie'))):
    if (isset($_GET['id']) || strposa($uri, options('url_movie'))) {
        if (strposa($uri, options('url_movie'))) {
            $str = explode("/", $uri);
            if (is_numeric($str[2]) || strposa($str[2], 'tt') !== false) {
                $TMDBID = $str[2];
            } else {
                header('Location: /error');
            }
        } else {
            $TMDBID = $_GET['id'];
        }
        $path     = $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/movie/';
        $basename = $TMDBID . '.json';
        if (file_exists($path . $basename) && !user_expire($path . $basename, 14400)) {
            $data = @file_get_contents($path . $basename);
            $row  = unserialize($data);
        } else {
            $apikey   = tmdb_api();
            $language = options('language');
            $tmdb     = new TMDB($apikey, $language, true);
            $row      = $tmdb->getMovie($TMDBID);
            $rev      = $tmdb->getReviewById($TMDBID);
        }
        if (!$row['status_code'] == 34) {
            $title         = $row['title'];
            $cm['id']      = $TMDBID;
            $cm['title']   = $row['title'];
            $cm['slug']    = seo_movie($TMDBID, $row['title']);
            $cm['pubdate'] = $row['release_date'];
            if (is_array($row['genres'])) {
                $ic                                            = 0;
                $genres                                        = array();
                foreach ($row['genres'] as $result): $genres[] = $result['name'];
                    if ($ic++ == 0) {
                        break;
                    }
                endforeach;
                $genre = implode(", ", $genres);
            }
            $release_date = $row['release_date'];
            $released     = date('M d, Y', strtotime($row['release_date']));
            $year         = date('Y', strtotime($release_date));
            $hack_title   = $row['title'] . ' full movie';
            //$title_after = '' . $end_title;
            $description = $row['overview'];
            $runtime     = $row['runtime'];
            $vote_count  = $row['vote_count'];
            function directors($find)
        {
                if ($find['job'] == 'Director') {
                    return $find;
                }
            }
            $directors      = array_filter($row['credits']['crew'], "directors");
            $results        = array_keys($directors);
            $sutradara      = array($directors[$results[0]]['name'], $directors[$results[1]]['name']);
            $director       = implode(' & ', array_filter($sutradara));
            $directorschema = '{ "@type": "Person", "name": "' . $director . '" },';
            if ($directorschema == null) {
                $directorschema = '{ "@type": "Person", "name": "Unknown"},';
            }
            function writers($find)
        {
                if ($find['known_for_department'] == 'Writing') {
                    return $find;
                }
            }
            $writer  = array_filter($row['credits']['crew'], "writers");
            $results = array_keys($writer);
            $writer  = $writer[$results[0]]['name'];
            if ($writer == null) {
                $writer = 'N/A';
            }
            $authorschema = '{ "@type": "Person", "name": "' . $writer . '"}';
            if ($authorschema == null) {
                $authorschema = '{ "@type": "Person", "name": "Unknown" }';
            }

            if ($row['backdrop_path'] != null) {
                shuffle($row['images']['backdrops']);
                $backdrop = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
            } else {
                $backdrop = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
            }
            if ($row['poster_path'] != null) {
                $poster = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
            } else {
                $poster = cdn() . '/images/no-cover.png';
            }
            if ($row['poster_path'] != null) {
                $imageschema = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
            } else {
                $imageschema = cdn() . '/images/no-cover.png';
            }
            if (is_array($row['genres'])) {
                $ic     = 0;
                $genres = array();
                foreach ($row['genres'] as $result):
                    $genres[] = '<a href="' . category(permalink($result['name']), $result['id']) . '" title="' . $result['name'] . '">' . $result['name'] . '</a>';
                    if ($ic++ == 2) {
                        break;
                    }
                endforeach;
                $genre = implode(", ", $genres);
                if ($genre == null) {
                    $genre = 'N/A';
                }
            }
            if (is_array($row['genres'])) {
                $ic     = 0;
                $genres = array();
                foreach ($row['genres'] as $result):
                    $genres[] = '<a class="list-inline-item" href="' . category(permalink($result['name']), $result['id']) . '" title="' . $result['name'] . ' Movies">' . $result['name'] . '</a>';
                    if ($ic++ == 5) {
                        break;
                    }
                endforeach;
                $genre_movies = implode(" ", $genres);
                if ($genre_movies == null) {
                    $genre_movies = 'N/A';
                }
            }
            if (is_array($row['genres'])) {
                foreach ($row['genres'] as $result): $category = $result['name'];
                    $categoryid = $result['id'];
                endforeach;
            }
            if (is_array($row['credits']['cast'])) {
                $ic = 0;
                $casts = array();
                foreach ($row['credits']['cast'] as $result): $casts[] = '' . $result['name'] . '';
                    if ($ic++ == 2) {
                        break;
                    }
                endforeach;
                $cast = implode(", ", $casts);
                if ($cast == null) {
                    $cast = 'N/A';
                }
            }
            if (is_array($row['credits']['cast'])) {
                $ic = 0;
                $casts = array();
                foreach ($row['credits']['cast'] as $result): $casts[] = '{ "@type": "Person", "name": "' . $result['name'] . '"}';
                    if ($ic++ == 2) {
                        break;
                    }
                endforeach;
                $castschema = implode(", ", $casts);
            }
            $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
            //echo '<pre>'; print_r($row["id"]); echo '</pre>';
            if ($row['vote_average'] > 0) {
                $get_rating = $row['vote_average'];
                $emp_rating = 11 - $get_rating;
            } else {
                $emp_rating = 10;
            }
            if (is_array($row['keywords']['keywords'])) {
                $keyword = array();
                foreach ($row['keywords']['keywords'] as $result): $keyword[] = $result['name'];
                endforeach;
                $keywords = implode(", ", $keyword);
            }
            if (is_array($row['production_countries'])) {
                $ic = 0;
                $countrys = array();
                foreach ($row['production_countries'] as $result): $countrys[] = $result['name'];
                    if ($ic++ == 0) {
                        break;
                    }
                endforeach;
                $country = implode(" & ", $countrys);
                if ($country == null) {
                    $country = 'N/A';
                }
            }
            if (is_array($row['production_companies'])) {
                $ic = 0;
                $production = array();
                foreach ($row['production_companies'] as $result): $production[] = $result['name'];
                    $logo = 'https://i3.wp.com/themoviedb.org/t/p/w45' . $result['logo_path'];
                    if ($ic++ == 0) {
                        break;
                    }
                endforeach;
                $companies = implode(", ", $production);
                if ($companies == null) {
                    $companies = 'N/A';
                }
            }
            if (config('cdn') == 'true') {
                $mp4 = options('cdnSite') . '/video/' . str_replace(' ', '', strtolower($companies)) . '.mp4';
            } else {
                $mp4 = site_url() . '/include/video.mp4';
            }
            if ($row['runtime'] != null) {
                $hours   = floor($row['runtime'] / 60);
                $minutes = ($row['runtime'] % 60);
                $runtime = $hours . 'h ' . $minutes . 'min';
            } else {
                $runtime = '1h 42min';
            }
            $yt = $row['trailers']['youtube'][0]['source'];
            if ($yt == null) {
                $yt = 'OC_LImZ7smo';
            }
            if ($row['title'] != '') {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                    file_put_contents($path . $basename, serialize($row));
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/single/' . $basename, serialize($cm));
                } else {
                    file_put_contents($path . $basename, serialize($row));
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/single/' . $basename, serialize($cm));
                }
            }
        }
    }
endif;

if ($_GET['act'] == 'tv' || strposa($uri, options('url_tv'))):
    if (isset($_GET['id']) || strposa($uri, options('url_tv'))) {

        $apikey   = tmdb_api();
        $language = options('language');
        $tmdb     = new TMDB($apikey, $language, true);
        $row      = $tmdb->getMovie($TMDBID);

        if (strpos($_GET['id'], '-') !== false) {
            $apikey   = tmdb_api();
            $language = options('language');
            $tmdb     = new TMDB($apikey, $language, true);
            $str      = explode("-", $_GET['id']);
            $TMDBID   = $str[0];
            if ($str[2] != ''):
                $row         = $tmdb->getTVShow($TMDBID);
                $row2        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1]);
                $row3        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1] . '/episode/' . $str[2]);
                $title       = $row['name'] . ' ' . $str[1] . 'x' . $str[2] . ' — ' . $row3['name'];
                $title2      = $row['name'] . ' ' . $str[1] . 'x' . $str[2] . ' — ' . $row3['name'];
                $hack_title  = 'Watch ' . $row['name'] . ' ' . $str[1] . 'x' . $str[2] . ' : ' . $row3['name'];
                $description = $row['overview'];elseif ($str[1] != ''):
                $row         = $tmdb->getTVShow($TMDBID);
                $row2        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1]);
                $title       = $row['name'] . ' ' . $row2['name'];
                $hack_title  = 'Watch ' . $row['name'] . ' ' . $row2['name'] . ' online';
                $description = $row['overview'];else:
                $row         = $tmdb->getTVShow($TMDBID);
                $title       = $row['name'];
                $hack_title  = 'Watch ' . $row['name'] . ' online';
                $description = $row['overview'];
            endif;

        } else {

            if (strpos($uri, options('url_tv')) !== false) {
                $strs   = explode("/", $uri);
                $str    = explode("-", $strs[2]);
                $TMDBID = $str[0];
                if ($str[2] != ''):
                    $apikey      = tmdb_api();
                    $language    = options('language');
                    $tmdb        = new TMDB($apikey, $language, true);
                    $row         = $tmdb->getTVShow($TMDBID);
                    $row2        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1]);
                    $row3        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1] . '/episode/' . $str[2]);
                    $epi_name    = $row3['name'] == '' ? '' : ' - ' . $row3['name'];
                    $title       = $row['name'] . ' S' . $str[1] . 'E' . $str[2] . $epi_name;
                    $hack_title  = $row['name'] . ' S' . $str[1] . 'E' . $str[2] . ' - ' . $row3['name'];
                    $title_after = ' full series streaming';
                    $description = $row3['overview'] == '' ? $row['overview'] : $row3['overview'];elseif ($str[1] != ''):
                    $apikey      = tmdb_api();
                    $language    = options('language');
                    $tmdb        = new TMDB($apikey, $language, true);
                    $row         = $tmdb->getTVShow($TMDBID);
                    $row2        = $tmdb->getTVSeason($TMDBID, '/season/' . $str[1]);
                    $title       = $row['name'] . ' ' . $row2['name'];
                    $hack_title  = $row['name'] . ' ' . $row2['name'];
                    //$title_after = '' . $end_title;
                    $description = $row['overview'];else:
                    $apikey      = tmdb_api();
                    $language    = options('language');
                    $tmdb        = new TMDB($apikey, $language, true);
                    $row         = $tmdb->getTVShow($TMDBID);
                    $title       = $row['name'];
                    $hack_title  = $row['name'];
                    $title_after = ' full series streaming';
                    $description = $row['overview'];
                endif;

            } else {

                $TMDBID     = $_GET['id'];
                $row        = $tmdb->getTVShow($TMDBID);
                $title      = $row['name'];
                $hack_title = $row['name'];
                //$title_after = ' │ ' . $end_title;
                $description = $row['overview'];

            }
        }

        if ($row['name'] != '') {
            $id                 = $row['id'];
            $first_air_date     = $row['first_air_date'];
            $last_air_date      = $row['last_air_date'];
            $year               = date('Y', strtotime($last_air_date));
            $run_time0          = isset($row['episode_run_time'][0]) ? $row['episode_run_time'][0] : '26';
            $run_time1          = isset($row['episode_run_time'][1]) ? $row['episode_run_time'][1] : '14';
            $runtime            = '00:' . $run_time0 . ':' . $run_time1;
            $vote_count         = $row['vote_count'];
            $number_of_episodes = $row['number_of_episodes'];
            $number_of_seasons  = $row['number_of_seasons'];
            $status             = $row['status'];

            if ($row['backdrop_path'] != null) {
                $backdrop = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
            } elseif ($row['backdrop_path'] != null) {
            $backdrop = 'https://i3.wp.com/themoviedb.org/t/p/w1280' . $row['backdrop_path'];
        } else {
            $backdrop = 'https://i3.wp.com/themoviedb.org/t/p/w1280/z1EBf0SqPC4dXIwg9NmxNBegxas.jpg';
        }
        if ($row['poster_path'] != null) {
            $poster = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['poster_path'] . '?resize=300,450';
        } elseif ($row['backdrop_path'] != null) {
            $poster = 'https://i3.wp.com/themoviedb.org/t/p/w300' . $row['backdrop_path'] . '?resize=300,450';
        } else {
            $poster = cdn() . '/images/no-cover.png';
        }
        if (is_array($row['genres'])) {
            $ic     = 0;
            $genres = array();
            foreach ($row['genres'] as $result):
                $genres[] = '' . $result['name'] . '';
                if ($ic++ == 5) {
                    break;
                }
            endforeach;
            $genre = implode(", ", $genres);
        }
        if (is_array($row['genres'])) {
            foreach ($row['genres'] as $result): $category = $result['name'];
                $categoryid                                   = $result['id'];
            endforeach;
        }
        $genre = implode(", ", $genres);
        if (is_array($row['credits']['cast'])) {
            $ic                                                    = 0;
            $casts                                                 = array();
            foreach ($row['credits']['cast'] as $result): $casts[] = '' . $result['name'] . '';
                if ($ic++ == 2) {
                    break;
                }
            endforeach;
            $cast = implode(", ", $casts);
            if ($cast == null) {
                $cast = 'N/A';
            }
        }
        $rating = number_format($row['vote_average'] / 1, 1, ".", ".");
        if ($row['vote_average'] > 0) {
            $get_rating = $row['vote_average'];
            $emp_rating = 11 - $get_rating;
        } else {
            $emp_rating = 10;
        }
        if (is_array($row['keywords']['keywords'])) {
            $keyword = array();
            foreach ($row['keywords']['keywords'] as $result): $keyword[] = '' . $result['name'] . '';
            endforeach;
            $keywords = implode(", ", $keyword);
        }
        if (is_array($row['alternative_titles']['results'])) {
            $alternative = array();
            foreach ($row['alternative_titles']['results'] as $result): $alternative[] = $result['title'];
            endforeach;
            $alternative_titles = implode(", ", $alternative);
        }
        if (is_array($row['production_companies'])) {
            $ic = 0;
            $production = array();
            foreach ($row['production_companies'] as $result): $production[] = '' . $result['name'] . '';
                if ($ic++ == 0) {
                    break;
                }
            endforeach;
            $companies = implode(", ", $production);
            if ($companies == null) {
                $companies = 'N/A';
            }
        }
        if (is_array($row['production_countries'])) {
            $country = array();
            foreach ($row['production_countries'] as $result):
                $countries[] = $result['name'];
            endforeach;
            $country = implode(", ", $countries);
            if ($country == null) {
                $country = 'N/A';
            }
        }
        if (is_array($row['created_by'])) {
            $ic         = 0;
            $created_by = array();
            foreach ($row['created_by'] as $result):
                $created = $result['name'];
                if ($ic++ == 0) {
                    break;
                }
            endforeach;
            $created_by = $created;
            if ($created_by == null) {
                $created_by = 'N/A';
            }
        }
        if (is_array($row['spoken_languages'])) {
            $language = array();
            foreach ($row['spoken_languages'] as $result):
                $languages[] = $result['name'];
            endforeach;
            $languages = implode(", ", $languages);
        }
        if (is_array($row['networks'])) {
            $ic = 0;

            $broadcaster = array();
            foreach ($row['networks'] as $result):
                $logo          = 'https://i3.wp.com/themoviedb.org/t/p/w45' . $result['logo_path'];
                $broadcaster[] = $result['name'];
                if ($ic++ == 0) {
                    break;
                }
            endforeach;
            $networks = implode(", ", $broadcaster);

        }
        if (config('cdn') == 'true') {
            $mp4 = options('cdnSite') . '/video/' . clean(strtolower($networks)) . '.mp4';
        } else {
            $mp4 = site_url() . '/include/video.mp4';
        }
    }
}
endif;

function seo($query)
{
    if (options('_seo') == 'false'):
        if ($query):
            return site_url() . '/' . options('search_url') . '/' . permalink($query);
        endif;
    else:
        return site_url() . '/search?q=' . permalink($query);
    endif;
}

function seo_movie($id, $query)
{
    if (options('_seo') == 'true'):
        return site_url() . '/' . options('url_movie') . '/' . $id . '/' . permalink($query);
    else:
        return '/?watch=' . options('url_movie') . '&id=' . $id . '-' . permalink($query);
    endif;
}
function query($query)
{

    return permalink($query);

}

function seo_tv($id, $query, $delimiter = '-')
{
    if (options('_seo') == 'true'):
        return site_url() . '/' . options('url_tv') . '/' . $id . '/' . permalink($query);
    else:
        return site_url() . '/' . options('url_tv') . '/' . $id;
    endif;
}
function view_page($page)
{
    if (options('_seo') == 'true'):
        return site_url() . '/' . config('themes') . '/' . options('url_page') . '/' . $page;
    else:
        return site_url() . '/' . config('themes') . '/' . options('url_page') . '/' . $page;
    endif;
}
function category($query, $id = '')
{

    return site_url() . '/' . options('category_url') . '/' . $query . '/' . $id;

}
if (strtotime(date('Y-m-d G:i:s')) - filemtime($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/') > 60) {
    deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/home/');
    deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/movie/');
    deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/single/');
}