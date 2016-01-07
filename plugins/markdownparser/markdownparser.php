<?php
/*
Plugin Name: Markdown Parser
Version: 1.0 
Plugin URL: http://mikecoder.net
Description: Markdown!
Author: Mike
Author Email: mikecoder13@gmail.com
Author URL: http://mikecoder.net
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function markdownparser(){
    $active_plugins = Option::get('active_plugins');
}

function markdownparse($id){
    header("Content-Type:text/html;charset=utf-8");
    global $logData, $Log_Model;
    include(EMLOG_ROOT.'/content/plugins/markdownparser/lib/parsedown.php');
    $Parsedown = new Parsedown();
    $logData['content'] = $Parsedown->text($logData['content']);
    $Log_Model->updateLog($logData, $id);
}

function markdownparse_showstatus(){
    echo "<br>当前MarkDown Parser已经启用，如果需要进行MarkDown编写，请注意选择HTML源码编辑模式。";
}

addAction('save_log', 'markdownparse');
addAction('adm_writelog_head', 'markdownparse_showstatus');