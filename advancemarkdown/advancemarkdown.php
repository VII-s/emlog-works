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
function advancemarkdown(){
    $active_plugins = Option::get('active_plugins');
}

function advancemarkdown_savelog($id){
    header("Content-Type:text/html;charset=utf-8");
    global $logData, $Log_Model;
    include(EMLOG_ROOT.'/content/plugins/advancemarkdown/lib/parsedown.php');
    $Parsedown = new Parsedown();
    $logData['content'] = $Parsedown->text($logData['content']);
    $logData['content'] = str_replace('<pre><code>', '<pre class="brush:php; toolbar:true; auto-links: true;">', $logData['content']);
    $logData['content'] = str_replace('<code>', '<pre class="brush:php; toolbar:true; auto-links: true;">', $logData['content']);
    $logData['content'] = str_replace('</code></pre>', '</pre>', $logData['content']);
    $logData['content'] = str_replace('</code>', '</pre>', $logData['content']);
    $Log_Model->updateLog($logData, $id);
}

addAction('save_log', 'advancemarkdown_savelog');

function advancemarkdown_headcss(){
echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/advancemarkdown/lib/code/shCore.css" /><link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/advancemarkdown/lib/code/shThemeRDark.css" />';
}
addAction('log_related','advancemarkdown_headcss');

function advancemarkdown_relatedlog(){
echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/advancemarkdown/lib/code/brush.js"></script><script type="text/javascript"> SyntaxHighlighter.config.clipboardSwf = "'.BLOG_URL.'content/plugins/codehighlight/brush/clipboard.swf";SyntaxHighlighter.config.bloggerMode = true; SyntaxHighlighter.all();setTimeout(function(){$("div.syntaxhighlighter div.lines td.content").attr("nowrap","nowrap");$("div.syntaxhighlighter").hover(function(){$(this).css("overflow-x","auto")},function(){$(this).css("overflow-x","hidden")})},2000);</script>';
}
addAction('log_related','advancemarkdown_relatedlog');