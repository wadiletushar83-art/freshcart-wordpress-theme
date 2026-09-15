<?php

/**
 * =========================================
 * FRESHCART
 * HOME PAGE
 * =========================================
 */

get_header();

?>

<main class="site-main">


     <!-- =====================================
         HERO
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/hero'
     );
     ?>


     <!-- =====================================
         CATEGORIES
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/categories'
     );
     ?>


     <!-- =====================================
         OFFERS
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/offers'
     );
     ?>


     <!-- =====================================
         FEATURED PRODUCTS
         ===================================== -->
     <?php
     get_template_part(
          'template-parts/home/featured-products'
     );
     ?>

     <!-- =====================================
         POPULAR PRODUCTS
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/popular-products'
     );
     ?>


     <!-- =====================================
         DELIVERY BANNER
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/delivery-banner'
     );
     ?>


     <!-- =====================================
         WHY CHOOSE US
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/why-choose-us'
     );
     ?>


     <!-- =====================================
         TESTIMONIALS
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/testimonials'
     );
     ?>


     <!-- =====================================
         BLOG
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/blog'
     );
     ?>


     <!-- =====================================
         NEWSLETTER
         ===================================== -->

     <?php
     get_template_part(
          'template-parts/home/newsletter'
     );
     ?>


</main>

<?php

get_footer();

?>