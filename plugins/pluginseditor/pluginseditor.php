<?php
/*
  Plugin Name: 插件编辑插件
  Version: 1.0
  Plugin URL: http://www.mikecoder.cn
  Description: 可以在线直接编辑你的插件文件。
  Author: Mike
  ForEmlog:4.0.0+
  Author Email: mikecoder.cn@gmail.com
  Author URL: http://www.mikecoder.cn
 */
!defined('EMLOG_ROOT') && exit('access deined!');

function pluginseditor() {//写入插件导航
    echo '<div class="sidebarsubmenu" id="pluginseditor"><a href="./plugin.php?plugin=pluginseditor">插件编辑</a></div>';
}

addAction('adm_sidebar_ext', 'pluginseditor');
?>
