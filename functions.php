<?php
if ( !function_exists( 'bootheme_setup' ) ) {
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
                'nav-menu'  => __( 'Navigation Menu', 'bootheme' ),
                'footer'    => __( 'Footer Menu', 'bootheme' ),
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
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        add_theme_support( 'header-text' );

        add_theme_support( 'custom-header' );
    }
}
add_action( 'after_setup_theme', 'bootheme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( !function_exists( 'bootheme_widgets_init' ) ) {
	function bootheme_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Side', 'bootheme' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Add widgets here to appear in your sidebar.', 'bootheme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer', 'bootheme' ),
				'id'            => 'sidebar-footer-1',
				'description'   => __( 'Add widgets here to appear in your footer.', 'bootheme' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}
}
add_action( 'widgets_init', 'bootheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
if ( !function_exists( 'bootheme_scripts' ) ) {
	function bootheme_scripts() {
		$my_theme = wp_get_theme();
		wp_enqueue_style( 'bootheme-style', get_theme_file_uri( 'style.min.css' ), array(), $my_theme->get( 'Version' ) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'jquery' );
		wp_register_script( 'boothme-header-scripts', get_theme_file_uri( 'js/scripts-head.min.js' ), array(), $my_theme->get( 'Version' ), false );
		wp_register_script( 'boothme-footer-scripts', get_theme_file_uri( 'js/scripts.min.js' ), array(), $my_theme->get( 'Version' ), true );
		wp_enqueue_script( 'boothme-header-scripts' );
		wp_enqueue_script( 'boothme-footer-scripts' );
	}
}
add_action( 'wp_enqueue_scripts', 'bootheme_scripts' );

// Register Custom Navigation Walker for Bootstrap 4
if ( !file_exists( get_template_directory() . '/vendor/class-wp-bootstrap-navwalker.php' ) ) {
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	require_once get_template_directory() . '/vendor/class-wp-bootstrap-navwalker.php';
}


if ( !function_exists( 'bootstrap_search_form' ) ) {
    function bootstrap_search_form() {
        echo '
            <form role="search" method="get" class="form-inline my-2 my-lg-0" action="' . esc_url( home_url( '/' ) ) . '">
                <label class="screen-reader-text" for="s">' . __( 'Search for:', 'bootheme' ) . '</label>
                <input class="form-control mr-sm-2" type="search" placeholder="' . __( 'Search', 'bootheme' ) . '" aria-label="' . __( 'Search', 'bootheme' ) . '" name="s" value="' . get_search_query() . '">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> ' . __( 'Search', 'bootheme' ) . '</button>
            </form>
        ';
    }
}

if ( !function_exists( 'bootheme_customize_register' ) ) {
	function bootheme_customize_register( $wp_customize ) {
		$wp_customize->remove_section( 'header_image' );

		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->add_control(
			'display_header_text',
			array(
				'settings' => 'header_textcolor',
				'label'    => __( 'Display Site Title', 'bootheme' ),
				'section'  => 'title_tagline',
				'type'     => 'checkbox',
				'priority' => 40,
			)
        );

        $wp_customize->add_setting(
            'bootheme_header_background',
            array(
                'default' => 'light',
            )
        );

		$wp_customize->add_setting(
			'bootheme_footer_background',
			array(
				'default' => 'transparent',
			)
		);

        $wp_customize->add_section(
            'bootheme',
            array(
                'title'      => 'Bootheme',
                'priority'   => 999,
            )
        );

        $wp_customize->add_control(
            'bootheme_header_background',
	        array(
		        'label'    => __( 'Header background preset', 'bootheme' ),
		        'section'  => 'bootheme',
		        'settings' => 'bootheme_header_background',
		        'type'     => 'select',
		        'choices'  => array(
			        'light'         => __( 'Light', 'bootheme' ),
			        'dark'          => __( 'Dark', 'bootheme' ),
			        //'transparent'   => __( 'Transparent', 'bootheme' ),
		        ),
	        )
        );

		$wp_customize->add_control(
			'bootheme_footer_background',
			array(
				'label'    => __( 'Footer background preset', 'bootheme' ),
				'section'  => 'bootheme',
				'settings' => 'bootheme_footer_background',
				'type'     => 'select',
				'choices'  => array(
					'light'         => __( 'Light', 'bootheme' ),
					'dark'          => __( 'Dark', 'bootheme' ),
					'transparent'   => __( 'Transparent', 'bootheme' ),
				),
			)
		);
	}
}
add_action( 'customize_register', 'bootheme_customize_register' );

if ( !function_exists( 'bootheme_menu_page_removing' ) ) {
	function bootheme_menu_page_removing() {
		global $submenu;
		foreach($submenu['themes.php'] as $menu_index => $theme_menu){
			if ( $theme_menu[1] == 'switch_themes' && $theme_menu[4] == 'hide-if-no-customize' ) {
				unset($submenu['themes.php'][$menu_index]);
			}
		}
	}
}
add_action( 'admin_menu', 'bootheme_menu_page_removing', 999 );

