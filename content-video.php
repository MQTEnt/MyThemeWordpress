<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php tmq_entry_header(); ?>
	</div> <!-- End #entry-header -->
	<div class="entry-content">
		<?php the_content(); //Chỉ cần hiển thị nội dung cho post format video ?>
		<?php (is_single() ? tmq_entry_tag() : '');?>
	</div> <!-- End #entry-content -->
</article>