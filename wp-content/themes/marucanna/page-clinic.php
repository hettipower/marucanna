<?php 
/* Template Name: Clinic Page */

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

<section class="section clinic_wrapper bg_gray">
    <div class="container">

        <div class="row">
            
            <div class="col-md-6 col-sm-12 image_wrapper">
                <img class="img-fluid rounded" src="<?php echo get_template_directory_uri(); ?>/img/clinic.webp"/>
            </div>
            
            <div class="col-md-6 col-sm-12 content_wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/img/clinic-logo.webp" class="mb-3"/>
                <p>The Yardley Dental & Medical Clinic in Birmingham is a state-of-the-art clinic with resident expert doctors and dentists that offer a range of treatments to the local community.</p>
                <p>Our philosophy is built on providing the world's best health care, uniquely tailored to the individual.</p>
                <p>The dental clinic provides world-class dental care for you and the family - whether you need a general check-up or a complete smile makeover, speak with one of our dentists to receive a tailored treatment plan and price breakdown.</p>
            </div>
        </div>

        <div class="title-wrap text-center mt-5">
            <h3>More Clinics We <span>Work With</span></h3>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et </p>
        </div>

        <div class="row mt-4 clinics">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="clinic-inner">
                    <a href="#" class="overlay"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/clinic1.webp"/>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="clinic-inner">
                    <a href="#" class="overlay"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/clinic2.webp"/>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="clinic-inner">
                    <a href="#" class="overlay"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/clinic3.webp"/>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="clinic-inner">
                    <a href="#" class="overlay"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/clinic4.webp"/>
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