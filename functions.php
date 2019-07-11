<?php
if ( !function_exists( 'bootheme_setup' ) ) :
    function bootheme_setup() {
        load_theme_textdomain( 'bootheme', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        //set_post_thumbnail_size( 1568, 9999 );

        register_nav_menus(
            array(
                'nav-menu' => __( 'Navigation Menu', 'bootheme' ),
                'footer' => __( 'Footer Menu', 'bootheme' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 190,
                'width'       => 190,
                'flex-width'  => false,
                'flex-height' => false,
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );

        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => __( 'Small', 'bootheme' ),
                    'shortName' => __( 'S', 'bootheme' ),
                    'size'      => 19.5,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => __( 'Normal', 'bootheme' ),
                    'shortName' => __( 'M', 'bootheme' ),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => __( 'Large', 'bootheme' ),
                    'shortName' => __( 'L', 'bootheme' ),
                    'size'      => 36.5,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => __( 'Huge', 'bootheme' ),
                    'shortName' => __( 'XL', 'bootheme' ),
                    'size'      => 49.5,
                    'slug'      => 'huge',
                ),
            )
        );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
    }
endif;
add_action( 'after_setup_theme', 'bootheme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootheme_widgets_init() {

    register_sidebar(
        array(
            'name'          => __( 'Footer', 'bootheme' ),
            'id'            => 'sidebar-footer-1',
            'description'   => __( 'Add widgets here to appear in your footer.', 'bootheme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

}
add_action( 'widgets_init', 'bootheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bootheme_scripts() {
    $my_theme = wp_get_theme();
    wp_enqueue_style( 'bootheme-style', get_stylesheet_uri(), array(), $my_theme->get( 'Version' ) );
    wp_style_add_data( 'bootheme-style', 'rtl', 'replace' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'jquery' );
    wp_register_script( 'boothme-header-scripts', get_theme_file_uri( 'js/scripts-head.min.js' ), array(), $my_theme->get( 'Version' ),false );
    wp_register_script( 'boothme-footer-scripts', get_theme_file_uri( 'js/scripts.min.js' ), array(), $my_theme->get( 'Version' ),true );
    wp_enqueue_script( 'boothme-header-scripts' );
    wp_enqueue_script( 'boothme-footer-scripts' );
}
add_action( 'wp_enqueue_scripts', 'bootheme_scripts' );