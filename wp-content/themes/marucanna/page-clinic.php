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
			<?php $cl_sec1_main_image = get_field( 'cl_sec1_main_image' ); ?>
			<?php if ( $cl_sec1_main_image ) { ?>
            <div class="col-md-6 col-sm-12 image_wrapper">
                	<img src="<?php echo $cl_sec1_main_image['url']; ?>" alt="<?php echo $cl_sec1_main_image['alt']; ?>" title="<?php echo $cl_sec1_main_image['title']; ?>" />
            </div>
            <?php } ?>
            <div class="col-md-6 col-sm-12 content_wrapper">
				<?php $cl_sec1_logo = get_field( 'cl_sec1_logo' ); ?>
				<?php if ( $cl_sec1_logo ) { ?>
                <img src="<?php echo $cl_sec1_logo['url']; ?>" alt="<?php echo $cl_sec1_logo['alt']; ?>" title="<?php echo $cl_sec1_main_image['title']; ?>" class="mb-3"/>
				<?php } ?>
				<?php the_field( 'cl_sec1_content' ); ?>
              
            </div>
        </div>

        <div class="title-wrap text-center mt-5">
            <h3><?php echo do_shortcode(get_field('cl_sec2_title')); ?></h3>
			<?php the_field( 'cl_sec2_content' ); ?>

			
        </div>

        <div class="row mt-4 clinics">
			<?php if ( have_rows( 'clinics_rep' ) ) : ?>
	<?php while ( have_rows( 'clinics_rep' ) ) : the_row(); ?>
		<?php $logo = get_sub_field( 'logo' ); ?>
			<?php if ( $logo ) { ?>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="clinic-inner">
                    <a href="<?php the_sub_field( 'link' ); ?>" class="overlay"></a>
                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" title="<?php echo $logo['title']; ?>" />
                </div>
            </div>
			<?php } ?>
           <?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
           
          
        </div>

    </div>
</section>

<section class="section eligibility_wrap partnership_wrap">
    <div class="container">

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3><?php the_field( 'pt_form_box_title' ); ?></h3>
					<?php the_field( 'pt_form_box_content' ); ?>
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper"><?php echo do_shortcode('[gravityform id="3" title="false"]'); ?></div>
        </div>
        
    </div>
</section>

<?php get_template_part( 'template-part/related', 'articles' ); ?>

<?php get_footer(); ?>