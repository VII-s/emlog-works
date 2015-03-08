<?php
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<article id="post-6"
			class="post-6 post type-post status-publish format-standard hentry category-uncategorized">
			<header class="entry-header">
				<h1 class="entry-title">
					<?php echo $log_title;?>
				</h1>
			</header>
			<div class="entry-content">
				<?php echo $log_content;?>
			</div>
			<footer class="entry-footer">
				<span class="posted-on"> <span class="screen-reader-text">Posted
						on </span> <a rel="bookmark" href="<?php echo $value['log_url']; ?>">
						<time class="entry-date published updated">
							<?php echo @strftime("%A %d %b" , $value['date']); ?>
						</time>
				</a>
				</span> <span class="byline"> <span class="author vcard"> <span
						class="screen-reader-text">Author </span> <a class="url fn n"
						href="<?php echo BLOG_URL;?>?author=<?php echo ($author);?>">
							<?php blog_author($author);?>
					</a>
				</span>
				</span> <span class="cat-links"> <span class="screen-reader-text">Categories
				</span> <?php blog_sort($logid); ?>
				</span> <span class="tags-links"> <span class="screen-reader-text">Tags
				</span> <?php blog_tag($logid); ?>
				</span>
			</footer>
		</article>
		<?php neighbor_log($neighborLog);?>
		<div id="comments" class="comments-area">
			<h2 class="comments-title">
				<?php echo $logData['comnum'];?>
				thoughts on "<?php echo $log_title;?>"
            </h2>
            <?php blog_comments($comments); ?>
			<?php blog_comments_post($log_url,$logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		</div>
	</div>
	<!--.comments-->
	</main>
</div>
<!--.primary-->
</div>
<!--.content-->
<?php
 // include View::getView('side');
 include View::getView('footer');
?>

