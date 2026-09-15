<?php
/**
 * =========================================
 * FRESHCART
 * DEFAULT PAGE TEMPLATE
 * =========================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="site-main freshcart-page">

    <div class="freshcart-container">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : ?>

                <?php the_post(); ?>

                <!-- =========================================
                     PAGE HEADER
                     ========================================= -->

                <div class="freshcart-page-header">

                    <span class="freshcart-page-label">
                        FRESHCART
                    </span>

                    <h1 class="freshcart-page-title">
                        <?php the_title(); ?>
                    </h1>

                </div>


                <!-- =========================================
                     PAGE CONTENT
                     ========================================= -->

                <div class="freshcart-page-content">

                    <?php the_content(); ?>

                </div>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();
?>