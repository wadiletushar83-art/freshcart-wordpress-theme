<?php
/**
 * FreshCart - Search Results
 *
 * @package FreshCart
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
?>

<main class="freshcart-search-page">

    <!-- =========================================
         SEARCH HERO START
         ========================================= -->

    <section class="freshcart-search-hero">

        <div class="freshcart-search-container">

            <div class="freshcart-search-icon">
                <i class="fas fa-magnifying-glass"></i>
            </div>

            <span class="freshcart-search-eyebrow">
                FRESHCART SEARCH
            </span>

            <h1>
                Search Results
            </h1>

            <?php if ( ! empty( $search_query ) ) : ?>

                <p>
                    Showing results for
                    <strong>
                        “<?php echo esc_html( $search_query ); ?>”
                    </strong>
                </p>

            <?php else : ?>

                <p>
                    Find your favourite grocery products.
                </p>

            <?php endif; ?>

        </div>

    </section>

    <!-- =========================================
         SEARCH HERO END
         ========================================= -->


    <!-- =========================================
         SEARCH CONTENT START
         ========================================= -->

    <section class="freshcart-search-content">

        <div class="freshcart-search-container">


            <!-- =========================================
                 SEARCH BAR START
                 ========================================= -->

            <div class="freshcart-search-box">

                <form
                    role="search"
                    method="get"
                    action="<?php echo esc_url( home_url( '/' ) ); ?>"
                    class="freshcart-search-form"
                >

                    <div class="freshcart-search-input-wrap">

                        <i class="fas fa-magnifying-glass"></i>

                        <input
                            type="search"
                            name="s"
                            value="<?php echo esc_attr( $search_query ); ?>"
                            placeholder="Search for groceries, fruits, snacks..."
                            autocomplete="off"
                        />

                    </div>

                    <input
                        type="hidden"
                        name="post_type"
                        value="product"
                    />

                    <button
                        type="submit"
                        class="freshcart-search-submit"
                    >
                        <i class="fas fa-magnifying-glass"></i>
                        Search
                    </button>

                </form>

            </div>

            <!-- =========================================
                 SEARCH BAR END
                 ========================================= -->


            <?php if ( have_posts() ) : ?>

                <!-- =========================================
                     RESULT HEADER
                     ========================================= -->

                <div class="freshcart-search-results-header">

                    <div>

                        <span class="freshcart-results-label">
                            SEARCH RESULTS
                        </span>

                        <h2>
                            Products you may like
                        </h2>

                    </div>

                    <span class="freshcart-results-count">

                        <?php
                        global $wp_query;

                        echo esc_html(
                            $wp_query->found_posts
                        );
                        ?>

                        Products

                    </span>

                </div>

                <!-- =========================================
                     RESULT HEADER END
                     ========================================= -->


                <!-- =========================================
                     PRODUCT GRID START
                     ========================================= -->

                <div class="freshcart-search-product-grid">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        $product = wc_get_product( get_the_ID() );

                        if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
                            continue;
                        }
                        ?>

                        <div class="freshcart-search-product">

                            <?php
                            wc_get_template(
                                'content-product.php',
                                array(
                                    'product' => $product,
                                )
                            );
                            ?>

                        </div>

                    <?php endwhile; ?>

                </div>

                <!-- =========================================
                     PRODUCT GRID END
                     ========================================= -->


                <!-- =========================================
                     PAGINATION START
                     ========================================= -->

                <div class="freshcart-search-pagination">

                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-arrow-left"></i> Previous',
                            'next_text' => 'Next <i class="fas fa-arrow-right"></i>',
                        )
                    );
                    ?>

                </div>

                <!-- =========================================
                     PAGINATION END
                     ========================================= -->


            <?php else : ?>

                <!-- =========================================
                     NO RESULTS START
                     ========================================= -->

                <div class="freshcart-search-empty">

                    <div class="freshcart-search-empty-icon">

                        <i class="fas fa-magnifying-glass"></i>

                    </div>

                    <span class="freshcart-empty-label">
                        NO PRODUCTS FOUND
                    </span>

                    <h2>
                        We couldn't find that product
                    </h2>

                    <p>
                        Try searching with a different product name
                        or browse our grocery collection.
                    </p>

                    <a
                        href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"
                        class="freshcart-search-shop-button"
                    >

                        <i class="fas fa-bag-shopping"></i>

                        Browse Shop

                    </a>

                </div>

                <!-- =========================================
                     NO RESULTS END
                     ========================================= -->

            <?php endif; ?>


        </div>

    </section>

    <!-- =========================================
         SEARCH CONTENT END
         ========================================= -->

</main>


<?php get_footer(); ?>