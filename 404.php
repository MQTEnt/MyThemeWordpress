<?php get_header(); //include("header.php"); ?>
<div class="content">
	<div id="main-content">
	<?php
		_e('<h2> 404 NOT FOUND </h2>','tmq');
		_e('<p>The article you were looking for was not found, but maybe try look again!', 'tmq');
		get_search_form(); //Nhúng khung tìm kiếm

		_e('<h3> Content categoies: </h3>', 'tmq');
		echo '<div class="404-cat-list">';
		wp_list_categories(['title_li' => '']); //Hiển thị danh sách category
		echo '</div> <!-- End .404-cat-list -->';

		_e('Tag Cloud ', 'tmq');
		wp_tag_cloud(); //Hiển thị danh sách tag
	?>

	</div> <!-- End #main-content -->
	<div id="side-bar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
