<?php 
/* Template Name: Patient Dashboard */

get_header(); 

if (is_user_logged_in()):
    $user = wp_get_current_user();
    $allowed_roles = array( 'patient', 'administrator' );
    if ( array_intersect( $allowed_roles, $user->roles ) ) :
        //$user_id = $user->ID;
        $user_id = 3;
        $patient_post_id = get_user_meta( $user_id, 'patient_info', true );
        $patient_password = get_user_meta( $user_id, 'patient_password', true );
        $photo_id = get_field('photo_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $name = get_field('name' , $patient_post_id);
        $email = get_field('email' , $patient_post_id);
        $phone = get_field('phone' , $patient_post_id);
        $gender = get_field('gender' , $patient_post_id);
        $address_line_1 = get_field('address_line_1' , $patient_post_id);
        $address_line_2 = get_field('address_line_2' , $patient_post_id);
        $town = get_field('town' , $patient_post_id);
        $country = get_field('country' , $patient_post_id);
        $postcode = get_field('postcode' , $patient_post_id);
        $dob = get_field('dob' , $patient_post_id);

        $treatment = get_field('treatment' , $patient_post_id);
        $additional_notes = get_field('additional_notes' , $patient_post_id);
        $medical_history_1 = get_field('medical_history_1' , $patient_post_id);
        $medical_history_2 = get_field('medical_history_2' , $patient_post_id);
        $medical_history_3 = get_field('medical_history_3' , $patient_post_id);
        $medical_history_4 = get_field('medical_history_4' , $patient_post_id);
        $current_medical_condition_1 = get_field('current_medical_condition_1' , $patient_post_id);
        $current_medical_condition_2 = get_field('current_medical_condition_2' , $patient_post_id);
        $current_medical_condition_3 = get_field('current_medical_condition_3' , $patient_post_id);

        $referred_clinic = get_field('referred_clinic' , $patient_post_id);
        $clinic_name = get_field('clinic_name' , $patient_post_id);
        $clinic_postcode = get_field('clinic_postcode' , $patient_post_id);
        $clinic_phone_number = get_field('clinic_phone_number' , $patient_post_id);
        $gp_name = get_field('gp_name' , $patient_post_id);
        $practice_name = get_field('practice_name' , $patient_post_id);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient_post_id);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient_post_id);
        $gp_town = get_field('gp_town' , $patient_post_id);
        $gp_country = get_field('gp_country' , $patient_post_id);
        $gp_postal_code = get_field('gp_postal_code' , $patient_post_id);
        $gp_phone = get_field('gp_phone' , $patient_post_id);
        $csr_file = get_field('csr_file' , $patient_post_id);

        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
        $patient_id = get_field('patient_id' , $patient_post_id);
?>

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

<section class="section dashboard_wrapper bg_gray">
    <div class="container">
        
        <div class="row profile-detail-wrap rounded mb-3">
            <div class="col-12 col-sm-3 profile-pic">
                <?php if( isImageUrl($photo_id) ): ?>
                    <img src="<?php echo $photo_id; ?>" class="img-fluid rounded" alt="">
                <?php else: ?>
                    <img src="<?php bloginfo( 'template_url' ); ?>/img/profile-pic.webp" class="img-fluid rounded" alt="">
                <?php endif; ?>
            </div>
            <div class="col-12 col-sm-9 profile-detail">
                <div class="row">
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Patient ID</div>
                        <div class="value"><?php echo $patient_id; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Patient Password</div>
                        <div class="value"><?php echo $patient_password; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Full Name</div>
                        <div class="value"><?php echo $name; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Email</div>
                        <div class="value"><?php echo $email; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Phone</div>
                        <div class="value"><?php echo $phone; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Gender</div>
                        <div class="value"><?php echo $gender; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Address</div>
                        <div class="value"><?php echo $address_line_1 . '<br/>' . $address_line_2; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Town</div>
                        <div class="value"><?php echo $town; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Country</div>
                        <div class="value"><?php echo $country; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Postcode</div>
                        <div class="value"><?php echo $postcode; ?></div>
                    </div>
                    <div class="col-12 col-md-4 profile-item">
                        <div class="label">Date of Birth</div>
                        <div class="value"><?php echo $dob; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row profile-detail-wrap rounded mb-3">
            <div class="profile-detail">
                <h3>Treatment Details</h3>
                <div class="row">
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Treatment</div>
                        <div class="value"><?php echo $treatment; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Additional Notes</div>
                        <div class="value"><?php echo $additional_notes; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Have you been diagnosed with any medical conditions or diseases?</div>
                        <div class="value"><?php echo $medical_history_1; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">What treatments, medications, or therapies have you previously tried for your medical condition(s)?</div>
                        <div class="value"><?php echo $medical_history_2; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Have you undergone any surgeries or medical procedures in the past?</div>
                        <div class="value"><?php echo $medical_history_3; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Are you currently taking any medications, supplements, or herbal remedies?</div>
                        <div class="value"><?php echo $medical_history_4; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">What are the specific symptoms or issues you are experiencing due to your medical condition(s)?</div>
                        <div class="value"><?php echo $current_medical_condition_1; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">How long have you been dealing with these symptoms?</div>
                        <div class="value"><?php echo $current_medical_condition_2; ?></div>
                    </div>
                    <div class="col-12 col-md-6 profile-item">
                        <div class="label">Are there any recent changes or developments in your condition that you would like to mention?</div>
                        <div class="value"><?php echo $current_medical_condition_3; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row profile-detail-wrap rounded mb-3">
            <div class="profile-detail">
                <h3>Clinic Details</h3>
                <div class="row">
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">Referred from another clinic</div>
                        <div class="value"><?php echo $referred_clinic; ?></div>
                    </div>
                    <?php if( $referred_clinic == 'yes' ): ?>
                        <div class="col-12 col-md-3 profile-item">
                            <div class="label">Clinic name</div>
                            <div class="value"><?php echo $clinic_name; ?></div>
                        </div>
                        <div class="col-12 col-md-3 profile-item">
                            <div class="label">Clinic Postcode</div>
                            <div class="value"><?php echo $clinic_postcode; ?></div>
                        </div>
                        <div class="col-12 col-md-3 profile-item">
                            <div class="label">Clinic Phone number</div>
                            <div class="value"><?php echo $clinic_phone_number; ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">GP name</div>
                        <div class="value"><?php echo $gp_name; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">Practice name</div>
                        <div class="value"><?php echo $practice_name; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">Address</div>
                        <div class="value"><?php echo $gp_address_line_1 . '<br/>' . $gp_address_line_2; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">GP Town</div>
                        <div class="value"><?php echo $gp_town; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">GP Country</div>
                        <div class="value"><?php echo $gp_country; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">GP Postal Code</div>
                        <div class="value"><?php echo $gp_postal_code; ?></div>
                    </div>
                    <div class="col-12 col-md-3 profile-item">
                        <div class="label">GP Phone</div>
                        <div class="value"><?php echo $gp_phone; ?></div>
                    </div>

                    <?php if( $csr_file ): ?>
                        <div class="col-12 col-md-3 profile-item">
                            <div class="label">CSR file</div>
                            <div class="value">
                                <a href="<?php echo $csr_file; ?>" data-fancybox="csr">View File</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( $photo_id ): ?>
                        <div class="col-12 col-md-3 profile-item">
                            <div class="label">Photo ID</div>
                            <div class="value">
                                <a href="<?php echo $photo_id; ?>" data-fancybox="photo">View File</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>

<?php
    else:
        wp_redirect( home_url() );
        die();
    endif; 
else:
    wp_redirect( home_url() );
    die();
endif;
?>