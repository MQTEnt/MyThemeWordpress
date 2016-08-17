<?php
/*
@ Khai báo hằng giá trị
  @ THEME_URL = Lấy đường dẫn tới thư mục theme
  @ CORE = Lấy đường dẫn tới thư mục core
*/
define( 'THEME_URL', get_stylesheet_directory() );
define ( 'CORE', THEME_URL . "/core" );
/*
@ Nhúng file /core/init.php
*/
require_once( CORE . "/init.php" );

/*
@ Thiết lập chiều rộng nội dung
*/
if(!isset($content_width)){
  $content_width = 620;
}

/*
@ KHAI BÁO CHỨC NĂNG CỦA THEME
*/
if(!function_exists('tmq_theme_setup')){
  function tmq_theme_setup() {
    /*@ Thiết lập textdomain */
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain( 'tmq', $language_folder );

    /*@ Tự động thêm link RSS cho <head> */
    add_theme_support( 'automatic-feed-links' );

    /*@ Thêm chức năng thumbnails cho phần viết post */
    add_theme_support( 'post-thumbnails' );

    /*@ Thêm chức năng format cho phần viết post */
    add_theme_support( 'post-formats',['image', 'video', 'gallery', 'quote', 'link']);

    /*@ Thêm title-tag */
    add_theme_support( 'title-tag' );

    /*@ Thêm custom background */
    $default_background = array(
      'default-color' => '#e8e8e8'
    );
    add_theme_support( 'custom-background', $default_background ); //Đăng kí Background (Phần Appearance/Background/Colors)

    /*@ Thêm lựa chọn menu (cho phần Theme locations) */
    register_nav_menu( 'primary-menu', __('Primary Menu (Menu chính)', 'tmq') ); //Đăng kí Menus (Phần Appeareance/Menus có thể dùng được)

    /*@ Tạo sidebar */
    $sidebar = array(
      'name' => __('Main Sidebar', 'tmq'),
      'id' => 'main-sidebar',
      'description' => __('Default sidebar'),
      'class' => 'main-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>'
    );
    register_sidebar( $sidebar ); //Đăng kí sidebar cho Widget (Hiển thị phần Apprearance/Widgets)

  }
  add_action('init', 'tmq_theme_setup'); //Hook
}


/* TEMPLATE FUNCTIONS */
if (!function_exists('tmq_header')) {
  function tmq_header(){ ?>
    <div class="site-name">
        <?php
          if(is_home()){
            printf( '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
            get_bloginfo('url'),
            get_bloginfo('description'),
            get_bloginfo('sitename') );
          }
          else{
            printf( '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
            get_bloginfo('url'),
            get_bloginfo('description'),
            get_bloginfo('sitename') );     
          }
        ?>
    </div>
    <div class="site-description"><?php bloginfo('description'); ?></div> <?php
  }
}

/*
@ Thiết hiển thị giao diện Menu (Navbar)
*/
if(!function_exists('tmq_menu')){
  function tmq_menu($slug) {
    $menu = array(
      'theme_location' => $slug,
      'container' => 'nav',
      'container_class' => $slug,
    );
    wp_nav_menu($menu); //Hiển thị menu (navbar)
  }
}

/*
@ Hàm phân trang 
*/
if(!function_exists('tmq_pagination')){
  function tmq_pagination(){
    //Các hàm dựa vào những cài đặt trong (Settings/Reading)
    //đường dẫn các page hiển thị bài viết mặc định là /page/2, page/3...
    //mỗi page sẽ chứa số lượng bài viết được set trong Settings/Reading
    if( $GLOBALS['wp_query']->max_num_pages < 2){
      //Không phân trang nếu ít hơn 2 trang
      return '';
    } ?>
    <nav class="pagination" role="navigation">
      <?php if(get_next_posts_link()): //Nếu có đường link bài cũ hơn ?>
        <div class="prev"><?php next_posts_link(__('Order posts','tmq')); ?></div>
      <?php endif; ?>
      <?php if(get_previous_posts_link()): ?>
        <div class="next"><?php previous_posts_link(__('Newer posts','tmq')); ?></div>
      <?php endif; ?>
    </nav>
  <?php }
}