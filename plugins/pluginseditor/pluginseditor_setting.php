<?php
!defined('EMLOG_ROOT') && exit('access deined!');
require_once 'pluginseditor_function.php';

function plugin_setting_view() {
    if (!is_writable(EMLOG_ROOT . '/content/plugins')) {
        emMsg('主题文件不可写。如果您使用的是Unix/Linux主机，请修改插件目录 (content/plugins) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为everyone可写');
    }
	$themeName = isset($_GET['themeName']) ? $_GET['themeName'] : THEMESEDITOR_CTHEME;
	$themeseditor_theme_list = getPluginsList();
    $themeseditor_theme_files = getPluginsFileList($themeName);

    if(isset($_GET['themeFileName']) && isset($_GET['themeName'])){
		$themeFileName = $_GET['themeFileName'];
	}elseif(isset($_GET['themeName'])){
		$themeFileName =$themeseditor_theme_files[0];
	}else{
		$themeFileName = THEMESEDITOR_CFILE;
	}

	if(isset($_GET['themeFileName'])){
		pluginseditor_setting_config($themeName,$themeFileName,null);
	}

	$themeseditor_theme_content = getPluginFileContent($themeName,$themeFileName);
	$mode = getEditorMode($themeName,$themeFileName);

	include(EMLOG_ROOT . '/content/plugins/pluginseditor/pluginseditor_setting_view.php');
}

function plugin_setting() {

}
