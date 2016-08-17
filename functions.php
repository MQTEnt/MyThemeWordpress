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

/*
@ Hàm hiển thị Thumbnail (Featured Image) -->
*/
if(!function_exists('tmq_thumbnail')){
  function tmq_thumbnail($size){
          //Chỉ hiển thị thumbnail cho những post đủ điều kiện sau:
          if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')): ?>
            <fingure class="post-thumbnail">
              <?php the_post_thumbnail($size); //Tham số dựa trên kích cỡ các thumnail tại Settings/Media?>
            </fingure>
          <?php endif; ?>
  <?php }
}

/*
@ Hàm hiển thị Entry-Header (tiêu đề post)
*/
if(!function_exists('tmq_entry_header')){
  function tmq_entry_header(){ ?>
          <?php if(is_single()): //Nếu là trang hiển thị nội dung bài viêt (single.php) ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
          <?php else: ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <?php endif; ?>
  <?php }
}

/*
@ Hàm hiển thị Entry-meta (Tên tác giả, Tags, Category...)
*/
if(!function_exists('tmq_entry_meta')){
  function tmq_entry_meta(){ ?>
    <?php if(!is_page()): //Nếu là Page thì không cần hiển thị entry meta ?>
      <div class="entry-meta">
        <?php 
          printf(__('<span class="author">Posted by %1$s,</span>','tmq'), get_the_author());
          printf(__('<span class="date-published"> at %1$s</span>','tmq'), get_the_modified_date());
          printf(__('<span class="category"> in: %1$s</span> ','tmq'), get_the_category_list(', '));
          if(comments_open()): //Nếu post mở chức năng bình luận
            echo '<span class="meta-reply">';
            comments_popup_link( 
              __('Leave a comment','tmq'), 
              __('Only one comment','tmq'), 
              __('% comment','tmq'), 
              __('Read all comment','tmq')
            );
            echo '</span>';
          endif;
        ?>
      </div> <!-- End #entry-meta -->
    <?php endif; ?>
  <?php }
}

/*
@ Hàm hiển thị Entry-content (Nội dung bài viết)
*/
if(!function_exists('tmq_entry_content')){
  function tmq_entry_content(){
    if(!is_single()){
      //Hiển thị phần rút ngọn nội dung nếu không phải là trang chủ
      the_excerpt();
    }
    else{
      //Hiển thị toàn bộ nội dung nếu là trang hiển thị riêng (single.php)
      the_content();
      /* Phân trang cho single */
      $link_pages=[
        'before' => __('<p>Page: ','tmq'),
        'after' => '</p>',
        'nextpagelink' => __('Next page','tmq'),
        'previouspagelink' => __('Previous page','tmq')
      ];
      wp_link_pages($link_pages); //Hook //Dành cho việc phân trang trong post (<!--nextpage-->)
    }
  }
}
/* Hiển thị Read more (thay thế dấu [...]) */
function tmq_read_more(){
  return '<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__(' ...Read more','tmq').'<a>';
}
add_filter('excerpt_more','tmq_read_more');

/*
@ Hàm hiển thị Entry_tag
*/
if(!function_exists('tmq_entry_tag')){
  function tmq_entry_tag(){
    //Nếu post hiện tại có tag thì hiển thị
    if(has_tag()):
      echo '<div class="entry-tag">';
      printf(__('Tagged in %1$s', 'tmq'), get_the_tag_list('',', '));
      echo '</div> <!-- End .entry-tag -->';
    endif;
  }
}