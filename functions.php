<?php

/**
 * =========================================================
 * FRESHCART
 * FUNCTIONS.PHP
 * CLEAN + COMPLETE SETUP
 * =========================================================
 */

defined('ABSPATH') || exit;


/* =========================================================
   THEME SETUP
   ========================================================= */

function freshcart_theme_setup()
{

    /* Translation */
    load_theme_textdomain(
        'freshcart',
        get_template_directory() . '/languages'
    );


    /* Dynamic Title */
    add_theme_support('title-tag');


    /* Featured Images */
    add_theme_support('post-thumbnails');


    /* Custom Logo */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 80,
            'width'       => 250,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );


    /* HTML5 Support */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );


    /* WooCommerce Support */
    add_theme_support('woocommerce');


    /* Navigation Menus */
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'freshcart'),
            'footer'  => __('Footer Menu', 'freshcart'),
        )
    );
}

add_action(
    'after_setup_theme',
    'freshcart_theme_setup'
);


/* =========================================================
   HELPER
   LOAD CSS ONLY IF FILE EXISTS
   ========================================================= */

function freshcart_enqueue_css($handle, $filename, $dependencies = array())
{

    $theme_path = get_template_directory();
    $theme_uri  = get_template_directory_uri();

    $file_path = $theme_path . '/assets/css/' . $filename;


    if (! file_exists($file_path)) {
        return;
    }


    wp_enqueue_style(
        $handle,
        $theme_uri . '/assets/css/' . $filename,
        $dependencies,
        filemtime($file_path)
    );
}


/* =========================================================
   LOAD CSS + JAVASCRIPT
   ========================================================= */

