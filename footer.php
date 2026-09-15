<?php
/**
 * FreshCart Premium Footer
 */
?>

<footer class="site-footer">

    <div class="container">

        <div class="footer-main">

            <!-- =========================================
                 BRAND AREA
                 ========================================= -->

            <div class="footer-brand">

                <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo">
                    Fresh<span>Cart</span>
                </a>

                <p class="footer-description">
                    Fresh groceries, quality products and everyday essentials
                    delivered to your doorstep with convenience, freshness
                    and care.
                </p>

                <!-- Social Media -->

                <div class="footer-social">

                    <a
                        href="https://www.instagram.com/wadile_tushar_143/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Instagram"
                    >
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a
                        href="https://wa.me/919588668232"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="WhatsApp"
                    >
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a
                        href="#"
                        aria-label="Facebook"
                    >
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a
                        href="#"
                        aria-label="Twitter"
                    >
                        <i class="fab fa-twitter"></i>
                    </a>

                </div>

            </div>


            <!-- =========================================
                 QUICK LINKS
                 ========================================= -->

            <div class="footer-column">

                <h3>Quick Links</h3>

                <ul>

                    <li>
                        <a href="<?php echo esc_url( home_url('/') ); ?>">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url('/about-us/') ); ?>">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( wc_get_page_permalink('shop') ); ?>">
                            Shop
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url('/blog/') ); ?>">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url('/contact/') ); ?>">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <!-- =========================================
                 CUSTOMER SUPPORT
                 ========================================= -->

            <div class="footer-column">

                <h3>Customer Support</h3>

                <ul>

                    <li>
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                            My Cart
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                            Checkout
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>">
                            My Orders
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url('edit-account') ); ?>">
                            My Account
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url( home_url('/contact/') ); ?>">
                            Help &amp; Support
                        </a>
                    </li>

                </ul>

            </div>


            <!-- =========================================
                 CONTACT INFORMATION
                 ========================================= -->

            <div class="footer-column footer-contact">

                <h3>Contact Us</h3>


                <!-- Email -->

                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </span>

                    <div class="contact-details">

                        <small>Email</small>

                        <a href="mailto:wadiletushar83@gmail.com">
                            wadiletushar83@gmail.com
                        </a>

                    </div>

                </div>


                <!-- Phone -->

                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </span>

                    <div class="contact-details">

                        <small>Phone</small>

                        <a href="tel:+919588668232">
                            9588668232
                        </a>

                    </div>

                </div>


                <!-- WhatsApp -->

                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </span>

                    <div class="contact-details">

                        <small>WhatsApp</small>

                        <a
                            href="https://wa.me/919588668232"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Chat with us
                        </a>

                    </div>

                </div>


                <!-- Address -->

                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>

                    <div class="contact-details">

                        <small>Location</small>

                        <p>
                            Maharashtra, India
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================================
             FOOTER TRUST BAR
             ========================================= -->

        <div class="footer-trust-bar">

            <div class="trust-item">

                <span class="trust-icon">
                    <i class="fas fa-leaf"></i>
                </span>

                <div>
                    <strong>100% Fresh</strong>
                    <small>Quality Products</small>
                </div>

            </div>


            <div class="trust-item">

                <span class="trust-icon">
                    <i class="fas fa-truck"></i>
                </span>

                <div>
                    <strong>Fast Delivery</strong>
                    <small>At Your Doorstep</small>
                </div>

            </div>


            <div class="trust-item">

                <span class="trust-icon">
                    <i class="fas fa-shield-alt"></i>
                </span>

                <div>
                    <strong>Secure Shopping</strong>
                    <small>Safe &amp; Reliable</small>
                </div>

            </div>


            <div class="trust-item">

                <span class="trust-icon">
                    <i class="fas fa-headset"></i>
                </span>

                <div>
                    <strong>Easy Support</strong>
                    <small>We're Here To Help</small>
                </div>

            </div>

        </div>


        <!-- =========================================
             FOOTER BOTTOM
             ========================================= -->

        <div class="footer-bottom">

            <p>
                © <?php echo esc_html( date('Y') ); ?>
                <strong>FreshCart</strong>.
                All Rights Reserved.
            </p>

            <p class="developed-by">
                Designed &amp; Developed by
                <strong>Tushar Wadile</strong>
            </p>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>