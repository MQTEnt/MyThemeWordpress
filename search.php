<?php get_header(); //include("header.php"); ?>
<div class="content">
	<div id="main-content">
		<div class="search-info">
			<?php 
				$search_query = new WP_Query('s='.$s.'&showpost=-1');
				$search_keyword = wp_specialchars($s, 1);
				$search_count = $search_query->post_count;
				printf(__('We found %1$s articles for your search query.','tmq'), $search_count);
			?>
		</div> <!-- End .search-info -->

		<?php if(have_posts()): while(have_posts()): the_post(); //Loop ?>
		<?php
			get_template_part('content', get_post_format()); 
		?>
		<?php endwhile ?>
		<?php tmq_pagination();?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); //Nhúng trang content-none.php nếu trang không có post ?>
		<?php endif ?>
	</div> <!-- End #main-content -->
	<div id="sidebar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
