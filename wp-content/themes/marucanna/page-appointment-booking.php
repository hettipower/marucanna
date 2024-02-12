<?php 
/* Template Name: Appointment Booking Page */

$patient = isset($_GET['patient']) ? $_GET['patient'] : false;
$booking = isset($_GET['booking']) ? $_GET['booking'] : false;

if( $patient && $booking ):

$patient_ID = get_field('patient_id' , $booking);
$patient_data = get_userdata($patient);
$patient_password = get_user_meta( $patient_data->ID, 'patient_password', true );
$patient_email = $patient_data->user_email;
$patient_name = get_field('name' , $booking);
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
                    <?php
                        $stage_2_content = get_field('stage_2_content');
                        $stage_3_content = get_field('stage_3_content');
                        $stage_4_content = get_field('stage_4_content');

                        if (class_exists('GFForms')) {
                            $form_id = 1;
                            $current_page = GFFormDisplay::get_current_page($form_id);

                            switch ($current_page) {
                                case '1':
                                    echo $stage_2_content;
                                    break;

                                case '2':
                                    echo $stage_3_content;
                                    break;
                                    
                                case '3':
                                    echo $stage_4_content;
                                    break;
                                
                                default:
                                    echo $stage_2_content;
                                    break;
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="col-12 col-md-7 form-wrapper" >
                <?php echo do_shortcode( '[gravityform id="1" title="false" field_values="patient='.$patient.'&booking='.$booking.'&patient_id='.$patient_ID.'&password='.$patient_password.'&patient_email='.$patient_email.'&patient_name='.$patient_name.'"]' ); ?>
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