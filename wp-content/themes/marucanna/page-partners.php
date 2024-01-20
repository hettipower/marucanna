<?php 
/* Template Name: Partners Page */

get_header(); ?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
    <div class="container">
	
	<?php if ( get_field( 'page_title' ) ) { ?>
	<h1><?php the_field( 'page_title' ); ?></h1>
	<?php } else { ?>
		<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>   
        <h1><?php the_title(); ?></h1>
		<?php endwhile; ?>
<?php endif; ?>
		<?php }  ?>
    </div>
</section>

<section class="section breadcrumb_wrap bg_gray">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
		    <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section partners_wrapper bg_gray">
    <div class="container">
        <div class="title-wrap text-center">
            <h2>People We <span>Work With</span></h2>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,</p>
        </div>

        <div class="row partners">
            <div class="col-md-4 col-12 icon-box">
                <div class="icon-box-inner">
                    <div class="icon">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon1.webp" alt="">
                    </div>
                    <div class="content">
                        <h3>Clinics </h3>
                        <p>Clinics prescribing medical cannabis to patients who have exhausted traditional methods of treatment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 icon-box">
                <div class="icon-box-inner">
                    <div class="icon">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon2.webp" alt="">
                    </div>
                    <div class="content">
                        <h3>Pharmacies</h3>
                        <p>Community pharmacies that are working with us to dispense medical cannabis treatment to patients</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 icon-box">
                <div class="icon-box-inner">
                    <div class="icon">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon3.webp" alt="">
                    </div>
                    <div class="content">
                        <h3>Research</h3>
                        <p>A partnership to help support the growing evidence for medical cannabis treatment</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<section class="section eligibility_wrap partnership_wrap">
    <div class="container">

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3>Join our Partnership Scheme to deliver the future of Medical Cannabis</h3>
                    <p>LLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, </p>
                    <p>ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper"><?php echo do_shortcode('[gravityform id="3" title="false"]'); ?></div>
        </div>
    
    </div>
</section>

<?php get_footer(); ?>