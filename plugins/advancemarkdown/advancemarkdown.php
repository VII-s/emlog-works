<?php
/*
Plugin Name: Advance Markdown Parser
Version: 2.0
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
    $Log_Model->updateLog($logData, $id);
}

addAction('save_log', 'advancemarkdown_savelog');

function advancemarkdown_headcss(){
    echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/advancemarkdown/lib/css/default.css" />';
}
addAction('log_related','advancemarkdown_headcss');

function advancemarkdown_relatedlog(){
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/advancemarkdown/lib/js/highlight.js"></script>';
    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/advancemarkdown/lib/js/highlight.pack.js"></script>';
    echo '<script>hljs.initHighlightingOnLoad();</script>';
}
addAction('log_related','advancemarkdown_relatedlog');
