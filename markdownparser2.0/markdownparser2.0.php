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

function markdownparse_showstatus(){
    echo "<br>当前MarkDown Parser已经启用，如果需要进行MarkDown编写，请注意选择HTML源码编辑模式。";
    echo "<br>具体的使用方法，可以参考<a href=\"http://mikecoder.net\">文档</a>。";

    echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/markdownparser2.0/lib/code.js"></script>'.'<style type="text/css">.ke-icon-code{background-image: url("../content/plugins/SHJS_for_Emlog/code.gif");background-position: 0 0;height: 16px;width: 16px;}</style>';
}
addAction('adm_writelog_head', 'SHJS_for_Emlog_writelog');
}

addAction('adm_writelog_head', 'markdownparse_showstatus');