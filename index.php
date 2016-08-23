<?php get_header(); //include("header.php"); ?>
<div class="content">
	<div id="main-content">
		<?php if(have_posts()): while(have_posts()): the_post(); //Loop ?>
		<?php
			get_template_part('content', get_post_format()); 
			//Hàm nhúng trang content-$format.php nếu post đó có format (image, video, gallery, quote, link)..
			//...nếu không thì hàm sẽ tự động nhúng trang content.php
		?>
		<?php endwhile ?>
		<?php tmq_pagination(); //Hàm phân trang ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); //Nhúng trang content-none.php nếu không có post ?>
		<?php endif ?>
	</div> <!-- End #main-content -->
	<div id="sidebar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
