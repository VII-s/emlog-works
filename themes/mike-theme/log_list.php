<?php
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div id="content" class="site-content">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<?php doAction('index_loglist_top'); ?>

<?php
if (!empty($logs)):
foreach($logs as $value):
?>
<article id="post" class="post post type-post status-publish format-standard hentry category-uncategorized">
    <header class="entry-header">
        <h2 class="entry-title"><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
    </header>
    <div class="entry-content">
	    <?php echo $value['log_description']; ?>
    </div>
    <footer class="entry-footer">
        <span class="posted-on">
            <span class="screen-reader-text">Posted on </span>
                <a rel="bookmark" href="<?php echo $value['log_url']; ?>">
                    <time class="entry-date published updated"><?php echo @strftime("%A %d %b" , $value['date']); ?></time>
                </a>
            </span>
            <span class="comments-link">
                <a title="Comments on <?php echo $value['comnum']?>">Leave a Comment</a>
            </span>
        </span>
    </footer>
</article>
<?php
endforeach;
else:
?>
<article id="post" class="post post type-post status-publish format-standard hentry category-uncategorized">
    <header class="entry-header">
    	<h2>未找到</h2>
        <p>抱歉，没有符合您查询条件的结果。</p>
    </header>
</article>
<?php endif;?>
<nav class="navigation pagination" role="navigation">
    <h2 class="screen-reader-text">Posts navigation</h2>
    <div class="nav-links">
<?php
$pageNext = 0;
$pages = createPageNai($page_url);
if ($pages) {
    foreach ($pages as $key => $value) {
        if ($key === 'current') {
            if ($value-1 > 0) {
                echo "<a class=\"prev page-numbers\" href=\"".$BLOG_URL."?page=".($value-1)."\">Previous page</a>";
            }
            echo "<span class=\"page-numbers current\">".$value."</span>";
            $pageNext = $value;
        }else{
            echo "<a class=\"page-numbers\" href=\"".$BLOG_URL."?page=".$value."\">".$value."</a>";
            $pageNext++;
        }
        if ($pageNext > $pages['current']) {
            echo "<a class=\"next page-numbers\" href=\"".$BLOG_URL."?page=".($pages['current'] + 1)."\">Next Page</a>";
        }
    }
}
?>
</div>
</nav>
</main>
</div>
</div>
<?php
 include View::getView('footer');
?>

<?php
/**
 * change the page nav to custom size
 */
function createPageNai($page_url){
    if (!$page_url) {
        return false;
    }
    $pages = explode("  ", $page_url);
    foreach ($pages as $value) {
        if (strstr($value, "span") != false) { // the current page
            $regex = "/<span>(\d+)/";
            if (preg_match($regex, $value, $r) == 1 ){
                $res['current'] = $r[1];
            }
        }else{
            $regex = "/<a .*?>(\d+)/";
            if (preg_match($regex, $value, $r) == 1 ){
                $res[] = $r[1];
            }
        }
    }
    return $res;
}
?>
