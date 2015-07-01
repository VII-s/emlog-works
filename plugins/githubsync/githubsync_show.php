<?php
!defined('EMLOG_ROOT') && exit('access deined!');

$URL = base64_decode($_GET['github-url']);

if (!strstr($URL, 'github')) {
    echo 'NOT GITHUB URL';
    die();
}

preg_match('/github.com\/(.*?)\/(.*?)\//', $URL, $DOC_INFO);
// URL_IMAGE : img src="/MikeCoder/MyStudy/raw/master/MyBlogs/images/2014-04-14-1.png" alt
// URL_REAL : raw.githububusercontent.com/MikeCoder/MyStudy$url = "http://www.php100.com/logo.gif";
$CONTENT = file_get_contents($URL);
$CONTENT = strstr($CONTENT, '"mainContentOfPage">');
$CONTENT = substr($CONTENT, strlen('"mainContentOfPage">'));
$CONTENT = str_replace(strstr($CONTENT, '</article'), '', $CONTENT);
$CONTENT = str_replace('\n', '',$CONTENT);
$CONTENT = str_replace('\r\n', '',$CONTENT);

$IMAGE_URL_OLD = '/img src=(.*?raw)\//';
$IMAGE_URL_NEW = 'img src="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
$CONTENT = preg_replace($IMAGE_URL_OLD, $IMAGE_URL_NEW, $CONTENT);
$LINK_URL_OLD = '/a href=(.*?blob)\//';
$LINK_URL_NEW = 'a href="https://raw.githubusercontent.com/'.$DOC_INFO[1].'/'.$DOC_INFO[2].'/';
$CONTENT = preg_replace($LINK_URL_OLD, $LINK_URL_NEW, $CONTENT);

$CODE_URL_OLD = '/<pre>[\s\S]*?<code>/';
$CODE_URL_NEW = '<pre class="brush:php; toolbar:true; auto-links: true">';
$CONTENT = preg_replace($CODE_URL_OLD, $CODE_URL_NEW, $CONTENT);
$CODE_URL_OLD = '/<\/pre><\/code>/';
$CODE_URL_NEW = '</pre">';
$CONTENT = preg_replace($CODE_URL_OLD, $CODE_URL_NEW, $CONTENT);

$CONTENT = $CONTENT.'<END>';
$DOC_TITLE_REGEX = '/<h\d[\s\S]*?a>([\s\S]*?)<\/h\d>([\s\S]*)<END>/';
preg_match($DOC_TITLE_REGEX, $CONTENT, $DOC_INFO);
array_shift($DOC_INFO);

echo json_encode($DOC_INFO, JSON_UNESCAPED_UNICODE);
die();
