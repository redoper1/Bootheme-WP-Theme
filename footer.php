			</div>

			<footer class="site-footer bg-light">
				<div class="container">
					<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
					<div class="row">
						<div class="site-info col-12 col-md my-auto">
							<?php $blog_info = get_bloginfo( 'name' ); ?>
							<?php if ( ! empty( $blog_info ) ) { ?>
								<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
							<?php } ?>
							<?php
							printf( __( 'Proudly powered by <a href="https://wordpress.org/">%s</a> and <a href="' . wp_get_theme()->get( 'ThemeURI' ) . '">%s theme</a>', 'bootheme' ), 'WordPress', 'Bootheme' );
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
