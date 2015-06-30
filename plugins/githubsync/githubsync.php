<?php
/*
Plugin Name: Advance Markdown Parser
Version: 1.0
Plugin URL: http://mikecoder.net
Description: Markdown!
Author: Mike
Author Email: mikecoder13@gmail.com
Author URL: http://mikecoder.net
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function dd($value) {
    var_dump($value);
    die();
}

function githubsync(){
    $active_plugins = Option::get('active_plugins');
}

function githubsync_savelog($id){
    header("Content-Type:text/html;charset=utf-8");
    global $logData, $Log_Model;
    include(EMLOG_ROOT.'/content/plugins/githubsync/lib/parsedown.php');
    $Parsedown = new Parsedown();
    $logData['content'] = $Parsedown->text($logData['content']);
    $logData['content'] = str_replace('<pre><code>', '<pre class="brush:php; toolbar:true; auto-links: true;">', $logData['content']);
    $logData['content'] = str_replace('<code>', '<pre class="brush:php; toolbar:true; auto-links: true;">', $logData['content']);
    $logData['content'] = str_replace('</code></pre>', '</pre>', $logData['content']);
    $logData['content'] = str_replace('</code>', '</pre>', $logData['content']);
    $Log_Model->updateLog($logData, $id);
}

function githubsync_editurl() {
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/githubsync/js/check.js"></script>';
    echo '<a id="githubdoc" href="javascript:getGithubDocByUrl();" class="thickbox">填写GITHUB连接后点这:</a>&nbsp<input id="githuburl" style="width:600px"></input><br>';
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
