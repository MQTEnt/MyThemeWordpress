<?php get_header(); //include("header.php"); ?>
<div class="content">
	<div id="main-content">
		<?php if(have_posts()): while(have_posts()): the_post(); //Loop ?>
		<?php
			get_template_part('content', get_post_format());
		?>
		<?php endwhile ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif ?>
	</div> <!-- End #main-content -->
	<div id="sidebar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
