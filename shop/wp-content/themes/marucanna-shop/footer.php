</div>
<div class="footer_top_wrapper">
    <div class="container">
        <div class="row">
            <div class="item col-md-4 col-12">
                <div class="logo"><i class="fas fa-shipping-fast"></i></div>
                <div class="content">
                    <h4>Free Shipping</h4>
                    <p>Free Shipping Over $50</p>
                </div>
            </div>
            <div class="item col-md-4 col-12">
                <div class="logo"><i class="fas fa-hands-helping"></i></div>
                <div class="content">
                    <h4>Customer Support</h4>
                    <p>Expert Customer Service</p>
                </div>
            </div>
            <div class="item col-md-4 col-12">
                <div class="logo"><i class="fas fa-award"></i></div>
                <div class="content">
                    <h4>100% Payment Secure</h4>
                    <p>We ensure secure payment</p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer_top_wrap">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <h6>QUICK LINKS</h6>
                            <?php 
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu-1',
                                    'items_wrap'      => '<ul class="nav flex-column mc-footer-menu two-column-list">%3$s</ul>',
                                    'container'       => '',
                                ));
                            ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <h6>CATEGORIES</h6>
                            <?php 
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu-2',
                                    'items_wrap'      => '<ul class="nav flex-column mc-footer-menu">%3$s</ul>',
                                    'container'       => '',
                                ));
                            ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <h6>USEFUL LINKS</h6>
                            <?php 
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu-3',
                                    'items_wrap'      => '<ul class="nav flex-column mc-footer-menu">%3$s</ul>',
                                    'container'       => '',
                                ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="newsletter mb-5">
                        <h6>SUBSCRIBE TO NEWSLETTER</h6>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <button class="btn" type="button">SIGN UP</button>
                            </div>
                        </form>
                    </div>

                    <div class="social">
                        <h6>FOLLOW US</h6>
                        <ul class="nav">
						    <?php if ( get_field( 'twitter','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('twitter','option'); ?>"><i class="fa-brands fa-twitter"></i></a>
                                </li>
							<?php endif; ?>
							<?php if ( get_field( 'linkedin','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('linkedin','option'); ?>"><i class="fa-brands fa-linkedin"></i></a>
                                </li>
							<?php endif; ?>
							<?php if ( get_field( 'youtube','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('youtube','option'); ?>"><i class="fa-brands fa-youtube"></i></a>
                                </li>
							<?php endif; ?>
							<?php if ( get_field( 'instagram','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('instagram','option'); ?>"><i class="fa-brands fa-instagram"></i></a>
                                </li>
							<?php endif; ?>
							<?php if ( get_field( 'facebook','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('facebook','option'); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
							<?php endif; ?>
							<?php if ( get_field( 'pinterest','option' ) ): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php the_field('pinterest','option'); ?>"><i class="fa-brands fa-pinterest"></i></a>
                                </li>
							<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom_wrap">
            <div class="row">
                <div class="col-md-2 col-sm-12">
				    <?php if ( get_field( 'footer_logo', 'option' ) ) { ?>
                        <img src="<?php the_field( 'footer_logo', 'option' ); ?>"/>
					<?php } else { ?>
					    <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo.webp"/>
					<?php } ?>
                </div>
                <div class="col-md-8 col-sm-12 pe-md-5">
				    <?php if ( get_field( 'copyright', 'option' ) ) { ?>
				        <p><small><?php the_field( 'copyright', 'option' ); ?></small></p>
				    <?php } else { ?>
                        <p><small>Marucanna.co.uk is a trading style of The Yardley Clinic, registered with the Care Quality Commission (CQC), and offers reasonably priced consultations and, in appropriate cases, will recommend our line of full-spectrum medical cannabis sourced in the UK.</small></p>
					<?php } ?>
                </div>
                <div class="col-md-2 col-sm-12 text-end">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo2.webp"/>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="mp-minicart-wrap">
    <a href="#" id="minicart-close"><i class="fas fa-times"></i></a>
    
    <div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>
</div>

<?php 
$enable_popup = get_field( 'enable_popup', 'option' ); 
$restricted_content = get_field( 'restricted_content', 'option' ); 
$restricted_link = get_field( 'restricted_link', 'option' ); 
?>
<?php if( $enable_popup == 'restricted_popup' ): ?>
    <div class="modal fade" id="restrictedPopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restrictedPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content"><?php echo $restricted_content; ?></div>
                    <div class="btn_wrap">
                        <a href="<?php echo $restricted_link['url']; ?>" target="<?php echo $restricted_link['target']; ?>" rel="noopener noreferrer" class="btn btn-no">No</a>
                        <button type="button" class="btn btn-yes" data-bs-dismiss="modal">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if( $enable_popup == 'subscribe_popup' ): ?>
    <div class="modal fade" id="subscribePopup" tabindex="-1" aria-labelledby="subscribePopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <?php echo do_shortcode('[gravityform id="2" title="false"]'); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>

<?php if( $enable_popup != 'disable' ): ?>
<script>
    var root = document.getElementsByTagName( 'html' )[0];
    <?php if( $enable_popup == 'restricted_popup' ): ?>
        var restrictedModalCookie = getCookie('restrictedModalClosed');
        var restrictedPopupEle = document.getElementById('restrictedPopup');
        
        document.addEventListener('DOMContentLoaded', function () {
            var restrictedPopup = new bootstrap.Modal(restrictedPopupEle);

            if( !restrictedModalCookie ) {
                restrictedPopup.show();
            }
        });

        restrictedPopupEle.addEventListener('shown.bs.modal', event => {
            root.classList.add('moda-open-html');
        });

        restrictedPopupEle.addEventListener('hidden.bs.modal', event => {
            root.classList.remove('moda-open-html');

            // Set a cookie to keep the modal closed for one month
            var date = new Date();
            date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 days in milliseconds
            var expires = "expires=" + date.toUTCString();
            document.cookie = "restrictedModalClosed=true;" + expires + ";path=/";
        });

    <?php endif; ?>

    <?php if( $enable_popup == 'subscribe_popup' ): ?>
        var subscribeModalCookie = getCookie('subscribeModalClosed');
        var subscribePopupEle = document.getElementById('subscribePopup');

        document.addEventListener('DOMContentLoaded', function () {
            var subscribePopup = new bootstrap.Modal(subscribePopupEle);

            if( !subscribeModalCookie ) {
                subscribePopup.show();
            }
        });

        subscribePopupEle.addEventListener('shown.bs.modal', event => {
            root.classList.add('moda-open-html');
        });

        subscribePopupEle.addEventListener('hidden.bs.modal', event => {
            root.classList.remove('moda-open-html');

            // Set a cookie to keep the modal closed for one month
            var date = new Date();
            date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 days in milliseconds
            var expires = "expires=" + date.toUTCString();
            document.cookie = "subscribeModalClosed=true;" + expires + ";path=/";
        });
    <?php endif; ?>
</script>
<?php endif; ?>

</body>
</html>