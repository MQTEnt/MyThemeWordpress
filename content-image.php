<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<?php tmq_thumbnail('large'); ?>
	</div> <!-- End #entry-thumbnail -->
	<div class="entry-header">
		<?php tmq_entry_header(); ?>
		<?php
			//Lấy các thành phần attach của post hiện tại
			$attachment = get_children(['post_parent' => $post->ID]);
			//Đếm các thành phần attach (image)
			$attachment_number = count($attachment);
			printf(__('This post contains %1$s photos', 'tmq'), $attachment_number);
		?>
	</div> <!-- End #entry-header -->
	<div class="entry-content">
		<?php tmq_entry_content(); ?>
		<?php (is_single() ? tmq_entry_tag() : '');?>
	</div> <!-- End #entry-content -->
</article>