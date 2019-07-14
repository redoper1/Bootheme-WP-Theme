<?php
get_header();
?>
    <div id="content-container" class="container">
        <div class="row">
            <div id="page-wrapper" class="col-12 <?php if ( is_active_sidebar( 'sidebar-1' ) ) echo 'col-md-10'; ?>">
                <?php
                if ( have_posts() ) { ?>
                    <header class="entry-header">
                        <?php if ( is_page() && !is_singular('post') ) {
                            echo '<h1 class="page-title">' . get_the_title() . '</h1>';
                            } elseif ( is_singular('post') ) {
                                echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
                            } elseif (get_option('page_for_posts', true)) {
                                echo '<h1 class="page-title">' . get_the_title( get_option('page_for_posts', true) ) . '</h1>';
                            } ?>
                    </header>

                    <?php
                    // Load posts loop.
                    while ( have_posts() ) {
                        the_post();
                        if (!is_singular()) {
                            the_title( sprintf( '<h2 class="page-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                            the_excerpt();
                        } else {
                            the_content();
                        }
                    }

                    // Previous/next page navigation.
                    // TODO: Previous/next page navigation

                } else { ?>
                    <header class="entry-header">
                        <h1 class="page-title"><?php _e( 'Nothing Found', 'bootheme' ); ?></h1>
                    </header>

                    <?php
                    if ( is_home() && current_user_can( 'publish_posts' ) ) {
                        printf(
                            '<p>' . wp_kses(
                                /* translators: 1: link to WP admin new post page. */
                                __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bootheme' ),
                                array(
                                    'a' => array(
                                        'href' => array(),
                                    ),
                                )
                            ) . '</p>',
                            esc_url( admin_url( 'post-new.php' ) )
                        );

                    } elseif ( is_search() ) {
                        ?>

                        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootheme' ); ?></p>
                        <?php
                        bootstrap_search_form();

                    } else {
                        ?>

                        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootheme' ); ?></p>
                        <?php
                        bootstrap_search_form();
                    }
                }
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();
