</div>
<footer style="<?php if ( get_field( 'footer_bg', 'option' ) ) { ?>background-image: url(<?php the_field( 'footer_bg', 'option' ); ?>);<?php } else { ?> background-image: url(<?php echo get_template_directory_uri(); ?>/img/home/footer-bg.webp);<?php } ?> ">
    <div class="container">
        <div class="footer_top_wrap">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <address>
							<?php the_field( 'address', 'option' ); ?>
                           
                            </address>
                            <p><?php the_field( 'business_hours', 'option' ); ?></p>
                            <p>T: <a href="tel:<?php the_field( 'phone', 'option' ); ?>"><?php the_field( 'phone', 'option' ); ?></a><br/>E: <a href="mailto:<?php the_field( 'email', 'option' ); ?>"><?php the_field( 'email', 'option' ); ?></a></p>
                        </div>

                        <div class="col-md-4 col-sm-12">
						
			<?php 

                 wp_nav_menu( array(

            'theme_location' => 'footer-menu-1', 

           'items_wrap'      => '<ul class="nav flex-column mc-footer-menu">%3$s</ul>',
		   
	   'container'       => '',

            ));

          

            ?>
						
						
                           
                        </div>

                        <div class="col-md-4 col-sm-12">
						<?php 

                 wp_nav_menu( array(

            'theme_location' => 'footer-menu-2', 

           'items_wrap'      => '<ul class="nav flex-column mc-footer-menu">%3$s</ul>',
		   
	   'container'       => '',

            ));

          

            ?>
						
	
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="newsletter">
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
                <div class="col-md-8 col-sm-12">
				<?php if ( get_field( 'footer_logo', 'option' ) ) { ?>
				<p><small><?php the_field( 'copyright', 'option' ); ?></small></p>
				<?php } else { ?>
                    <p><small>Marucanna.co.uk is a trading style of The Yardley Clinic, registered with the Care Quality Commission (CQC), and offers reasonably priced consultations and, in appropriate cases, will recommend our line of full-spectrum medical cannabis sourced in the UK.</small></p>
					<?php } ?>
                </div>
                <div class="col-md-2 col-sm-12">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/footer-logo2.webp"/>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Include the SVG with the clipPath definition -->
<div class="clipparths">
    <svg width="0" height="0" xmlns="http://www.w3.org/2000/svg">
        <defs>
        <clipPath id="ellipse">
            <path d="M 134.5,-0.5 C 146.167,-0.5 157.833,-0.5 169.5,-0.5C 228.663,7.65772 277.163,34.6577 315,80.5C 333.398,104.959 344.898,132.293 349.5,162.5C 349.5,174.833 349.5,187.167 349.5,199.5C 337.886,273.95 296.219,322.783 224.5,346C 215.404,348.052 206.404,349.885 197.5,351.5C 185.833,351.5 174.167,351.5 162.5,351.5C 119.274,344.466 83.1075,324.466 54,291.5C 24.8136,258.793 6.64689,220.793 -0.5,177.5C -0.5,164.167 -0.5,150.833 -0.5,137.5C 12.1902,59.8106 57.1902,13.8106 134.5,-0.5 Z" />
        </clipPath>
        </defs>
    </svg>
</div>
<?php wp_footer(); ?>
<script>
jQuery( ".mc-blog-text p" ).addClass( "card-text" );
jQuery( ".mc-footer-menu li" ).addClass( "nav-item" );
jQuery( ".mc-footer-menu a" ).addClass( "nav-link" );
</script>
</body>
</html>