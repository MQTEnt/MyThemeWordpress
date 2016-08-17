<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<?php tmq_thumbnail('thumbnail'); ?>
	</div> <!-- End #entry-thumbnail -->
	<div class="entry-header">
		<?php
			//Get custom field format-link-url và format-link-description mà post đã quy định
			$link = get_post_meta($post->ID, 'format-link-url', true);
			$link_description = get_post_meta($post->ID, 'format-link-description', true);
			if(is_single()){
				printf('<h1 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h1>', $link, get_the_title());
			}
			else{
				printf('<h2 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h2>', $link, get_the_title());
			}
		?>
	</div> <!-- End #entry-header -->
	<div class="entry-content">
		<?php 
			printf('<a href="%1$s" target="blank">%2$s</a>', $link, $link_description);
		?>
		<?php (is_single() ? tmq_entry_tag() : ''); //Chỉ hiển thị tag cho trang nội dung post ?>
	</div> <!-- End #entry-content -->
</article>