<?php
/**
 * =========================================================
 * FRESHCART
 * PREMIUM RESPONSIVE HEADER
 * =========================================================
 */

defined( 'ABSPATH' ) || exit;


/* =========================================================
   BASIC URLS
   ========================================================= */

$home_url = home_url( '/' );

$shop_url    = home_url( '/shop/' );
$account_url = home_url( '/my-account/' );
$cart_url    = home_url( '/cart/' );


/* =========================================================
   WOOCOMMERCE URLS
   ========================================================= */

if ( function_exists( 'wc_get_page_permalink' ) ) {

    $shop_url    = wc_get_page_permalink( 'shop' );
    $account_url = wc_get_page_permalink( 'myaccount' );
}

if ( function_exists( 'wc_get_cart_url' ) ) {

    $cart_url = wc_get_cart_url();
}


/* =========================================================
   CART COUNT
   ========================================================= */

$cart_count = 0;

if ( function_exists( 'WC' ) && WC()->cart ) {

    $cart_count = WC()->cart->get_cart_contents_count();
}


/* =========================================================
   CUSTOM LOGO
   ========================================================= */

$custom_logo_id = get_theme_mod( 'custom_logo' );

$logo_url = '';

if ( $custom_logo_id ) {

    $logo_url = wp_get_attachment_image_url(
        $custom_logo_id,
        'full'
    );
}


/* =========================================================
   PRODUCT CATEGORIES
   ========================================================= */

$product_categories = array();

if ( taxonomy_exists( 'product_cat' ) ) {

    $product_categories = get_terms(
        array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'parent'     => 0,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )
    );
}


/* =========================================================
   WORDPRESS PRIMARY MENU
   ========================================================= */

$primary_menu_items = array();

$menu_locations = get_nav_menu_locations();

if ( ! empty( $menu_locations['primary'] ) ) {

    $primary_menu_items = wp_get_nav_menu_items(
        $menu_locations['primary']
    );
}


/* =========================================================
   TOP LEVEL MENU ITEMS ONLY
   ========================================================= */

$primary_top_level_items = array();

if ( ! empty( $primary_menu_items ) ) {

    foreach ( $primary_menu_items as $menu_item ) {

        if ( 0 === (int) $menu_item->menu_item_parent ) {

            $primary_top_level_items[] = $menu_item;
        }
    }
}


/* =========================================================
   CATEGORY ICON HELPER
   ========================================================= */

function freshcart_get_category_icon( $category_name ) {

    $category_name = strtolower( $category_name );

    if (
        strpos( $category_name, 'fruit' ) !== false ||
        strpos( $category_name, 'vegetable' ) !== false
    ) {
        return '🥦';
    }

    if (
        strpos( $category_name, 'dairy' ) !== false ||
        strpos( $category_name, 'milk' ) !== false ||
        strpos( $category_name, 'breakfast' ) !== false
    ) {
        return '🥛';
    }

    if (
        strpos( $category_name, 'snack' ) !== false ||
        strpos( $category_name, 'beverage' ) !== false
    ) {
        return '🍿';
    }

    if (
        strpos( $category_name, 'rice' ) !== false ||
        strpos( $category_name, 'atta' ) !== false ||
        strpos( $category_name, 'dal' ) !== false
    ) {
        return '🌾';
    }

    if (
        strpos( $category_name, 'oil' ) !== false ||
        strpos( $category_name, 'masala' ) !== false
    ) {
        return '🫙';
    }

    if ( strpos( $category_name, 'personal' ) !== false ) {
        return '🧴';
    }

    if ( strpos( $category_name, 'household' ) !== false ) {
        return '🧹';
    }

    if ( strpos( $category_name, 'baby' ) !== false ) {
        return '👶';
    }

    if (
        strpos( $category_name, 'bakery' ) !== false ||
        strpos( $category_name, 'bread' ) !== false
    ) {
        return '🍞';
    }

    return '🛍️';
}

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

<?php

if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}

?>


<!-- =========================================================
     TOP OFFER BAR
========================================================= -->

<div class="freshcart-topbar">

    <div class="freshcart-container">

        <div class="freshcart-topbar-content">

            <span class="freshcart-delivery-message">
                🚚 Free delivery on orders above ₹499
            </span>

            <span class="freshcart-topbar-right">
                Fresh groceries. Fast delivery. 💚
            </span>

        </div>

    </div>

</div>


<!-- =========================================================
     HEADER START
========================================================= -->

