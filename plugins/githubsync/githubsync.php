<?php
/*
Plugin Name: GITHUB 文章同步
Version: 2.0
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
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/lib/js/check.js"></script>';
    echo '<br>&nbsp<a id="githubdoc" href="javascript:getGithubDocByUrl();" class="thickbox">填写GITHUB URL后点这:</a>&nbsp<input id="githuburl" style="width:550px"></input><br>';
}
addAction('adm_writelog_head', 'githubsync_editurl');

function githubsync_headcss(){
    echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/githubsync/lib/css/default.css" />';
}
addAction('log_related','githubsync_headcss');

function githubsync_relatedlog(){
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/lib/js/highlight.js"></script>';
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/lib/js/highlight.pack.js"></script>';
    echo '<script>hljs.initHighlightingOnLoad();</script>';
}
addAction('log_related','githubsync_relatedlog');
