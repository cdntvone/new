<?php

class TMDB
{
    #@var string url of API TMDB
    const _API_URL_ = "https://api.themoviedb.org/3/";

    #@var string API KEY
    private $_apikey;

    #@var string Default language
    private $_lang;

    #@var boolean for testing
    private $_debug;

    public function _get($url)
    {
        if (function_exists('curl_exec')) {
            $ch = curl_init();

            $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
            $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
            $header[] = "Cache-Control: max-age=0";
            $header[] = "Connection: keep-alive";
            $header[] = "Keep-Alive: 300";
            $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
            $header[] = "Accept-Language: it,en-US;q=0.8,en;q=0.6,ja;q=0.4,fr-FR,fr;q=0.2,it-IT;q=0.2,zh-CN;q=0.2,zh;q=0.2";
            $header[] = "Pragma: ";

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_REFERER, "https://www.google.com");
            curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0");

            $url_get_contents_data = curl_exec($ch);
            curl_close($ch);
            if ($url_get_contents_data == false) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
                $url_get_contents_data = curl_exec($ch);
                curl_close($ch);
            }
        } elseif (function_exists('file_get_contents')) {
            $url_get_contents_data = @file_get_contents($url);
        } elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
            $handle                = fopen($url, "r");
            $url_get_contents_data = stream_get_contents($handle);
        } else {
            $url_get_contents_data = false;
        }
        return $url_get_contents_data;
    }
    /**
     *  Construct Class
     *
     *  @param string $apikey The API key token
     *  @param string $lang The languaje to work with, default is english
     */
    public function __construct($apikey, $lang, $debug = false)
    {

        // Sets the API key
        $this->setApikey($apikey);

        // Setting Language
        $this->setLang($lang);

        // Set the debug mode
        $this->_debug = 'false';
    }

    public function ___construct($data)
    {
        $this->_data = $data;
    }
    /**
     *  Set the API key
     *
     *  @param string $apikey
     *  @return void
     */
    private function setApikey($apikey)
    {
        $this->_apikey = (string) $apikey;
    }

    /**
     *  Get the API key
     *
     *  @return string
     */
    private function getApikey()
    {
        return $this->_apikey;
    }

    /**
     *  Set the language
     *  By default english
     *
     *  @param string $lang
     */
    public function setLang($lang = 'en')
    {
        $this->_lang = $lang;
    }

    /**
     *  Get the language
     *
     *  @return string
     */
    public function getLang()
    {
        return $this->_lang;
    }

    private function _call($action, $appendToResponse, $lang = '&language=en')
    {
        $url = self::_API_URL_ . $action . '?api_key=' . $this->getApikey() . '&' . $appendToResponse . $lang;

        $contents = $this->_get($url);

        $results = mb_convert_encoding($contents, "HTML-ENTITIES", "UTF-8");

        if ($this->_debug == 'true') {
            echo '<pre>';
            print_r($url);
            echo '</pre>';
        }

        return (array) json_decode(($results), true);
    }

    public function getMovie($idMovie, $appendToResponse = 'append_to_response=trailers,credits,similar_movies,keywords,images&include_image_language=en,null')
    {
        return $this->_call('movie/' . $idMovie, $appendToResponse, '&language=' . $this->getLang());
    }
    public function getTVShow($idTVShow, $appendToResponse = 'append_to_response=credits,keywords,similar,images&include_image_language=en,null')
    {
        return $this->_call('tv/' . $idTVShow, $appendToResponse, '&language=' . $this->getLang());
    }
    public function getTVSeason($idTVShow, $season = '', $appendToResponse = 'append_to_response=credits,keywords,images&include_image_language=en,null')
    {
        return $this->_call('tv/' . $idTVShow . $season, $appendToResponse, '&language=' . $this->getLang());
    }

    /**
     *  Get Lists of Movies
     *
     */

    public function getTrendingMovies()
    {
        return $this->_call('trending/movie/week', '', '&language=' . $this->getLang());
    }
    public function getLatestMovie()
    {
        return $this->_call('movie/latest', '&language=' . $this->getLang());
    }
    public function getPopularMovies($page = 1)
    {
        return $this->_call('movie/popular', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getNowPlayingMovies($page = 1)
    {
        return $this->_call('movie/now_playing', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getTopRatedMovies($page = 1)
    {
        return $this->_call('movie/top_rated', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getUpcomingMovies($page = 1)
    {
        return $this->_call('movie/upcoming', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function GetGenreMovies($id, $page = 1)
    {
        return $this->_call('genre/' . $id . '/movies', 'page=' . $page, '&language=' . $this->getLang());
    }
    /**
     *  Get Lists of TVShows
     *
     */

    public function getTrendingTV()
    {
        return $this->_call('trending/tv/week', '', '&language=' . $this->getLang());
    }
    public function getLatestTVShow($page = 1)
    {
        return $this->_call('tv/latest', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getTopRatedTVShows($page = 1)
    {
        return $this->_call('tv/top_rated', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getPopularTVShows($page = 1)
    {
        return $this->_call('tv/popular', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getOnTheAirTVShows($page = 1)
    {
        return $this->_call('tv/on_the_air', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getAiringTodayTVShows($page = 1)
    {
        return $this->_call('tv/airing_today', 'page=' . $page, '&language=' . $this->getLang());
    }
    /**
     *  Search Multi
     *
     *  @param string $movieTitle the movie, tv show and person
     *  @return Movie
     */
    public function searchMulti($movieTitle, $page = 1)
    {
        return $this->_call('search/multi', 'query=' . urlencode($movieTitle) . '&page=' . $page, $this->getLang());
    }
    /**
     *  Search Movie
     *
     *  @param string $movieTitle The title of a Movie
     *  @return Movie
     */
    public function searchMovie($movieTitle, $page = 1)
    {
        return $this->_call('search/movie', 'query=' . urlencode($movieTitle) . '&page=' . $page, '&language=' . $this->getLang());
    }
    /**
     *  Search TVShow
     *
     *  @param string $tvShowTitle The title of a TVShow
     *  @return TVShow[]
     */
    public function searchTVShow($tvShowTitle, $page = 1)
    {
        return $this->_call('search/tv', 'query=' . urlencode($tvShowTitle) . '&page=' . $page, '&language=' . $this->getLang());
    }

    public function getReviewById($id, $page = 1)
    {
        return $this->_call('movie/' . $id . '/reviews', 'page=' . $page, '&language=' . $this->getLang());
    }
    public function getTvReviewById($id, $page = 1)
    {
        return $this->_call('tv/' . $id . '/reviews', 'page=' . $page, '&language=' . $this->getLang());
    }

}