<header class="site-header">

    <div class="freshcart-container">


        <!-- =====================================================
             MAIN HEADER
        ===================================================== -->

        <div class="header-main">


            <!-- =================================================
                 MOBILE MENU
            ================================================= -->

            <button
                type="button"
                class="mobile-menu-toggle"
                id="freshcart-mobile-menu-toggle"
                aria-label="Open Menu"
                aria-expanded="false"
                aria-controls="freshcart-mobile-navigation"
            >

                <span></span>
                <span></span>
                <span></span>

            </button>


            <!-- =================================================
                 LOGO
            ================================================= -->

            <div class="site-branding">

                <a
                    href="<?php echo esc_url( $home_url ); ?>"
                    class="site-logo"
                    aria-label="FreshCart Home"
                >

                    <?php if ( $logo_url ) : ?>

                        <img
                            src="<?php echo esc_url( $logo_url ); ?>"
                            alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                        >

                    <?php else : ?>

                        <span class="freshcart-logo-icon">
                            🛒
                        </span>

                        <span class="freshcart-logo-text">
                            Fresh<span>Cart</span>
                        </span>

                    <?php endif; ?>

                </a>

            </div>


            <!-- =================================================
                 LOCATION
            ================================================= -->

            <button
                type="button"
                class="header-location"
                id="freshcart-location-trigger"
                aria-label="Choose delivery location"
                aria-haspopup="dialog"
                aria-expanded="false"
                aria-controls="freshcart-location-modal"
            >

                <span class="location-icon">
                    📍
                </span>

                <span class="location-content">

                    <span class="location-label">
                        Deliver to
                    </span>

                    <strong id="freshcart-location-text">
                        Your Location
                    </strong>

                </span>

                <span class="location-arrow">
                    ▾
                </span>

            </button>


            <!-- =================================================
                 SEARCH
            ================================================= -->

            <form
                class="header-search"
                role="search"
                method="get"
                action="<?php echo esc_url( $home_url ); ?>"
            >

                <span class="search-icon">
                    🔍
                </span>

                <input
                    type="search"
                    name="s"
                    value="<?php echo esc_attr( get_search_query() ); ?>"
                    placeholder="Search products..."
                    aria-label="Search products"
                    autocomplete="off"
                >

                <?php if ( class_exists( 'WooCommerce' ) ) : ?>

                    <input
                        type="hidden"
                        name="post_type"
                        value="product"
                    >

                <?php endif; ?>


                <button
                    type="submit"
                    class="header-search-button"
                    aria-label="Search"
                >

                    <i class="fas fa-magnifying-glass"></i>

                    <span>
                        Search
                    </span>

                </button>

            </form>


            <!-- =================================================
                 HEADER ACTIONS
            ================================================= -->

            <div class="header-actions">


                <!-- ACCOUNT -->

                <a
                    href="<?php echo esc_url( $account_url ); ?>"
                    class="header-action account-action"
                >

                    <span class="action-icon">
                        👤
                    </span>

                    <span class="action-text">

                        <small>
                            Hello,
                        </small>

                        <strong>
                            Account
                        </strong>

                    </span>

                </a>


                <!-- CART -->

                <a
                    href="<?php echo esc_url( $cart_url ); ?>"
                    class="header-action cart-action"
                >

                    <span class="cart-icon-wrap">

                        <span class="action-icon">
                            🛒
                        </span>

                        <span class="cart-count">
                            <?php echo esc_html( $cart_count ); ?>
                        </span>

                    </span>

                    <span class="action-text">

                        <small>
                            Your
                        </small>

                        <strong>
                            Cart
                        </strong>

                    </span>

                </a>

            </div>

        </div>


        <!-- =====================================================
             DESKTOP NAVIGATION
        ===================================================== -->

        <nav
            class="main-navigation"
            id="freshcart-desktop-navigation"
            aria-label="Primary Navigation"
        >

            <div class="nav-menu-wrapper">


                <!-- =================================================
                     CATEGORIES
                ================================================= -->

                <div class="nav-categories">

                    <button
                        type="button"
                        class="nav-menu-label categories-toggle"
                        id="freshcart-categories-toggle"
                        aria-expanded="false"
                        aria-controls="freshcart-categories-dropdown"
                    >

                        <span class="nav-menu-icon">
                            ☰
                        </span>

                        <span>
                            Categories
                        </span>

                        <span class="categories-arrow">
                            ▾
                        </span>

                    </button>


                    <!-- CATEGORY DROPDOWN -->

                    <div
                        class="categories-dropdown"
                        id="freshcart-categories-dropdown"
                    >

                        <div class="categories-dropdown-header">

                            <strong>
                                Shop by Category
                            </strong>

                            <a href="<?php echo esc_url( $shop_url ); ?>">
                                View All
                            </a>

                        </div>


                        <?php if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) : ?>

                            <ul class="categories-dropdown-list">

                                <?php foreach ( $product_categories as $category ) : ?>

                                    <?php
                                    $category_icon = freshcart_get_category_icon(
                                        $category->name
                                    );
                                    ?>

                                    <li>

                                        <a
                                            href="<?php echo esc_url( get_term_link( $category ) ); ?>"
                                        >

                                            <span class="category-dropdown-icon">
                                                <?php echo esc_html( $category_icon ); ?>
                                            </span>

                                            <span class="category-dropdown-name">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>

                                            <span class="category-dropdown-arrow">
                                                →
                                            </span>

                                        </a>

                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        <?php else : ?>

                            <div class="no-categories">
                                No product categories found.
                            </div>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- =================================================
                     WORDPRESS MENU
                ================================================= -->

                <?php if ( ! empty( $primary_top_level_items ) ) : ?>

                    <ul class="primary-menu">

                        <?php foreach ( $primary_top_level_items as $menu_item ) : ?>

                            <?php

                            $menu_title = strtolower(
                                trim(
                                    wp_strip_all_tags(
                                        $menu_item->title
                                    )
                                )
                            );

                            if ( 'categories' === $menu_title ) {
                                continue;
                            }

                            ?>

                            <li
                                class="<?php echo esc_attr(
                                    implode(
                                        ' ',
                                        $menu_item->classes
                                    )
                                ); ?>"
                            >

                                <a
                                    href="<?php echo esc_url( $menu_item->url ); ?>"
                                    <?php
                                    if ( ! empty( $menu_item->target ) ) {
                                        echo ' target="' . esc_attr( $menu_item->target ) . '"';
                                    }

                                    if ( ! empty( $menu_item->xfn ) ) {
                                        echo ' rel="' . esc_attr( $menu_item->xfn ) . '"';
                                    }
                                    ?>
                                >

                                    <?php echo esc_html( $menu_item->title ); ?>

                                </a>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php else : ?>

                    <ul class="primary-menu">

                        <li>
                            <a href="<?php echo esc_url( $home_url ); ?>">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url( $shop_url ); ?>">
                                Shop
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>">
                                Offers
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">
                                About Us
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                                Contact
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
                                Blog
                            </a>
                        </li>

                    </ul>

                <?php endif; ?>


                <!-- DELIVERY INFO -->

                <div class="nav-right">

                    <span>
                        ⚡
                    </span>

                    <strong>
                        10 Min Delivery
                    </strong>

                </div>

            </div>

        </nav>


        <!-- =====================================================
             MOBILE NAVIGATION
        ===================================================== -->

        <nav
            class="mobile-navigation"
            id="freshcart-mobile-navigation"
            aria-label="Mobile Navigation"
        >

            <div class="mobile-nav-header">

                <strong>
                    FreshCart Menu
                </strong>

                <button
                    type="button"
                    class="mobile-menu-close"
                    id="freshcart-mobile-menu-close"
                    aria-label="Close Menu"
                >
                    ×
                </button>

            </div>


            <ul class="mobile-menu">


                <?php if ( ! empty( $primary_top_level_items ) ) : ?>

                    <?php foreach ( $primary_top_level_items as $menu_item ) : ?>

                        <?php

                        $menu_title = strtolower(
                            trim(
                                wp_strip_all_tags(
                                    $menu_item->title
                                )
                            )
                        );

                        if ( 'categories' === $menu_title ) {
                            continue;
                        }

                        $mobile_icon = '📌';

                        if ( 'home' === $menu_title ) {
                            $mobile_icon = '🏠';
                        } elseif ( 'shop' === $menu_title ) {
                            $mobile_icon = '🛍️';
                        } elseif ( 'offers' === $menu_title ) {
                            $mobile_icon = '🎁';
                        } elseif ( 'about us' === $menu_title ) {
                            $mobile_icon = 'ℹ️';
                        } elseif ( 'contact' === $menu_title ) {
                            $mobile_icon = '📞';
                        } elseif ( 'blog' === $menu_title ) {
                            $mobile_icon = '📝';
                        }

                        ?>

                        <li>

                            <a href="<?php echo esc_url( $menu_item->url ); ?>">

                                <span class="mobile-menu-icon">
                                    <?php echo esc_html( $mobile_icon ); ?>
                                </span>

                                <span>
                                    <?php echo esc_html( $menu_item->title ); ?>
                                </span>

                            </a>

                        </li>

                    <?php endforeach; ?>

                <?php else : ?>

                    <li>
                        <a href="<?php echo esc_url( $home_url ); ?>">
                            <span class="mobile-menu-icon">🏠</span>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( $shop_url ); ?>">
                            <span class="mobile-menu-icon">🛍️</span>
                            <span>Shop</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>">
                            <span class="mobile-menu-icon">🎁</span>
                            <span>Offers</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">
                            <span class="mobile-menu-icon">ℹ️</span>
                            <span>About Us</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                            <span class="mobile-menu-icon">📞</span>
                            <span>Contact</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">
                            <span class="mobile-menu-icon">📝</span>
                            <span>Blog</span>
                        </a>
                    </li>

                <?php endif; ?>


                <!-- MOBILE CATEGORIES -->

                <li class="mobile-categories-item">

                    <button
                        type="button"
                        class="mobile-categories-toggle"
                        id="freshcart-mobile-categories-toggle"
                        aria-expanded="false"
                        aria-controls="freshcart-mobile-categories-dropdown"
                    >

                        <span class="mobile-category-title">

                            <span class="mobile-menu-icon">
                                🥬
                            </span>

                            <span>
                                Categories
                            </span>

                        </span>

                        <span class="mobile-category-arrow">
                            ▾
                        </span>

                    </button>


                    <div
                        class="mobile-categories-dropdown"
                        id="freshcart-mobile-categories-dropdown"
                    >

                        <?php if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) : ?>

                            <?php foreach ( $product_categories as $category ) : ?>

                                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">

                                    <span>
                                        <?php
                                        echo esc_html(
                                            freshcart_get_category_icon(
                                                $category->name
                                            )
                                        );
                                        ?>
                                    </span>

                                    <span>
                                        <?php echo esc_html( $category->name ); ?>
                                    </span>

                                </a>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <span class="mobile-no-categories">
                                No product categories found.
                            </span>

                        <?php endif; ?>

                    </div>

                </li>


                <!-- ACCOUNT -->

                <li>

                    <a href="<?php echo esc_url( $account_url ); ?>">

                        <span class="mobile-menu-icon">
                            👤
                        </span>

                        <span>
                            My Account
                        </span>

                    </a>

                </li>


                <!-- CART -->

                <li>

                    <a href="<?php echo esc_url( $cart_url ); ?>">

                        <span class="mobile-menu-icon">
                            🛒
                        </span>

                        <span>
                            Cart
                        </span>

                        <span class="mobile-cart-count">
                            <?php echo esc_html( $cart_count ); ?>
                        </span>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</header>


