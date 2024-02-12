<?php 
/* Template Name: Patient Consent Page */

get_header();

$patient = (isset($_GET['patient'])) ? $_GET['patient'] : false;
$patient_post = (isset($_GET['patient_post'])) ? $_GET['patient_post'] : false;

if ($patient && $patient_post):
    $full_name = get_field('name' , $patient_post);
    $current_date = date('m/d/Y');
?>

<section class="section mc-title-section style_1" style=" <?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);<?php } ?>">
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

<section class="section breadcrumb_wrap">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '->';" aria-label="breadcrumb">
           <?php the_breadcrumb(); ?> 
        </nav>
    </div>
</section>

<section class="section eligibility_wrap">
    <div class="container">

        <div class="form-wrapper" >
            <?php echo do_shortcode( '[gravityform id="11" title="false" field_values="patient='.$patient.'&patient_post='.$patient_post.'&full_name='.$full_name.'&current_date='.$current_date.'"]' ); ?>
        </div>
    
    </div>
</section>

<?php get_footer(); ?>

<?php
else:
    wp_redirect( home_url() );
    die();
endif;