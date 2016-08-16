<?php
 
/*
  @ Thiết lập các hằng dữ liệu quan trọng
  @ THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
  @ CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
*/
  define( 'THEME_URL', get_stylesheet_directory() );
  define( 'CORE', THEME_URL . '/core' );
 
/*
  @ Load file /core/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
*/
  require_once(CORE.'/init.php' );
 
/*
  @ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
*/
if ( ! isset( $content_width ) ) {
    /*
     * Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
     */
    $content_width = 620;
}
 
/*
  @ Thiết lập các chức năng sẽ được theme hỗ trợ
*/
if ( ! function_exists( 'tmq_theme_setup' ) ) {
    /*
     * Nếu chưa có hàm tmq_theme_setup() thì sẽ tạo mới hàm đó
     */
    function tmq_theme_setup() {
            /*
             * Thiết lập theme có thể dịch được
             */
            $language_folder = THEME_URL . '/languages';
            load_theme_textdomain( 'tmq', $language_folder );

            /*
             * Tự chèn RSS Feed links trong <head>
             */
            add_theme_support( 'automatic-feed-links' );

            /*
             * Thêm chức năng post thumbnail
             */
            add_theme_support( 'post-thumbnails' );

            /*
             * Thêm chức năng title-tag để tự thêm <title>
             */
            add_theme_support( 'title-tag' );

            /*
             * Thêm chức năng post format
             */
            add_theme_support( 'post-formats',
                    array(
                            'video',
                            'image',
                            'audio',
                            'gallery'
                    )
             );

            /*
             * Thêm chức năng custom background
             */
            $default_background = array(
                    'default-color' => '#e8e8e8',
            );
            add_theme_support( 'custom-background', $default_background );

            /*
             * Tạo menu cho theme
             */
             register_nav_menu ( 'primary-menu', __('Primary Menu', 'tmq') );

            /*
             * Tạo sidebar cho theme
             */
             $sidebar = array(
                'name' => __('Main Sidebar', 'tmq'),
                'id' => 'main-sidebar',
                'description' => 'Main sidebar for tmq theme',
                'class' => 'main-sidebar',
                'before_title' => '<h3 class="widgettitle">',
                'after_title' => '</h3>'
             );
             register_sidebar($sidebar);
    }
    add_action ( 'init', 'tmq_theme_setup' );
}
/*
@ Thiết lập hàm hiển thị logo
@ tmq_logo()
*/
if ( ! function_exists( 'tmq_logo' ) ) {
  function tmq_logo() {?>
    <div class="logo">
 
      <div class="site-name">
        <?php if ( is_home() ) {
          printf(
            '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'description' ),
            get_bloginfo( 'sitename' )
          );
        } else {
          printf(
            '</p><a href="%1$s" title="%2$s">%3$s</a></p>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'description' ),
            get_bloginfo( 'sitename' )
          );
        } // endif 
        ?>
      </div>
      <div class="site-description"><?php bloginfo( 'description' ); ?></div>
 
    </div>
  <?php }
}
 
/*
@ Thiết lập hàm hiển thị menu
@ tmq_menu( $slug )
*/
if ( ! function_exists( 'tmq_menu' ) ) {
  function tmq_menu( $slug ) {
    $menu = array(
      'theme_location' => $slug,
      'container' => 'nav',
      'container_class' => $slug,
    );
    wp_nav_menu( $menu );
  }
}