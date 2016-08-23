<?php 
/*
Template Name: Contact
*/
//Bắt buộc phải khai báo Template Name.
?>
<?php get_header();?>
<!-- Page Template: Contact -->
<div class="content">
	<div id="main-content">
		<div class="contact-info">
			<h4>Địa chỉ liên hệ</h4>
			<p>Hà Nội, Việt Nam</p>
			<p>0123456789</p>
		</div> <!-- End .contact-info -->
		<div class="contact-form">
			<?php echo do_shortcode('[contact-form-7 id="1412" title="Contact form 1"]'); //Thực thi short code của plug-in đã cài đặt (vd plug-in Contact Form 7) để hiển thị giao diện ?>
		</div> <!-- End .contact-form -->
	</div> <!-- End #main-content -->
	<div id="sidebar">
		<?php get_sidebar(); //sidebar.php ?>
	</div> <!-- End #side-bar -->
</div> <!-- End .content -->
<?php get_footer(); //footer.php ?>
