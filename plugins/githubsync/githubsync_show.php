<?php

function getPageContent($url, $timeout = 60, $header = array()){  
    if (!function_exists('curl_init')) {  
        throw new Exception('server not install curl');  
    }  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_HEADER, true);  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);  
    if (!empty($header)) {  
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  
    }  
    $data = curl_exec($ch);  
    list($header, $data) = explode("\r\n\r\n", $data);  
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    if ($http_code == 301 || $http_code == 302) {  
        $matches = array();  
        preg_match('/Location:(.*?)\n/', $header, $matches);  
        $url = trim(array_pop($matches));  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_HEADER, false);  
        $data = curl_exec($ch);  
    }  

    if ($data == false) {  
        curl_close($ch);  
    }  
    @curl_close($ch);  
    return $data;  
}

function dd($value) {
    d($value);
    die(0);
}
function d($value) {
    if(is_array($value)) {
        header("Content-type: application/json");
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
    } else {
        echo '<pre>';var_dump($value);echo '</pre>';
    }
}
function json_return($value) {
    header("Content-type: application/json");
    echo json_encode($value, JSON_UNESCAPED_UNICODE);
    exit();
}

$URL = base64_decode($_GET['github-url']);
d($URL);

if (!strstr($URL, 'github')) {
    echo 'NOT GITHUB URL';
    die();
}

preg_match('/github.com\/(.*?)\/(.*?)\//', $URL, $DOC_INFO);
d($DOC_INFO);
// URL_IMAGE : img src="/MikeCoder/MyStudy/raw/master/MyBlogs/images/2014-04-14-1.png" alt
// URL_REAL : raw.githububusercontent.com/MikeCoder/MyStudy$url = "http://www.php100.com/logo.gif";
$CONTENT = getPageContent($URL);
d($CONTENT);

$CONTENT = strstr($CONTENT, '"mainContentOfPage">');
d($CONTENT);

$CONTENT = substr($CONTENT, strlen('"mainContentOfPage">'));
d($CONTENT);

$CONTENT = str_replace(strstr($CONTENT, '</article'), '', $CONTENT);
d($CONTENT);

$CONTENT = str_replace('\n', '',$CONTENT);
d($CONTENT);

$CONTENT = str_replace('\r\n', '',$CONTENT);

d($CONTENT);

$IMAGE_URL_OLD = '/img src=(.*?raw)\//';
$IMAGE_URL_NEW = 'img src="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
$CONTENT = preg_replace($IMAGE_URL_OLD, $IMAGE_URL_NEW, $CONTENT);
$LINK_URL_OLD = '/a href=(.*?blob)\//';
$LINK_URL_NEW = 'a href="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
$CONTENT = preg_replace($LINK_URL_OLD, $LINK_URL_NEW, $CONTENT);
d($CONTENT);

$CONTENT = $CONTENT.'<END>';
$DOC_TITLE_REGEX = '/<h\d+[\s\S]*?a>([\s\S]*?)<\/h\d+>([\s\S]*)<END>/';
preg_match($DOC_TITLE_REGEX, $CONTENT, $DOC_INFO);
array_shift($DOC_INFO);
if ($DOC_INFO) {
    $DOC_INFO[0] = ($DOC_INFO[0]);
    $DOC_INFO[1] = ($DOC_INFO[1]);
} else {
    $DOC_INFO[] = ("NO CONTENT");
    $DOC_INFO[] = ("检查你的markdown规范，要求第一行必须是标题，用===标示");
}
echo (json_encode($DOC_INFO, JSON_UNESCAPED_UNICODE));
die();
