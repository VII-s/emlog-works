<?php
!defined('EMLOG_ROOT') && exit('access deined!');

$URL=$_GET['github-url'];

if (strstr($URL, 'github')) {
    echo 'NOT GITHUB URL';
    die();
}

$URL = 'https://github.com/MikeCoder/MyStudy/blob/master/MyBlogs/Java%E4%B8%8EC%E9%80%9A%E8%BF%87%E7%AE%A1%E9%81%93%E8%BF%9B%E8%A1%8C%E4%BA%A4%E4%BA%92.md';
preg_match('/github.com\/(.*?)\/(.*?)\//', $URL, $DOC_INFO);

// URL_IMAGE : img src="/MikeCoder/MyStudy/raw/master/MyBlogs/images/2014-04-14-1.png" alt
// URL_REAL : raw.githububusercontent.com/MikeCoder/MyStudy
$CONTENT = file_get_contents($URL);
$CONTENT = strstr($CONTENT, '"mainContentOfPage">');
$CONTENT = substr($CONTENT, strlen('"mainContentOfPage">'));
$CONTENT = str_replace(strstr($CONTENT, '</article'), '', $CONTENT);
$CONTENT = str_replace('\n', '',$CONTENT);
$CONTENT = str_replace('\r\n', '',$CONTENT);

$IMAGE_URL_OLD = '/img src=(.*?raw)\//';
$IMAGE_URL_NEW = 'img src="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
preg_match($IMAGE_URL_OLD, $CONTENT, $RES);
$IMAGE_URL_OLD = '/a href=(.*?raw)\//';
$IMAGE_URL_NEW = 'a href="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
preg_match($IMAGE_URL_OLD, $CONTENT, $RES);

$CONTENT = preg_replace($IMAGE_URL_OLD, $IMAGE_URL_NEW, $CONTENT).'<END>';

$DOC_TITLE_REGEX = '/<h2.*?a>(.*?)<\/h2>([\s\S]*)<END>/';
preg_match($DOC_TITLE_REGEX, $CONTENT, $DOC_INFO);
array_shift($DOC_INFO);

echo json_encode($DOC_INFO, JSON_UNESCAPED_UNICODE);
die();
