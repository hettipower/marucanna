<?php 
/* Template Name: Consultant Form Page */

get_header(); 

$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : false;
$patient = isset($_GET['patient']) ? $_GET['patient'] : false;

if( $patient && $patient_id ):
    $name = get_field('name' , $patient);
    $dob = get_field('dob' , $patient);
    $phone = get_field('phone' , $patient);
    $address_line_1 = get_field('address_line_1' , $patient);
    $address_line_2 = get_field('address_line_2' , $patient);

    echo $patient;
?>

<section class="section mc-title-section style_1" style="<?php if ( get_field( 'header_backgorund_image' ) ) { ?>background-image: url(<?php the_field( 'header_backgorund_image' ); ?>);<?php } else { ?> background-image: url(<?php bloginfo( 'template_url' ); ?>/img/single-banner.webp);  <?php } ?>">
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
            <?php echo do_shortcode( '[gravityform id="2" title="false" field_values="patient_id='.$patient_id.'&patient='.$patient.'&name='.$name.'&dob='.$dob.'&phone='.$phone.'&address_line_1='.$address_line_1.'&address_line_2='.$address_line_2.'"]' ); ?>
        </div>
    
    </div>
</section>

<script>
jQuery(document).ready(function($) {

    var readOnlyField1 = $("#input_2_52");

    // Make the field read-only
    readOnlyField1.prop('readonly', true);
});
</script>

<?php get_footer(); ?>

<?php
else:
    wp_redirect( home_url() );
    die();
endif;
?>