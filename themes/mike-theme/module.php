<?php
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE;
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE;
	$com_cache = $CACHE->readCache('comment');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment"><?php echo $value['name']; ?>
	<br /><a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE;
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
	<?php foreach($newLogs_cache as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logsearch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	</form>
	</ul>
	</li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE;
	$record_cache = $CACHE->readCache('record');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE;
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE;
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="bar">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="item <?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="sub-nav">
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul class="sub-nav">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE;
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
        }
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
    extract($neighborLog);
    if ($prevLog || $nextLog):?>
    <nav class="navigation post-navigation" role="navigation">
        <h2 class="screen-reader-text">Post navigation</h2>
        <div class="nav-links">
    <?php if($prevLog):?>
        <div class="nav-previous">
        <a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>">
            <span class="meta-nav" aria-hidden="true">Previous</span>
            <span class="screen-reader-text">Previous post:</span>
            <span class="post-title"><?php echo $prevLog['title'];?></span>
        </a>
        </div>
	<?php endif;?>
	<?php if($nextLog):?>
        <div class="nav-next">
        <a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>">
            <span class="meta-nav" aria-hidden="true">Next</span>
            <span class="screen-reader-text">Next post:</span>
            <span class="post-title"><?php echo $nextLog['title'];?></span>
        </a>
        </div>
	<?php endif;?>
    </nav>
    <?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
    <ol class="comment-list">
	<?php endif; ?>
            <?php createCommentPages($commentPageUrl, $comments);?>
	<?php
    $isGravatar = Option::get('isgravatar');
    foreach($commentStacks as $cid):
        $comment = $comments[$cid];
    	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
    <li id="comment-<?php echo $cid;?>" class="comment byuser comment-author-mikecoder bypostauthor even thread-even depth parent">
        <article id="div-comment-<?php echo $cid;?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <img class="avatar avatar-56 photo" width="56" height="56" src="<?php echo getGravatar($comment['mail']);?>" alt="">
                    <b class="fn"><?php echo $comment['poster'];?></b>
                    <span class="says">says:</span>
                </div>
                <div class="comment-metadata">
                    <a href="#">
                        <time datetime="<?php echo $comment['date']; ?>"> <?php echo $comment['date']; ?></time>
                    </a>
                </div>
                <div class="comment-content">
                    <?php echo $comment['content'];?>
                </div>
            </footer>
        </article>
    </li>
    <?php endforeach; ?>
    <?php createCommentPages($commentPageUrl, $comments);?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($url, $logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
    <div id="respond" class="comment-respond">
        <h3 id="reply-title" class="comment-reply-title">
            Leave a Reply
            <small>
                <a id="cancel-comment-reply-link" rel="nofollow" style="display: none;" href="<?php echo $url; ?>">Cancel reply</a>
            </small>
        </h3>
        <?php if (ROLE != ROLE_VISITOR) {?>
            <h4>You are logging as <span class="required"><?php echo $ckname;?></span></h4>
        <?php }?>
		<form id="commentform" class="comment-form" action="<?php echo BLOG_URL; ?>index.php?action=addcom" name="commentform" method="POST">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
            <?php if(ROLE == ROLE_VISITOR): ?>
            <p class="comment-notes">
                <span id="email-notes">Your email address will not be published.</span>Required fields are marked
                <span class="required">*</span>
            </p>
            <p class="comment-form-author">
                <label for="author">Name<span class="required">*</span></label>
                <input id="comname" type="text" name="author" value="<?php echo $ckname; ?>" size="30" aria-required="true">
			</p>
            <p class="comment-form-email">
                <label for="email">Email<span class="required">*</span></label>
                <input id="email" type="email" name="commail" value="<?php echo $ckmail; ?>" size="30" aria-describedby="email-notes" aria-required="true">
			</p>
            <p class="comment-form-url">
                <label for="url">Website</label>
                <input id="url" type="url" name="comurl" value="<?php echo $ckurl;?>" size="30">
            </p>
            <?php endif; ?>
            <p class="comment-form-comment">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea>
            </p>
            <p class="form-submit">
                <input id="submit" class="submit" type="submit" name="submit" value="Post Comment">
            </p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>


<?php
// <a href="http://localhost:8080/emlog/?post=11#comments">1</a>
// <span>2</span>
// <a href="http://localhost:8080/emlog/?post=11&comment-page=3#comments">3</a>
function commentsNav($page_url){
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

<?php
function createCommentPages($page_url, $comments){
    $pageNext = 0;
    $pages = commentsNav($page_url);
    if ($pages) {
?>
<nav class="navigation comment-navigation" role="navigation">
    <h2 class="screen-reader-text">Comment navigation</h2>
    <div class="nav-links">
<?php
        foreach ($pages as $key => $value) {
            if ($key === 'current') {
                if ($value-1 > 0) {
                    echo "<div class=\"nav-previous\"><a href=\"".$BLOG_URL."?post=".current($comments)['gid']."&comment-page=".($value-1)."#comments\">Older Comments</a></div>";
                }
                $pageNext = $value;
            }else{
                $pageNext++;
            }
            if ($pageNext > $pages['current']) {
                echo "<div class=\"nav-next\"><a href=\"".$BLOG_URL."?post=".current($comments)['gid']."&comment-page=".$pageNext."#comments\">Newer Comments</a></div>";
                break;
            }
        }
?>
    </div>
</nav>
<?php
    }
}
?>
