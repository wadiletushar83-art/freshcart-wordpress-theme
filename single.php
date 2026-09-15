<?php
/**
 * =========================================================
 * FRESHCART
 * SINGLE BLOG POST
 * =========================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="site-main freshcart-single-blog">

    <div class="freshcart-container">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : ?>

                <?php the_post(); ?>


                <!-- =================================================
                     BLOG ARTICLE
                ================================================= -->

                <article
                    id="post-<?php the_ID(); ?>"
                    <?php post_class( 'freshcart-single-article' ); ?>
                >


                    <!-- =================================================
                         ARTICLE HEADER
                    ================================================= -->

                    <header class="freshcart-single-header">

                        <!-- CATEGORY -->

                        <div class="freshcart-single-category">

                            <?php
                            $categories = get_the_category();

                            if ( ! empty( $categories ) ) :

                                foreach ( $categories as $category ) :
                                    ?>

                                    <a
                                        href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                                    >
                                        <?php echo esc_html( $category->name ); ?>
                                    </a>

                                    <?php
                                    break;

                                endforeach;

                            else :
                                ?>

                                <span>
                                    FreshCart Tips
                                </span>

                            <?php endif; ?>

                        </div>


                        <!-- TITLE -->

                        <h1 class="freshcart-single-title">

                            <?php
                            echo esc_html( get_the_title() );
                            ?>

                        </h1>


                        <!-- META -->

                        <div class="freshcart-single-meta">

                            <span>
                                By <?php echo esc_html( get_the_author() ); ?>
                            </span>

                            <span>
                                •
                            </span>

                            <span>
                                <?php echo esc_html( get_the_date( 'M d, Y' ) ); ?>
                            </span>

                        </div>

                    </header>


                    <!-- =================================================
                         FEATURED IMAGE
                    ================================================= -->

                    <?php if ( has_post_thumbnail() ) : ?>

                        <div class="freshcart-single-image">

                            <?php
                            the_post_thumbnail(
                                'full',
                                array(
                                    'loading' => 'eager',
                                    'alt'     => esc_attr( get_the_title() ),
                                )
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         ARTICLE CONTENT
                    ================================================= -->

                    <div class="freshcart-single-content">

                        <?php
                        the_content();
                        ?>

                    </div>


                    <!-- =================================================
                         POST PAGINATION
                    ================================================= -->

                    <div class="freshcart-single-navigation">

                        <div class="freshcart-single-prev">

                            <?php
                            previous_post_link(
                                '%link',
                                '← Previous Article'
                            );
                            ?>

                        </div>

                        <div class="freshcart-single-next">

                            <?php
                            next_post_link(
                                '%link',
                                'Next Article →'
                            );
                            ?>

                        </div>

                    </div>


                    <!-- =================================================
                         BACK TO BLOG
                    ================================================= -->

                    <div class="freshcart-single-back">

                        <a
                            href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
                        >
                            ← Back to Blog
                        </a>

                    </div>


                </article>


            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();
?>