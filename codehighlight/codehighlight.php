<?php
/*
Plugin Name: 代码高亮插件
Version: 2.0
Plugin URL: http://www.btboys.com/post-97.html
Description: 在博文中插入代码。技术博客必备。采用syntaxHighlighter插件，支持绝大部分编程语言。
Author: GodSon
Author Email: wmails@126.com
ForEmlog:5.1.0
Author URL: http://www.jeasyuicn.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');


function codehighlight_writelog(){
	echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/codehighlight/brush/code.js"></script>'.'<style type="text/css">.ke-icon-code{background-image: url("../content/plugins/codehighlight/code.gif");background-position: 0 0;height: 16px;width: 16px;}</style>';
}
addAction('adm_writelog_head', 'codehighlight_writelog');

function codehighlight_headcss(){
echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/codehighlight/brush/shCore.css" /><link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/codehighlight/brush/shThemeRDark.css" />';
}
addAction('log_related','codehighlight_headcss');

function codehighlight_relatedlog(){
echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/codehighlight/brush/brush.js"></script><script type="text/javascript"> SyntaxHighlighter.config.clipboardSwf = "'.BLOG_URL.'content/plugins/codehighlight/brush/clipboard.swf";SyntaxHighlighter.config.bloggerMode = true; SyntaxHighlighter.all();setTimeout(function(){$("div.syntaxhighlighter div.lines td.content").attr("nowrap","nowrap");$("div.syntaxhighlighter").hover(function(){$(this).css("overflow-x","auto")},function(){$(this).css("overflow-x","hidden")})},2000);</script>';
}
addAction('log_related','codehighlight_relatedlog');