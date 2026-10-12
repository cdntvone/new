<?php

function canonical($seo = true, $base_url = false)
{
    $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
    $sp       = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    if ($base_url) {
        return $protocol . "https://" . $_SERVER['SERVER_NAME'];
    }
    if (!$seo) {
        $url = $protocol . "https://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['SCRIPT_NAME'];
        $url .= ($_SERVER['QUERY_STRING'] != '') ? '?' . $_SERVER['QUERY_STRING'] : '';
        return rtrim($url, "?&");
    }
    return $protocol . "https://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function site_url()
{
    return canonical(false, true);
}

function site_uri()
{
    return site_url() . $_SERVER['REQUEST_URI'];
}

function site_path()
{
    $hostname = $_SERVER['HTTP_HOST'];
    return $hostname;
}

function is_home()
{
    $host    = site_url() . '/';
    $current = canonical();
    if ($current == $host) {
        return true;
    } else {
        return false;
    }
}

function config($key)
{

    global $site_config;
    $output = '';
    foreach ($site_config as $one => $two) {
        if ($one == $key) {
            $output = $two;
        }
    }
    return $output;
}

function options($key)
{
    global $site_options;
    $output = '';
    foreach ($site_options as $one => $two) {
        if ($one == $key) {
            $output = $two;
        }
    }
    return $output;
}

function permalink($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());

    $defaults = array(
        'delimiter'     => '-',
        'limit'         => null,
        'lowercase'     => true,
        'replacements'  => array(),
        'transliterate' => false,
    );

    // Merge options
    $options = array_merge($defaults, $options);

    $char_map = array(
        // Latin
        'À' => 'A', 'Á'  => 'A', 'Â'  => 'A', 'Ã'  => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É'  => 'E', 'Ê'  => 'E', 'Ë'  => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï'  => 'I',
        'Ð' => 'D', 'Ñ'  => 'N', 'Ò'  => 'O', 'Ó'  => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő'  => 'O',
        'Ø' => 'O', 'Ù'  => 'U', 'Ú'  => 'U', 'Û'  => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ'  => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á'  => 'a', 'â'  => 'a', 'ã'  => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é'  => 'e', 'ê'  => 'e', 'ë'  => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï'  => 'i',
        'ð' => 'd', 'ñ'  => 'n', 'ò'  => 'o', 'ó'  => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő'  => 'o',
        'ø' => 'o', 'ù'  => 'u', 'ú'  => 'u', 'û'  => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ'  => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β'  => 'B', 'Γ'  => 'G', 'Δ'  => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ'  => '8',
        'Ι' => 'I', 'Κ'  => 'K', 'Λ'  => 'L', 'Μ'  => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π'  => 'P',
        'Ρ' => 'R', 'Σ'  => 'S', 'Τ'  => 'T', 'Υ'  => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ'  => 'E', 'Ί'  => 'I', 'Ό'  => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ'  => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β'  => 'b', 'γ'  => 'g', 'δ'  => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ'  => '8',
        'ι' => 'i', 'κ'  => 'k', 'λ'  => 'l', 'μ'  => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π'  => 'p',
        'ρ' => 'r', 'σ'  => 's', 'τ'  => 't', 'υ'  => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ'  => 'e', 'ί'  => 'i', 'ό'  => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς'  => 's',
        'ϊ' => 'i', 'ΰ'  => 'y', 'ϋ'  => 'y', 'ΐ'  => 'i',
        // Turkish
        'Ş' => 'S', 'İ'  => 'I', 'Ç'  => 'C', 'Ü'  => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı'  => 'i', 'ç'  => 'c', 'ü'  => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б'  => 'B', 'В'  => 'V', 'Г'  => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И'  => 'I', 'Й'  => 'J', 'К'  => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О'  => 'O',
        'П' => 'P', 'Р'  => 'R', 'С'  => 'S', 'Т'  => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц'  => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы'  => 'Y', 'Ь' => '', 'Э'  => 'E', 'Ю'  => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б'  => 'b', 'в'  => 'v', 'г'  => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и'  => 'i', 'й'  => 'j', 'к'  => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о'  => 'o',
        'п' => 'p', 'р'  => 'r', 'с'  => 's', 'т'  => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц'  => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы'  => 'y', 'ь' => '', 'э'  => 'e', 'ю'  => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї'  => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї'  => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď'  => 'D', 'Ě'  => 'E', 'Ň'  => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů'  => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď'  => 'd', 'ě'  => 'e', 'ň'  => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů'  => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć'  => 'C', 'Ę'  => 'e', 'Ł'  => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź'  => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć'  => 'c', 'ę'  => 'e', 'ł'  => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź'  => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č'  => 'C', 'Ē'  => 'E', 'Ģ'  => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ'  => 'N',
        'Š' => 'S', 'Ū'  => 'u', 'Ž'  => 'Z',
        'ā' => 'a', 'č'  => 'c', 'ē'  => 'e', 'ģ'  => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ'  => 'n',
        'š' => 's', 'ū'  => 'u', 'ž'  => 'z',
    );

    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }

    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function save_word($query)
{
    $title = strtolower($query);
    $koma  = ",";
    $root  = DOCUMENT_ROOT . '/include/other/';
    $path  = $root . 'keywords.txt';
    $fp    = fopen($root . 'keywords.txt', 'r');
    $fgets = fgets($fp);
    fclose($fp);
    $data = explode($koma, $fgets);

    if (file_exists($path)) {
        if (!empty($query)) {
            if (in_array($query, $data)) {
                $tulis = implode($koma, $data);
            } else {
                for ($i = 1; $i <= 200; $i++) {
                    $tulis .= $data[$i] . $koma;
                }
                $tulis .= $query;
            }

            $masuk = fopen($path, 'w');
            fwrite($masuk, $tulis);
            fclose($masuk);
        }
    }
}

