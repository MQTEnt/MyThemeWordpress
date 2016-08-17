<?php get_header();?>
<div class="content">
	<div id="main-content">
		<?php if(have_posts()): while(have_posts()): the_post();?>
		<?php
			get_template_part('content', get_post_format()); 
		?>
		<?php endwhile ?>
		<?php tmq_pagination(); //Gọi hàm phân trang ?>
		<?php else: ?>
			<?php get_template_part('content', 'none');?>
		<?php endif ?>
	</div> <!-- End #main-content -->
	<div id="side-bar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
