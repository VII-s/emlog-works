<?php
/*
Plugin Name: GITHUB 文章同步
Version: 1.0
Plugin URL: http://mikecoder.net
Description: 一个URL,即可完成文章同步。
Author: Mike
Author Email: mike@mikecoder.net
Author URL: http://mikecoder.net
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function githubsync(){
    $active_plugins = Option::get('active_plugins');
}

function githubsync_editurl() {
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/js/check.js"></script>';
    echo '<br>&nbsp<a id="githubdoc" href="javascript:getGithubDocByUrl();" class="thickbox">填写GITHUB URL后点这:</a>&nbsp<input id="githuburl" style="width:550px"></input><br>';
}
addAction('adm_writelog_head', 'githubsync_editurl');

function githubsync_headcss(){
echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/githubsync/lib/code/shCore.css" /><link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/githubsync/lib/code/shThemeRDark.css" />';
}
addAction('log_related','githubsync_headcss');

function githubsync_relatedlog(){
echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/lib/code/brush.js"></script><script type="text/javascript"> SyntaxHighlighter.config.clipboardSwf = "'.BLOG_URL.'content/plugins/codehighlight/brush/clipboard.swf";SyntaxHighlighter.config.bloggerMode = true; SyntaxHighlighter.all();setTimeout(function(){$("div.syntaxhighlighter div.lines td.content").attr("nowrap","nowrap");$("div.syntaxhighlighter").hover(function(){$(this).css("overflow-x","auto")},function(){$(this).css("overflow-x","hidden")})},2000);</script>';
}
addAction('log_related','githubsync_relatedlog');