function recent_posts($limit = 200)
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/cgi-bin/single/';
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    if ($handle = opendir($path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $daftar[] = $entry;
            }
        }
    }
    if (is_array($daftar)):
        $i = 0;
        foreach ($daftar as $key => $val) {
            if (file_exists($path . $val)) {
                $data            = @file_get_contents($path . $val);
                $unserialize     = unserialize($data);
                $uhoh['id']      = $unserialize['id'];
                $uhoh['slug']    = $unserialize['slug'];
                $uhoh['title']   = $unserialize['title'];
                $uhoh['pubdate'] = $unserialize['pubdate'];
                $damn[]          = $uhoh;
            }
            $i++;
            if ($i == $limit) {
                break;
            }
        }
    endif;
    closedir($handle);
    if ($damn != ''):
        return $damn;else:
        return false;
    endif;
}

function sitemap_search($limit = 500, $sep = ",")
{
    $word_path = DOCUMENT_ROOT . '/include/other/';
    if (file_exists($word_path . 'keywords.txt')) {
        $handle = @file_get_contents($word_path . 'keywords.txt');
    } else {
        $handle = '';
    }

    if ($handle) {
        $result = explode($sep, $handle);
        $res    = array_slice($result, -$limit, $limit, true);
        if ($res != ''):
            //shuffle($res);
            foreach ($res as $hasil) {
                if ($hasil != '') {
                    $a['title'] = $hasil;
                    $output[]   = $a;
                }
            }
        endif;
    }
    if ($output != ''):
        return $output;else:
        $a['title'] = 'anjing';
        $output[]   = $a;
        return $output;
    endif;
}

function bad_word($term)
{
    $banned_words = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/include/other/ban.txt');
    $option       = (empty($option)) ? $banned_words : $banned_words;
    $badwords     = explode(',', $option);
    $term         = str_ireplace($badwords, '***', $term);
    if (false === strpos($term, '***')):
        return false;else:
        return true;
    endif;
}

function bad_words($content)
{
    $banned_words = @file_get_contents(DOCUMENT_ROOT . '/include/other/ban.txt');
    $bad_words    = explode(',', $banned_words);
    foreach ($bad_words as $word) {
        $content = str_ireplace($word . ' ', '', $content);
        $content = str_ireplace(' ' . $word . ' ', '', $content);
        $content = str_ireplace(' ' . $word, '', $content);
        $content = str_ireplace($word, '', $content);
    }
    return $content;
}

function short($text, $len = 100, $more = '...')
{
    $txt = ltrim(strip_tags($text));
    if (strlen($txt) > $len) {
        $text = substr($txt, 0, $len);
        $txt  = substr($text, 0, strrpos($text, ' ')) . $more;
    }
    return $txt;
}

function limit_word($string, $word_limit = 3)
{
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $word_limit));
}

function isChecked($haystack, $needle)
{
    $haystack = explode(',', $haystack);
    return in_array($needle, $haystack);
}

function strposa($haystack, $needle, $offset = 0)
{
    if (is_array($needle)):
        foreach ($needle as $query) {
            if (!empty($query)):
                if (strpos((string) $haystack, $query, $offset) !== false) {
                    return true;
                } // stop on first true result
            endif;
        } else :
        if (!empty($needle)):
            if (strpos((string) $haystack, $needle, $offset) !== false) {
                return true;
            } // stop on first true result
        endif;
    endif;
    return false;
}

function f($haystack, $needle, $offset = 0)
{
    if (is_array($needle)):
        foreach ($needle as $query) {
            if (!empty($query)):
                if (strpos((string) $haystack, $query, $offset) !== false) {
                    return $query;
                } // stop on first true result
            endif;
        } else :
        if (!empty($needle)):
            if (strpos((string) $haystack, $needle, $offset) !== false) {
                return $needle;
            } // stop on first true result
        endif;
    endif;
    return false;
}

function cache_folder($folder)
{
    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
    } else {
        return false;
    }
}

function user_expire($file, $expire = 14400)
{
    $range = strtotime(date('Y-m-d G:i:s')) - filemtime($file);
    if ($range >= $expire) {
        return true;
    }
}

function deleteDirectory($dirPath)
{
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        reset($objects);
        rmdir($dirPath);
    }
}