<style>
/* =========================================================
   FRESHCART DELIVERY LOCATION
   Header-only location component
========================================================= */
.header-location {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 7px 10px;
    border: 0;
    background: transparent;
    color: inherit;
    cursor: pointer;
    text-align: left;
    border-radius: 10px;
    transition: background-color 0.2s ease;
}
.header-location:hover { background: #f0faf4; }
.freshcart-location-modal {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
}
.freshcart-location-modal.is-open {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
}
.freshcart-location-overlay {
    position: absolute;
    inset: 0;
    background: rgba(5,20,12,.55);
    backdrop-filter: blur(4px);
}
.freshcart-location-dialog {
    position: relative;
    z-index: 2;
    width: min(460px,100%);
    padding: 28px;
    border: 1px solid #e1ebe5;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 25px 70px rgba(0,0,0,.18);
    box-sizing: border-box;
    animation: freshcartLocationIn .22s ease;
}
@keyframes freshcartLocationIn {
    from { opacity:0; transform:translateY(12px) scale(.98); }
    to { opacity:1; transform:translateY(0) scale(1); }
}
.freshcart-location-dialog-header {
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:20px;
}
.freshcart-location-small-label {
    display:block;
    margin-bottom:5px;
    color:#079447;
    font-size:12px;
    font-weight:700;
    letter-spacing:.3px;
    text-transform:uppercase;
}
.freshcart-location-dialog h2 {
    margin:0;
    color:#071a35;
    font-size:25px;
    font-weight:800;
    line-height:1.2;
}
.freshcart-location-close {
    display:flex;
    align-items:center;
    justify-content:center;
    width:36px;
    height:36px;
    flex:0 0 36px;
    border:1px solid #e3e9e5;
    border-radius:50%;
    background:#f7faf8;
    color:#26352d;
    font-size:24px;
    line-height:1;
    cursor:pointer;
    transition:.2s ease;
}
.freshcart-location-close:hover {
    border-color:#079447;
    background:#eaf8ef;
    color:#079447;
}
.freshcart-location-description {
    margin:16px 0 20px;
    color:#68766e;
    font-size:14px;
    line-height:1.6;
}
.freshcart-location-input-wrap {
    display:flex;
    align-items:center;
    gap:10px;
    min-height:52px;
    padding:0 15px;
    border:1px solid #d9e4dd;
    border-radius:12px;
    background:#fff;
    box-sizing:border-box;
    transition:.2s ease;
}
.freshcart-location-input-wrap:focus-within {
    border-color:#079447;
    box-shadow:0 0 0 3px rgba(7,148,71,.08);
}
.freshcart-location-input-wrap > span { font-size:18px; }
.freshcart-location-input-wrap input {
    width:100%;
    min-width:0;
    border:0;
    outline:0;
    background:transparent;
    color:#16231c;
    font-size:14px;
}
.freshcart-location-save {
    width:100%;
    min-height:50px;
    margin-top:14px;
    border:0;
    border-radius:12px;
    background:#079447;
    color:#fff;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
    transition:.2s ease;
}
.freshcart-location-save:hover {
    background:#067c3b;
    transform:translateY(-1px);
}
.freshcart-location-divider {
    display:flex;
    align-items:center;
    gap:12px;
    margin:22px 0;
}
.freshcart-location-divider span {
    flex:1;
    height:1px;
    background:#e6ece8;
}
.freshcart-location-divider strong {
    color:#8a968f;
    font-size:11px;
}
.freshcart-current-location {
    display:flex;
    align-items:center;
    justify-content:center;
    gap:9px;
    width:100%;
    min-height:48px;
    border:1px solid #b9dec7;
    border-radius:12px;
    background:#f0faf4;
    color:#087f3b;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    transition:.2s ease;
}
.freshcart-current-location:hover {
    border-color:#079447;
    background:#e5f7ec;
}
.freshcart-location-status {
    min-height:18px;
    margin:12px 0 0;
    color:#079447;
    font-size:12px;
    font-weight:600;
    text-align:center;
}
.freshcart-location-status.is-error { color:#d14343; }
.freshcart-location-status.is-success { color:#079447; }
body.freshcart-location-open { overflow:hidden; }
@media (max-width:767px) {
    .freshcart-location-modal.is-open { padding:16px; }
    .freshcart-location-dialog { padding:22px 18px; border-radius:18px; }
    .freshcart-location-dialog h2 { font-size:22px; }
    .freshcart-location-description { font-size:13px; }
    .freshcart-location-input-wrap { min-height:50px; }
}
</style>


<!-- =========================================================
     FRESHCART LOCATION MODAL
========================================================= -->

<div
    class="freshcart-location-modal"
    id="freshcart-location-modal"
    aria-hidden="true"
>

    <div class="freshcart-location-overlay"></div>

    <div
        class="freshcart-location-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="freshcart-location-title"
    >

        <div class="freshcart-location-dialog-header">

            <div>

                <span class="freshcart-location-small-label">
                    FreshCart Delivery
                </span>

                <h2 id="freshcart-location-title">
                    Choose your location
                </h2>

            </div>

            <button
                type="button"
                class="freshcart-location-close"
                id="freshcart-location-close"
                aria-label="Close location popup"
            >
                ×
            </button>

        </div>

        <p class="freshcart-location-description">
            Enter your area, city or pincode to set your delivery location.
        </p>

        <div class="freshcart-location-input-wrap">

            <span>📍</span>

            <input
                type="text"
                id="freshcart-location-input"
                placeholder="Enter area, city or pincode"
                maxlength="80"
                autocomplete="postal-code"
            >

        </div>

        <button
            type="button"
            class="freshcart-location-save"
            id="freshcart-location-save"
        >
            Save Location
        </button>

        <div class="freshcart-location-divider">
            <span></span>
            <strong>OR</strong>
            <span></span>
        </div>

        <button
            type="button"
            class="freshcart-current-location"
            id="freshcart-current-location"
        >
            <span class="current-location-icon">📍</span>
            <span>Use my current location</span>
        </button>

        <p
            class="freshcart-location-status"
            id="freshcart-location-status"
            aria-live="polite"
        ></p>

    </div>

</div>


