<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		 <!-- Hiển thị thumbnail cho post nếu có -->
		<?php tmq_thumbnail('thumbnail'); ?>
	</div> <!-- End #entry-thumbnail -->
	<div class="entry-header">
		<?php tmq_entry_header(); ?>
		<?php tmq_entry_meta(); ?>
	</div> <!-- End #entry-header -->
	<div class="entry-content">
		<?php tmq_entry_content(); ?>
		<?php (is_single() ? tmq_entry_tag() : ''); //Chỉ hiển thị tag cho trang nội dung post ?>
	</div> <!-- End #entry-content -->
</article>