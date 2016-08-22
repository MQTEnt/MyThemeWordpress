<?php get_header(); //include("header.php"); ?>
<div class="content">
	<div id="main-content">
		<div class="archive-title">
		<?php
			if(is_tag()): //Nếu là trang hiển thị Tag
				printf(__('Posts tagged: %1$s','tmq'), single_tag_title('',false));
			elseif(is_category()): //Nếu là trang hiển thị Category
				printf(__('Post categorized: %1$s','tmq'), single_cat_title('',false));
			elseif(is_day()): //Nếu là trang hiển thị bài viết trong ngày
				printf(__('Daily Archives: %1$s','tmq'), get_the_time('l, F j, Y'));
			elseif(is_moth()): //Nếu là trang hiển thị bài viết trong tháng
				printf(__('Monthly Archives: %1$s','tmq'), get_the_time('F Y'));
			elseif(is_year()): //Nếu là trang hiển thị bài viết trong năm
				printf(__('Yearly Archives: %1$s','tmq'), get_the_time('Y'));
			endif;
		?>	
		</div> <!-- End .archive-title -->
		
		<?php if(is_tag() || is_category()): //Hiển thị mô tả nếu là trang Category hoặc Tag?>
		<div class="archive-description">
			<?php echo term_description(); //In ra phần mô tả của Category hoặc Tag ?>
		</div> <!-- End .archive-description -->
		<?php endif; ?>

		<?php if(have_posts()): while(have_posts()): the_post(); //Loop ?>
		<?php
			get_template_part('content', get_post_format()); 
		?>
		<?php endwhile ?>
		<?php tmq_pagination(); //Gọi hàm phân trang ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif ?>
	</div> <!-- End #main-content -->
	<div id="side-bar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
