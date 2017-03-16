<?php
include_once("config.php");

function sec_session_start()
{
    $session_name = 'sec_session_id';
    $secure = FALSE;

    $httponly = TRUE;

    if(ini_set('session.use_only_cookies',1) === FALSE)
    {
        header("Location /error.php?d=Could not initiate a safe session (ini_set)");
        die();
    }

    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams['lifetime'],
        $cookieParams['path'],
        $cookieParams['domain'],
        $secure,
        $httponly);

    session_name($session_name);
    session_start();
    session_regenerate_id(true);
}


function esc_url($url)
{
    if ($url == '')
    {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function sec_session_destroy()
{
    $_SESSION = array();

    $params = session_get_cookie_params();

    setcookie(session_name(),
            '',time() - 10000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']);

    session_destroy();
}
function timeToStr($ts) //$ts = timestamp src: http://stackoverflow.com/questions/2690504/php-producing-relative-date-time-from-timestamps/2690541#comment2711872_2690541
{
    if (!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if ($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0)
        {
            if ($diff < 60) return 'just now';
            if ($diff < 120) return '1 minute ago';
            if ($diff < 3600) return floor($diff / 60) . ' minutues ago';
            if ($diff < 7200) return '1 hour ago';
            if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if ($day_diff == 1) return 'Yesterday';
        if ($day_diff < 7) return $day_diff . ' days ago';
        if ($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
        if ($day_diff < 60) return 'last month';
        return date('F Y',$ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0)
        {
            if ($diff < 120) return 'in a minute';
            if ($diff < 3600) return 'in ' . floor($diff/60) . ' minutes';
            if ($diff < 7200) return 'in an hour';
            if ($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
        }
        if ($day_diff == 1) return 'Tommorow';
        if ($day_diff < 4) return date('l',$ts);
        if($day_diff < 7 + (7 - date('w'))) return 'next week';
        if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'next month';
        return date('F Y', $ts);
    }
}