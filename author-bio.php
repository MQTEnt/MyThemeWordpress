<div class="entry-footer">
	<div class="author-box">
		<div class="author-avatar">
			<?php get_avatar(get_the_author_meta('ID')); //Get avartar của tác giả bài viết theo "ID" (được lấy trong hàm get_the author_meta()?>
		</div>
		<h3>
			<?php printf('Writen by <a href="%1$s">%2$s</a>',
						get_author_posts_url(get_the_author_meta('ID')), //Lấy đường dẫn tới trang của tác giả theo ID
						get_the_author()) //Lấy tên tác giả
			?>
		</h3>
		<p><?php echo get_the_author_meta('description'); //Lấy miêu tả về tác giả ?></p>
	</div>
</div>