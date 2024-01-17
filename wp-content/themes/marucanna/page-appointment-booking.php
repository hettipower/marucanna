<?php 
/* Template Name: Appointment Booking Page */

$patient = isset($_GET['patient']) ? $_GET['patient'] : false;
$booking = isset($_GET['booking']) ? $_GET['booking'] : false;

if( $patient && $booking ):

$patient_ID = get_field('patient_id' , $booking);
$password = get_user_meta( $patient, 'patient_password', true );

?>

<?php get_header(); ?>

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

        <div class="row rounded-3 border">
            <div class="box-content-wrap col-12 col-md-5">
                <div class="box_content">
                    <h3>Appointment Booking</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis erat eget ligula porta ornare. Fusce nec odio non eros tincidunt lobortis. Sed vitae congue urna.</p>
                    <p>Integer id turpis nec nibh lobortis pellentesque. Aliquam luctus porta lorem a bibendum. Vestibulum mollis, lacus sit amet tincidunt ullamcorper, turpis metus eleifend quam, sit amet condimentum orci ligula non orci.</p>
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper" >
                <?php echo do_shortcode( '[gravityform id="1" title="false" field_values="patient='.$patient.'&booking='.$booking.'&patient_id='.$patient_ID.'&password='.$password.'"]' ); ?>
            </div>

        </div>
    
    </div>
</section>
<script>
jQuery(document).ready(function($) {

    var readOnlyField1 = $("#input_1_78");
    var readOnlyField2 = $("#input_1_79");

    // Make the field read-only
    readOnlyField1.prop('readonly', true);
    readOnlyField2.prop('readonly', true);
});
</script>

<?php get_footer(); ?>

<?php 
else:
    wp_redirect( home_url() );
    die();
endif;
?>