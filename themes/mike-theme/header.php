<?php
/*
Template Name:默认模板
Description:默认模板，简洁优雅
Version:1.2
Author:Mike
Author Url:http://www.emlog.net
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.js" type="text/javascript"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>

<!--[if IE 6]>
<script src="<?php echo TEMPLATE_URL; ?>iefix.js" type="text/javascript"></script>
<![endif]-->

<!-- Start the new code -->
<link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='twentyfifteen-fonts-css'  href='//fonts.googleapis.com/css?family=Noto+Sans%3A400italic%2C700italic%2C400%2C700%7CNoto+Serif%3A400italic%2C700italic%2C400%2C700%7CInconsolata%3A400%2C700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
<link rel='stylesheet' id='genericons-css'  href='<?php echo TEMPLATE_URL;?>genericons/genericons.css?ver=3.2' type='text/css' media='all' />
<link rel='stylesheet' id='twentyfifteen-style-css'  href='<?php echo TEMPLATE_URL;?>style.css?ver=4.1.1' type='text/css' media='all' />
<!--[if lt IE 9]>
<link rel='stylesheet' id='twentyfifteen-ie-css'  href='<?php echo TEMPLATE_URL;?>ie.css?ver=20141010' type='text/css' media='all' />
<![endif]-->
<!--[if lt IE 8]>
<link rel='stylesheet' id='twentyfifteen-ie7-css'  href='<?php echo TEMPLATE_URL;?>ie7.css?ver=20141010' type='text/css' media='all' />
<![endif]-->
<script type='text/javascript' src='<?php echo TEMPLATE_URL?>js/jquery/jquery.js?ver=1.11.1'></script>
<script type='text/javascript' src='<?php echo TEMPLATE_URL?>js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<meta name="generator" content="WordPress 4.1.1" />
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
	html { margin-top: 32px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 46px !important; }
		* html body { margin-top: 46px !important; }
	}
</style>
<!-- End the new code -->
<?php doAction('index_head'); ?>
</head>
<body class="home blog logged-in admin-bar customize-support">
    <div id="page" class="hfeed site">
        <div id="sidebar" class="sidebar" style="top: 0px;">
            <header id= "masthead" class="site-header" role="banner">
                <div class="site-branding">
                    <h1 class="site-title">
                        <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
                    </h1>
                    <p class="site-description">
                        <?php echo $bloginfo; ?>
                    </p>
                </div>
            </header>
            <div id="secondary" class="secondary">
                <!-- sidebar -->
            </div>
        </div> <!--./sidebar-->