function freshcart_enqueue_assets()
{

    /*
     * -----------------------------------------------------
     * GLOBAL CSS
     * -----------------------------------------------------
     */

    freshcart_enqueue_css(
        'freshcart-global',
        'global.css'
    );


    /*
     * -----------------------------------------------------
     * FONT AWESOME
     * -----------------------------------------------------
     */

    wp_enqueue_style(
        'freshcart-font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );


    /*
     * -----------------------------------------------------
     * HEADER CSS
     * -----------------------------------------------------
     */

    freshcart_enqueue_css(
        'freshcart-header',
        'header.css',
        array('freshcart-global')
    );


    /*
     * -----------------------------------------------------
     * HOME / COMMON CSS
     * -----------------------------------------------------
     */

    $common_css = array(
        'freshcart-hero'            => 'hero.css',
        'freshcart-categories'      => 'categories.css',
        'freshcart-offers'          => 'offers.css',
        'freshcart-products'        => 'products.css',
        'freshcart-delivery-banner' => 'delivery-banner.css',
        'freshcart-why-choose-us'   => 'why-choose-us.css',
        'freshcart-testimonials'    => 'testimonials.css',
        'freshcart-blog'            => 'blog.css',
        'freshcart-newsletter'      => 'newsletter.css',
        'freshcart-footer'          => 'footer.css',
    );


    foreach ($common_css as $handle => $filename) {

        freshcart_enqueue_css(
            $handle,
            $filename,
            array('freshcart-global')
        );
    }


    /*
     * -----------------------------------------------------
     * SHOP CSS
     * -----------------------------------------------------
     *
     * Shop/archive/category pages वरच load होईल.
     */

    if (
        ( function_exists( 'is_shop' ) && is_shop() )
        || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() )
    ) {

        freshcart_enqueue_css(
            'freshcart-shop',
            'shop.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * BLOG PAGE CSS
     * -----------------------------------------------------
     */

    if (
        is_page_template( 'page-templates/page-blog.php' )
        || is_home()
        || is_archive()
    ) {

        freshcart_enqueue_css(
            'freshcart-blog-page',
            'blog-page.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * SINGLE PRODUCT CSS
     * -----------------------------------------------------
     */

    if (
        function_exists( 'is_product' )
        && is_product()
    ) {

        freshcart_enqueue_css(
            'freshcart-single-product',
            'single-product.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * CART CSS
     * -----------------------------------------------------
     */

    if (
        function_exists( 'is_cart' )
        && is_cart()
    ) {

        freshcart_enqueue_css(
            'freshcart-cart',
            'cart.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * CHECKOUT CSS
     * -----------------------------------------------------
     */

    if (
        function_exists( 'is_checkout' )
        && is_checkout()
        && ! is_order_received_page()
    ) {

        freshcart_enqueue_css(
            'freshcart-checkout',
            'checkout.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * THANK YOU / ORDER RECEIVED CSS
     * -----------------------------------------------------
     */

    if (
        function_exists( 'is_order_received_page' )
        && is_order_received_page()
    ) {

        freshcart_enqueue_css(
            'freshcart-thankyou',
            'thankyou.css',
            array( 'freshcart-global' )
        );
    }


    /*
     * -----------------------------------------------------
     * MY ACCOUNT CSS
     * -----------------------------------------------------
     *
     * My Account page वरच हा CSS load होईल.
     */

    if (
        function_exists('is_account_page')
        && is_account_page()
    ) {

        freshcart_enqueue_css(
            'freshcart-my-account',
            'my-account.css',
            array('freshcart-global')
        );
    }


    /*
     * -----------------------------------------------------
     * ABOUT PAGE CSS
     * -----------------------------------------------------
     *
     * About page साठी.
     * File नसल्यास helper automatically skip करेल.
     */

    if (
        is_page_template('page-templates/page-about.php')
    ) {

        freshcart_enqueue_css(
            'freshcart-about',
            'about.css',
            array('freshcart-global')
        );
    }


    /*
     * -----------------------------------------------------
     * CONTACT PAGE CSS
     * -----------------------------------------------------
     *
     * Contact page साठी.
     */

    if (
        is_page_template('page-templates/page-contact.php')
    ) {

        freshcart_enqueue_css(
            'freshcart-contact',
            'contact.css',
            array('freshcart-global')
        );
    }


    /*
     * -----------------------------------------------------
     * RESPONSIVE CSS
     * -----------------------------------------------------
     */

    freshcart_enqueue_css(
        'freshcart-responsive',
        'responsive.css',
        array(
            'freshcart-global',
            'freshcart-header',
        )
    );


    /*
     * -----------------------------------------------------
     * MAIN JAVASCRIPT
     * -----------------------------------------------------
     *
     * FreshCart main JavaScript is loaded on every frontend page.
     * filemtime() automatically refreshes the browser cache when
     * main.js is changed.
     */

    $main_js = get_template_directory() . '/assets/js/main.js';

    wp_enqueue_script(
        'freshcart-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        file_exists( $main_js ) ? filemtime( $main_js ) : null,
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'freshcart_enqueue_assets'
);


/* =========================================================
   CART JAVASCRIPT
   ========================================================= */

function freshcart_enqueue_cart_script()
{

    if (
        ! function_exists('is_cart')
        || ! is_cart()
    ) {
        return;
    }


    $cart_js = get_template_directory() . '/assets/js/cart.js';


    if (! file_exists($cart_js)) {
        return;
    }


    wp_enqueue_script(
        'freshcart-cart',
        get_template_directory_uri() . '/assets/js/cart.js',
        array('jquery'),
        filemtime($cart_js),
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'freshcart_enqueue_cart_script',
    20
);


/* =========================================================
   WIDGET AREA
   ========================================================= */

function freshcart_widgets_init()
{

    register_sidebar(
        array(
            'name'          => __('Main Sidebar', 'freshcart'),
            'id'            => 'main-sidebar',
            'description'   => __('Main website sidebar.', 'freshcart'),
            'before_widget' => '<div class="widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}

add_action(
    'widgets_init',
    'freshcart_widgets_init'
);


/* =========================================================
   PRODUCT IMAGE IMPORT SYSTEM
   MANUAL TRIGGER
   ========================================================= */

function freshcart_add_product_images()
{

    /* Only admin area */
    if ( ! is_admin() ) {
        return;
    }


    /*
     * Security:
     * Only administrators can run the manual image importer.
     */

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }


    /*
     * Manual trigger:
     *
     * ?freshcart_import_images=1
     */

    if ( ! isset( $_GET['freshcart_import_images'] ) ) {
        return;
    }


    /*
     * Nonce:
     * Prevent unauthorized requests from triggering the importer.
     */

    if (
        ! isset( $_GET['_wpnonce'] )
        || ! wp_verify_nonce(
            sanitize_text_field(
                wp_unslash( $_GET['_wpnonce'] )
            ),
            'freshcart_import_product_images'
        )
    ) {
        wp_die(
            'Security verification failed. Please use the authorized FreshCart image importer link.'
        );
    }


    /* WooCommerce check */

    if (! function_exists('wc_get_products')) {

        wp_die(
            'WooCommerce is not active.'
        );
    }


    /* WordPress media functions */

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';


    /*
     * =====================================================
     * PRODUCT IMAGE MAP
     * =====================================================
     */

    $product_images = array(

        /* FRUITS & VEGETABLES */

        'fresh-tomato-500g' =>
        'https://images.unsplash.com/photo-1546470427-e26264be0b0d?auto=format&fit=crop&w=800&q=85',

        'fresh-potato-1kg' =>
        'https://images.unsplash.com/photo-1518977676601-b53f82aba655?auto=format&fit=crop&w=800&q=85',

        'fresh-onion-1kg' =>
        'https://images.unsplash.com/photo-1508747703725-719777637510?auto=format&fit=crop&w=800&q=85',

        'banana-robusta-1-dozen' =>
        'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&w=800&q=85',

        'fresh-apple-1kg' =>
        'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?auto=format&fit=crop&w=800&q=85',

        'green-capsicum-500g' =>
        'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?auto=format&fit=crop&w=800&q=85',

        'green-peas-500g' =>
        'https://images.unsplash.com/photo-1587735243615-c03f25aaff15?auto=format&fit=crop&w=800&q=85',

        'fresh-carrot-500g' =>
        'https://images.unsplash.com/photo-1445282768818-728615cc910a?auto=format&fit=crop&w=800&q=85',

        'fresh-cucumber-500g' =>
        'https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=800&q=85',


        /* DAIRY */

        'amul-taaza-milk-1l' =>
        'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=800&q=85',

        'amul-butter-100g' =>
        'https://images.unsplash.com/photo-1589985270826-4b7bb135bc9d?auto=format&fit=crop&w=800&q=85',

        'amul-paneer-200g' =>
        'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=800&q=85',

        'corn-flakes-300g' =>
        'https://images.unsplash.com/photo-1528207776546-365bb710ee93?auto=format&fit=crop&w=800&q=85',


        /* BAKERY */

        'brown-bread-400g' =>
        'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=85',

        'chocolate-cream-biscuits-120g' =>
        'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?auto=format&fit=crop&w=800&q=85',


        /* SNACKS */

        'classic-potato-chips-100g' =>
        'https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&fit=crop&w=800&q=85',

        'masala-namkeen-200g' =>
        'https://images.unsplash.com/photo-1621939514649-280e2aa9f8c5?auto=format&fit=crop&w=800&q=85',

        'coca-cola-750ml' =>
        'https://images.unsplash.com/photo-1554866585-cd94860890b7?auto=format&fit=crop&w=800&q=85',

        'mango-juice-1l' =>
        'https://images.unsplash.com/photo-1623065422902-30a2d299bbe4?auto=format&fit=crop&w=800&q=85',


        /* TEA & COFFEE */

        'tata-tea-250g' =>
        'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&w=800&q=85',

        'bru-instant-coffee-100g' =>
        'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=85',


        /* ATTA RICE DAL */

        'india-gate-basmati-rice-5kg' =>
        'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=85',

        'aashirvaad-atta-5kg' =>
        'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=85',

        'toor-dal-1kg' =>
        'https://images.unsplash.com/photo-1585996740712-3a3c5f4d2e18?auto=format&fit=crop&w=800&q=85',


        /* OIL & MASALA */

        'fortune-sunflower-oil-1l' =>
        'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=800&q=85',

        'everest-garam-masala-100g' =>
        'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=800&q=85',


        /* HOUSEHOLD */

        'surf-excel-matic-2kg' =>
        'https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&w=800&q=85',

        'vim-dishwash-liquid-500ml' =>
        'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=85',


        /* PERSONAL CARE */

        'dove-beauty-bar-100g' =>
        'https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=800&q=85',

        'colgate-strong-teeth-200g' =>
        'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?auto=format&fit=crop&w=800&q=85',


        /* BABY CARE */

        'johnsons-baby-powder-200g' =>
        'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&w=800&q=85',
    );


    /*
     * =====================================================
     * PROCESS PRODUCTS
     * =====================================================
     */

    foreach ($product_images as $slug => $image_url) {

        $product = get_page_by_path(
            $slug,
            OBJECT,
            'product'
        );


        if (! $product) {
            continue;
        }


        /* Existing image असल्यास skip */

        if (has_post_thumbnail($product->ID)) {
            continue;
        }


        /* Download image */

        $attachment_id = media_sideload_image(
            $image_url,
            $product->ID,
            get_the_title($product->ID),
            'id'
        );


        /* Set featured image */

        if (! is_wp_error($attachment_id)) {

            set_post_thumbnail(
                $product->ID,
                $attachment_id
            );
        }
    }


    /* Complete message */

    wp_die(
        '<h2>FreshCart Product Images Process Completed!</h2>
        <p>Product images have been processed successfully.</p>
        <p><strong>Now go to Products → All Products.</strong></p>'
    );
}

add_action(
    'admin_init',
    'freshcart_add_product_images'
);


/* =========================================================
   PRODUCT IMAGE FALLBACK SYSTEM
   ========================================================= */

function freshcart_get_product_image_url($product)
{

    /*
     * Default image
     */

    $default_image =
        'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=85';


    /*
     * Product validation
     */

    if (
        ! $product
        || ! is_a($product, 'WC_Product')
    ) {

        return $default_image;
    }


    /*
     * Product name
     */

    $product_name = strtolower(
        $product->get_name()
    );


    /*
     * Product slug
     */

    $product_slug = strtolower(
        $product->get_slug()
    );


    /*
     * =====================================================
     * PRODUCT KEYWORD IMAGE MAP
     * =====================================================
     */

    $image_map = array(

        'tomato' =>
        'https://images.unsplash.com/photo-1546470427-e26264be0b0d?auto=format&fit=crop&w=800&q=85',

        'potato' =>
        'https://images.unsplash.com/photo-1518977676601-b53f82aba655?auto=format&fit=crop&w=800&q=85',

        'onion' =>
        'https://images.unsplash.com/photo-1508747703725-719777637510?auto=format&fit=crop&w=800&q=85',

        'banana' =>
        'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&w=800&q=85',

        'apple' =>
        'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?auto=format&fit=crop&w=800&q=85',

        'capsicum' =>
        'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?auto=format&fit=crop&w=800&q=85',

        'peas' =>
        'https://images.unsplash.com/photo-1587735243615-c03f25aaff15?auto=format&fit=crop&w=800&q=85',

        'carrot' =>
        'https://images.unsplash.com/photo-1445282768818-728615cc910a?auto=format&fit=crop&w=800&q=85',

        'cucumber' =>
        'https://images.unsplash.com/photo-1449300079323-02e209d9d3a6?auto=format&fit=crop&w=800&q=85',

        'milk' =>
        'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=800&q=85',

        'butter' =>
        'https://images.unsplash.com/photo-1589985270826-4b7bb135bc9d?auto=format&fit=crop&w=800&q=85',

        'paneer' =>
        'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=800&q=85',

        'bread' =>
        'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=85',

        'chips' =>
        'https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&fit=crop&w=800&q=85',

        'namkeen' =>
        'https://images.unsplash.com/photo-1621939514649-280e2aa9f8c5?auto=format&fit=crop&w=800&q=85',

        'coca' =>
        'https://images.unsplash.com/photo-1554866585-cd94860890b7?auto=format&fit=crop&w=800&q=85',

        'mango' =>
        'https://images.unsplash.com/photo-1623065422902-30a2d299bbe4?auto=format&fit=crop&w=800&q=85',

        'tea' =>
        'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&w=800&q=85',

        'coffee' =>
        'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=85',

        'rice' =>
        'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=85',

        'atta' =>
        'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=85',

        'dal' =>
        'https://images.unsplash.com/photo-1585996740712-3a3c5f4d2e18?auto=format&fit=crop&w=800&q=85',

        'oil' =>
        'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=800&q=85',

        'masala' =>
        'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=800&q=85',

        'surf' =>
        'https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&w=800&q=85',

        'vim' =>
        'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=85',

        'dove' =>
        'https://images.unsplash.com/photo-1556228578-8c89e6adf883?auto=format&fit=crop&w=800&q=85',

        'colgate' =>
        'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?auto=format&fit=crop&w=800&q=85',

        'johnson' =>
        'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&w=800&q=85',

        'biscuit' =>
        'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?auto=format&fit=crop&w=800&q=85',
    );


    /*
     * =====================================================
     * FIND MATCH
     * =====================================================
     */

    foreach ($image_map as $keyword => $image_url) {

        if (
            strpos($product_name, $keyword) !== false
            || strpos($product_slug, $keyword) !== false
        ) {

            return $image_url;
        }
    }


    /*
     * =====================================================
     * DEFAULT IMAGE
     * =====================================================
     */

    return $default_image;
}

/* =========================================================
   FRESHCART
   MY ACCOUNT ADDRESSES ENDPOINT
   ========================================================= */

/**
 * Replace WooCommerce default edit-address endpoint output.
 *
 * Main address page:
 * /my-account/edit-address/
 *
 * Billing:
 * /my-account/edit-address/billing/
 *
 * Shipping:
 * /my-account/edit-address/shipping/
 */
function freshcart_account_edit_address_endpoint($value)
{

    /*
     * Main Addresses page.
     *
     * When endpoint has no value, show:
     * Billing Address + Shipping Address cards.
     */
    if (empty($value)) {

        wc_get_template(
            'myaccount/my-address.php',
            array(
                'customer' => WC()->customer,
            )
        );

        return;
    }


    /*
     * Billing / Shipping edit form.
     *
     * Example:
     * /edit-address/billing/
     * /edit-address/shipping/
     */
    $address_type = sanitize_key($value);

    if (in_array($address_type, array('billing', 'shipping'), true)) {

        WC_Shortcode_My_Account::edit_address(
            $address_type
        );

        return;
    }


    /*
     * Fallback.
     *
     * If an invalid endpoint value is passed,
     * show the main Addresses page.
     */
    wc_get_template(
        'myaccount/my-address.php',
        array(
            'customer' => WC()->customer,
        )
    );
}


/*
 * Remove WooCommerce's default edit-address handler.
 */
remove_action(
    'woocommerce_account_edit-address_endpoint',
    'woocommerce_account_edit_address',
    10
);


/*
 * Add FreshCart custom edit-address handler.
 */
add_action(
    'woocommerce_account_edit-address_endpoint',
    'freshcart_account_edit_address_endpoint',
    10
);

/* =========================================================
   FRESHCART CONTACT FORM
   EMAIL HANDLER
   ========================================================= */

function freshcart_handle_contact_form()
{

    /* =========================================
       SECURITY CHECK
       ========================================= */

    if (
        ! isset($_POST['freshcart_contact_nonce'])
        || ! wp_verify_nonce(
            sanitize_text_field(
                wp_unslash($_POST['freshcart_contact_nonce'])
            ),
            'freshcart_contact_form_action'
        )
    ) {

        wp_die(
            'Security verification failed. Please go back and try again.'
        );
    }


    /* =========================================
       GET FORM DATA
       ========================================= */

    $name = isset($_POST['name'])
        ? sanitize_text_field(
            wp_unslash($_POST['name'])
        )
        : '';

    $email = isset($_POST['email'])
        ? sanitize_email(
            wp_unslash($_POST['email'])
        )
        : '';

    $phone = isset($_POST['phone'])
        ? sanitize_text_field(
            wp_unslash($_POST['phone'])
        )
        : '';

    $subject = isset($_POST['subject'])
        ? sanitize_text_field(
            wp_unslash($_POST['subject'])
        )
        : '';

    $message = isset($_POST['message'])
        ? sanitize_textarea_field(
            wp_unslash($_POST['message'])
        )
        : '';


    /* =========================================
       REQUIRED FIELD VALIDATION
       ========================================= */

    if (
        empty($name)
        || empty($email)
        || empty($subject)
        || empty($message)
    ) {

        wp_die(
            'Please fill in all required fields.'
        );
    }


    /* =========================================
       EMAIL VALIDATION
       ========================================= */

    if (! is_email($email)) {

        wp_die(
            'Please enter a valid email address.'
        );
    }


    /* =========================================
       RECEIVER EMAIL
       ========================================= */

    $to = 'wadiletushar83@gmail.com';


    /* =========================================
       EMAIL SUBJECT
       ========================================= */

    $email_subject = 'FreshCart Contact Form - ' . $subject;


    /* =========================================
       EMAIL BODY
       ========================================= */

    $email_message = '';

    $email_message .= "FreshCart Contact Form\n";
    $email_message .= "======================\n\n";

    $email_message .= "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n";
    $email_message .= "Phone: " . $phone . "\n";
    $email_message .= "Subject: " . $subject . "\n\n";

    $email_message .= "Message:\n";
    $email_message .= $message . "\n\n";

    $email_message .= "======================\n";
    $email_message .= "Sent from FreshCart Contact Page";


    /* =========================================
       EMAIL HEADERS
       ========================================= */

    $headers = array();

    $headers[] = 'Content-Type: text/plain; charset=UTF-8';

    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';


    /* =========================================
       SEND EMAIL
       ========================================= */

    $sent = wp_mail(
        $to,
        $email_subject,
        $email_message,
        $headers
    );


    /* =========================================
       REDIRECT URL
       ========================================= */

    $redirect_url = wp_get_referer();

    if (! $redirect_url) {

        $redirect_url = home_url('/contact/');
    }


    /* =========================================
       SUCCESS
       ========================================= */

    if ($sent) {

        $redirect_url = add_query_arg(
            'contact_status',
            'success',
            $redirect_url
        );

        wp_safe_redirect($redirect_url);
        exit;
    }


    /* =========================================
       ERROR
       ========================================= */

    $redirect_url = add_query_arg(
        'contact_status',
        'error',
        $redirect_url
    );

    wp_safe_redirect($redirect_url);
    exit;
}


/* =========================================================
   LOGGED-IN USERS
   ========================================================= */

add_action(
    'admin_post_freshcart_contact_form',
    'freshcart_handle_contact_form'
);


/* =========================================================
   LOGGED-OUT USERS
   ========================================================= */

add_action(
    'admin_post_nopriv_freshcart_contact_form',
    'freshcart_handle_contact_form'
);
