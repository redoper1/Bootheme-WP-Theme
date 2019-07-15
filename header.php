<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site" data-spy="scroll" data-target="#main-nav" data-offset="0">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bootheme' ); ?></a>
			<header id="master-header" class="site-header bg-<?php if ( get_theme_mod ('bootheme_header_background' ) ) { echo get_theme_mod ('bootheme_header_background' ); } else { echo 'light'; } ?> fixed-top">
				<nav id="main-nav" class="navbar navbar-expand-lg navbar-<?php if ( get_theme_mod ('bootheme_header_background' ) ) { if ( get_theme_mod ('bootheme_header_background' ) == 'transparent' ) { echo 'light'; } else { echo get_theme_mod ('bootheme_header_background' ); } } else { echo 'light'; } ?> container">
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php if ( get_theme_mod( 'custom_logo' ) ) { ?>
						<div class="site-logo"><?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, null ); ?></div>
					<?php } ?>
					<?php $blog_name = get_bloginfo( 'name' );
					if ( !empty( $blog_name ) && !get_theme_mod( 'custom_logo' ) || !empty( $blog_name ) && display_header_text() ) {
						bloginfo( 'name' );
					} ?>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php
							wp_nav_menu(
								array(
									'menu'              => 'nav-menu',
									'depth'             => 5,
									'container'         => 'ul',
									'menu_class'        => 'navbar-nav mr-auto',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker()
								)
							);

							bootstrap_search_form();
						?>
					</div>
				</nav>
			</header>

		<div id="content" class="site-content">
