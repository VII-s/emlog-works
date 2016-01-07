<?php
!defined('EMLOG_ROOT') && exit('access deined!');
include(EMLOG_ROOT.'/content/plugins/pluginseditor/pluginseditor_config.php');
define('PLUGINS_PATH', EMLOG_ROOT.'/content/plugins/');

function dd($value) {
    d($value);
    die(0);
}
function d($value) {
    if(is_array($value)) {
        header("Content-type: application/json");
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
    } else {
        echo '<pre>';var_dump($value);echo '</pre>';
    }
}
function json_return($value) {
    header("Content-type: application/json");
    echo json_encode($value, JSON_UNESCAPED_UNICODE);
    exit();
}

/**
 *�����������
 **/
function getPluginsList(){
    $themeseditor_theme_list = array();
    if(is_readable(PLUGINS_PATH)){
        $handle = opendir(PLUGINS_PATH);
        if ($handle) {
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.')
                    continue;
                $file = PLUGINS_PATH . $filename;
                if (is_dir($file)) {
                    $themeseditor_theme_list[] = $filename;
                }
            }
            closedir($handle);
        }
    }
    return $themeseditor_theme_list;
}

/**
 *��������ļ��µ��ļ��б�
 **/
function getPluginsFileList($themeName){
    return pluginseditor_plugin_read_file(PLUGINS_PATH.$themeName);
}

/**
 *��ȡ�����ļ�����
 **/
function getPluginFileContent($themeName,$fileName){
    if(is_readable(PLUGINS_PATH .$themeName.'/'.$fileName)){
        $fso = fopen(PLUGINS_PATH .$themeName.'/'.$fileName, 'r');
        $content = fread($fso, filesize(PLUGINS_PATH . '/' .$themeName.'/'.$fileName));
        return pluginseditor_esc_textarea($content);
    }
    return "";
}

/**
 *���������ļ�����
 **/
function savePluginFileContent($themeName,$fileName,$content){
    if (!empty($content)) {
        $fso = fopen(PLUGINS_PATH.$themeName.'/'.$fileName, 'w');
        fwrite($fso, htmlspecialchars_decode($content));
        fclose($fso);
        return true;
    }
    return false;
}

function pluginseditor_setting_config($themeName,$fileName,$codemirrorTheme) {
    $fso = fopen(EMLOG_ROOT . '/content/plugins/pluginseditor/pluginseditor_config.php', 'r');
    $config = fread($fso, filesize(EMLOG_ROOT . '/content/plugins/pluginseditor/pluginseditor_config.php'));
    fclose($fso);

    if(!empty($codemirrorTheme)){
        $pattern = array("/define\('CODEMIRROR_THEME',(.*)\)/");
        $replace = array("define('CODEMIRROR_THEME','" . $codemirrorTheme . "')");
    }else{
        $pattern = array("/define\('THEMESEDITOR_CTHEME',(.*)\)/", "/define\('THEMESEDITOR_CFILE',(.*)\)/",);
        $replace = array("define('THEMESEDITOR_CTHEME','" . $themeName . "')", "define('THEMESEDITOR_CFILE','" . $fileName . "')",);
    }
    $new_config = preg_replace($pattern, $replace, $config);
    $fso = fopen(EMLOG_ROOT . '/content/plugins/pluginseditor/pluginseditor_config.php', 'w');
    fwrite($fso, $new_config);
    fclose($fso);
}


function getEditorMode($themeName,$fileName){
    $shufit =  pathinfo(PLUGINS_PATH.$themeName.'/'.$fileName, PATHINFO_EXTENSION);
    $mode = "application/x-httpd-php";
    if($shufit == "js"){
        $mode = "text/javascript";
    }elseif($shufit == "css"){
        $mode = "text/css";
    }
    return $mode;
}

function pluginseditor_plugin_read_file($path) {
    $pluginFiles = array();
    if(is_dir($path)){
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.' || $filename == "images")
                    continue;
                $file = $path . $filename;
                if (is_dir($file)) {
                    $dep = pluginseditor_plugin_read_file($file . '/');
                    $pluginFiles = array_merge($pluginFiles, $dep);
                } else {
                    $file_ext = strtolower(array_pop(explode('.', trim($file))));
                    if ($file_ext == "php" || $file_ext == "css" || $file_ext == "html" || $file_ext == "htm" || $file_ext == "js") {
                        $pluginFiles[] = $filename;
                    }
                }
            }
            closedir($handle);
        }
    }
    return $pluginFiles;
}

function pluginseditor_esc_textarea($text) {
    $safe_text = htmlspecialchars($text, ENT_QUOTES);
    return $safe_text;
}