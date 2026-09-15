<?php
/**
 * =========================================================
 * FRESHCART
 * BLOG ARCHIVE / BLOG LISTING
 * =========================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="site-main freshcart-blog-archive">

    <div class="freshcart-container">

        <!-- =================================================
             BLOG PAGE HEADER
        ================================================= -->

        <div class="freshcart-blog-header">

            <span class="freshcart-blog-label">
                FreshCart Blog
            </span>

            <h1 class="freshcart-blog-title">
                Fresh Tips &amp; Updates
            </h1>

            <p class="freshcart-blog-description">
                Smart tips, useful ideas and simple ways to make
                better grocery choices every day.
            </p>

        </div>


        <!-- =================================================
             BLOG POSTS
        ================================================= -->

        <?php if ( have_posts() ) : ?>

            <div class="freshcart-blog-grid">

                <?php while ( have_posts() ) : ?>

                    <?php the_post(); ?>

                    <article <?php post_class( 'freshcart-blog-card' ); ?>>

                        <!-- BLOG IMAGE -->

                        <a
                            href="<?php the_permalink(); ?>"
                            class="freshcart-blog-image"
                        >

                            <?php if ( has_post_thumbnail() ) : ?>

                                <?php
                                the_post_thumbnail(
                                    'large',
                                    array(
                                        'loading' => 'lazy',
                                        'alt'     => esc_attr( get_the_title() ),
                                    )
                                );
                                ?>

                            <?php else : ?>

                                <div class="freshcart-blog-placeholder">
                                    <span>🥬</span>
                                </div>

                            <?php endif; ?>

                            <span class="freshcart-blog-image-label">
                                Read More →
                            </span>

                        </a>


                        <!-- BLOG CONTENT -->

                        <div class="freshcart-blog-content">

                            <!-- META -->

                            <div class="freshcart-blog-meta">

                                <span class="freshcart-blog-category">

                                    <?php
                                    $categories = get_the_category();

                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name );
                                    } else {
                                        echo 'FreshCart Tips';
                                    }
                                    ?>

                                </span>

                                <span class="freshcart-blog-date">
                                    <?php echo esc_html( get_the_date( 'M d, Y' ) ); ?>
                                </span>

                            </div>


                            <!-- TITLE -->

                            <h2 class="freshcart-blog-post-title">

                                <a href="<?php the_permalink(); ?>">

                                    <?php
                                    echo esc_html( get_the_title() );
                                    ?>

                                </a>

                            </h2>


                            <!-- EXCERPT -->

                            <p class="freshcart-blog-excerpt">

                                <?php

                                $excerpt = get_the_excerpt();

                                if ( empty( $excerpt ) ) {

                                    $excerpt = wp_trim_words(
                                        get_the_content(),
                                        24,
                                        '...'
                                    );

                                }

                                echo esc_html(
                                    wp_trim_words(
                                        $excerpt,
                                        24,
                                        '...'
                                    )
                                );

                                ?>

                            </p>


                            <!-- READ ARTICLE -->

                            <a
                                href="<?php the_permalink(); ?>"
                                class="freshcart-blog-read-more"
                            >

                                Read Article

                                <span>
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                <?php endwhile; ?>

            </div>


            <!-- =================================================
                 PAGINATION
            ================================================= -->

            <div class="freshcart-blog-pagination">

                <?php
                the_posts_pagination(
                    array(
                        'mid_size'  => 2,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    )
                );
                ?>

            </div>


        <?php else : ?>

            <!-- =================================================
                 NO POSTS
            ================================================= -->

            <div class="freshcart-blog-empty">

                <div class="freshcart-blog-empty-icon">
                    🥬
                </div>

                <h2>
                    No Blog Posts Found
                </h2>

                <p>
                    We don't have any published articles yet.
                    Please check back soon.
                </p>

                <a
                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                    class="freshcart-blog-home-button"
                >
                    Back to Home
                </a>

            </div>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();
?>