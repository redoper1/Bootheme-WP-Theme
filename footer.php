			</div>

			<footer class="site-footer bg-<?php if ( get_theme_mod ('bootheme_footer_background' ) ) { echo get_theme_mod ('bootheme_footer_background' ); } else { echo 'transparent'; } ?> footer-<?php if ( get_theme_mod ('bootheme_footer_background' ) ) { if ( get_theme_mod ('bootheme_footer_background' ) == 'transparent' ) { echo 'light'; } else { echo get_theme_mod ('bootheme_footer_background' ); } } else { echo 'light'; } ?>">
				<div class="container">
					<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
					<div class="row">
						<div class="site-info col-12 col-md my-auto">
							<?php $blog_info = get_bloginfo( 'name' ); ?>
							<?php if ( ! empty( $blog_info ) ) { ?>
								<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
							<?php } ?>
							<?php
							echo __( 'Proudly powered by', 'bootheme' ) . ' ' . '<a href="https://wordpress.org/">WordPress</a>' . ' ' . __( 'and', 'bootheme' ) . ' ' . '<a href="' . wp_get_theme()->get( 'ThemeURI' ) . '">Bootheme</a>' . ' ' . __( 'theme', 'bootheme' );
							?>
							<?php
							if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
							}
							?>
						</div>
						<?php if ( has_nav_menu( 'footer' ) ) { ?>
							<nav class="footer-navigation d-inline-block col-12 col-md-auto" aria-label="<?php esc_attr_e( 'Footer Menu', 'bootheme' ); ?>">
								<?php
								wp_nav_menu(
									array(
										'menu'              => 'footer',
										'depth'             => 1,
										'container'         => 'ul',
										'menu_class'        => 'nav ml-auto',
										'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
										'walker'            => new wp_bootstrap_navwalker()
									)
								);
								?>
							</nav>
						<?php } ?>
					</div>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
