<?php 
/* Template Name: Appointment Booking Page */

$patient = isset($_GET['patient']) ? $_GET['patient'] : false;
$booking = isset($_GET['booking']) ? $_GET['booking'] : false;

//if( $patient && $booking ):

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
        
        <!-- <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post" class="needs-validation" novalidate>  
            
            <input type="hidden" name="action" value="mc_patient_booking">
            <input type="hidden" name="patient" value="<?php echo $patient; ?>">
            <input type="hidden" name="booking" value="<?php echo $booking; ?>">

            <ul class="nav" id="bookingTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="mc-tab-1-tab" data-bs-toggle="tab" data-bs-target="#mc-tab-1" type="button" role="tab" aria-controls="mc-tab-1" aria-selected="true">Stage 1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mc-tab-2-tab" data-bs-toggle="tab" data-bs-target="#mc-tab-2" type="button" role="tab" aria-controls="mc-tab-2" aria-selected="true">Stage 2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mc-tab-3-tab" data-bs-toggle="tab" data-bs-target="#mc-tab-3" type="button" role="tab" aria-controls="mc-tab-3" aria-selected="true">Stage 3</button>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="mc-tab-1" role="tabpanel" aria-labelledby="mc-tab-1-tab" tabindex="0">

                    <div class="mb-3">
                        <label for="patient_ID" class="form-label">Patient ID</label>
                        <div class="form-content"><?php echo $patient_ID; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="form-content"><?php echo $password; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control mb-2" id="address" placeholder="Line 1">
                        <input type="text" name="address_2" class="form-control" id="address_2" placeholder="Line 2">
                    </div>

                    <div class="mb-3">
                        <label for="town" class="form-label">Town</label>
                        <input type="text" name="town" class="form-control" id="town">
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">County</label>
                        <select class="form-select" id="country" name="country">
                            <option selected>Select Country</option>
                            <?php foreach( $countries as $country ): ?>
                                <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" name="postcode" class="form-control" id="postcode">
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="text" name="dob" class="form-control mc-datepicker" id="dob">
                    </div>

                    <div class="btn_wrap d-flex justify-content-between" >
                        <button class="btn style_4 ms-auto" onclick="changeTab('mc-tab-2')" type="button">Proceed to stage 2</button>
                    </div>

                </div>

                <div class="tab-pane" id="mc-tab-2" role="tabpanel" aria-labelledby="mc-tab-2-tab" tabindex="1">

                    <div class="mb-3">
                        <label for="treatment" class="form-label">Treatment Required</label>
                        <select class="form-select" id="treatment" name="treatment">
                            
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="additional_note" class="form-label">Any additional notes</label>
                        <textarea class="form-control" id="additional_note" name="additional_note" rows="3"></textarea>
                        <div class="form-text">any allergies or information the clinician may find useful.</div>
                    </div>

                    <h5>Medical History</h5>

                    <div class="mb-3">
                        <label for="medical_history_1" class="form-label">Have you been diagnosed with any medical conditions or diseases?</label>
                        <div class="form-text">Please list them.</div>
                        <?php
                            wp_editor("", 'medical_history_1', array(
                                'textarea_name' => 'medical_history_1',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="medical_history_2" class="form-label">What treatments, medications, or therapies have you previously tried for your medical condition(s)?</label>
                        <?php
                            wp_editor("", 'medical_history_2', array(
                                'textarea_name' => 'medical_history_2',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="medical_history_3" class="form-label">Have you undergone any surgeries or medical procedures in the past? If so, please provide details.</label>
                        <?php
                            wp_editor("", 'medical_history_3', array(
                                'textarea_name' => 'medical_history_3',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="medical_history_4" class="form-label">Are you currently taking any medications, supplements, or herbal remedies? Please list them.</label>
                        <?php
                            wp_editor("", 'medical_history_4', array(
                                'textarea_name' => 'medical_history_4',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <h5>Current Medical Condition</h5>

                    <div class="mb-3">
                        <label for="current_medical_condition_1" class="form-label">What are the specific symptoms or issues you are experiencing due to your medical condition(s)?</label>
                        <?php
                            wp_editor("", 'current_medical_condition_1', array(
                                'textarea_name' => 'current_medical_condition_1',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="current_medical_condition_2" class="form-label">How long have you been dealing with these symptoms?</label>
                        <?php
                            wp_editor("", 'current_medical_condition_2', array(
                                'textarea_name' => 'current_medical_condition_2',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="current_medical_condition_3" class="form-label">Are there any recent changes or developments in your condition that you would like to mention?</label>
                        <?php
                            wp_editor("", 'current_medical_condition_3', array(
                                'textarea_name' => 'current_medical_condition_3',
                                'textarea_rows' => 10,
                                'teeny'         => true,
                                'media_buttons' => false,
                            ));
                        ?>
                    </div>

                    <div class="btn_wrap d-flex justify-content-between">
                        <button class="btn style_2" onclick="changeTab('mc-tab-1')" type="button">Previous</button>
                        <button class="btn style_4" onclick="changeTab('mc-tab-3')" type="button">Proceed to stage 3</button>
                    </div>

                </div>

                <div class="tab-pane" id="mc-tab-3" role="tabpanel" aria-labelledby="mc-tab-3-tab" tabindex="2">

                    <div class="form-item mb-3">
                        <p>Are you referred from another clinic?</p>
                        <div class="form-yesno">
                            <input type="checkbox" value="1" name="referred_clinic" id="referred_clinic">
                            <label for="referred_clinic" data-bs-toggle="collapse" data-bs-target="#collapse_referred_clinic"></label>
                        </div>
                    </div>

                    <div class="collapse" id="collapse_referred_clinic">

                        <div class="mb-3">
                            <label for="clinic_name" class="form-label">Clinic name</label>
                            <input type="text" name="clinic_name" class="form-control" id="clinic_name">
                        </div>

                        <div class="mb-3">
                            <label for="clinic_postcode" class="form-label">Clinic Postcode</label>
                            <input type="text" name="clinic_postcode" class="form-control" id="clinic_postcode">
                        </div>

                        <div class="mb-3">
                            <label for="clinic_phone_number" class="form-label">Clinic Phone number</label>
                            <input type="text" name="clinic_phone_number" class="form-control" id="clinic_phone_number">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="gp_name" class="form-label">GP name</label>
                        <input type="text" name="gp_name" class="form-control" id="gp_name">
                    </div>

                    <div class="mb-3">
                        <label for="practice_name" class="form-label">Practice name</label>
                        <input type="text" name="practice_name" class="form-control" id="practice_name">
                    </div>

                    <div class="mb-3">
                        <label for="gp_address_line_1" class="form-label">Address</label>
                        <input type="text" name="gp_address_line_1" class="form-control mb-2" id="gp_address_line_1" placeholder="Line 1">
                        <input type="text" name="gp_address_line_2" class="form-control" id="gp_address_line_2" placeholder="Line 2">
                    </div>

                    <div class="mb-3">
                        <label for="gp_town" class="form-label">Town</label>
                        <input type="text" name="gp_town" class="form-control" id="gp_town">
                    </div>

                    <div class="mb-3">
                        <label for="gp_country" class="form-label">County</label>
                        <select class="form-select" id="gp_country" name="gp_country">
                            <option selected>Select Country</option>
                            <?php foreach( $countries as $country ): ?>
                                <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="gp_postal_code" class="form-label">Postcode</label>
                        <input type="text" name="gp_postal_code" class="form-control" id="gp_postal_code">
                    </div>

                    <div class="mb-3">
                        <label for="gp_phone" class="form-label">Phone Number</label>
                        <input type="text" name="gp_phone" class="form-control" id="gp_phone">
                    </div>

                    <div class="mb-3">
                        <label for="csr_file" class="form-label">Upload CSR file</label>
                        <div class="dropzone" id="csrFile"></div>
                        <input type="hidden" id="csr_file" name="csr_file" value="" >
                    </div>

                    <div class="mb-3">
                        <label for="photo_id" class="form-label">Upload photo id</label>
                        <div class="dropzone" id="photoId"></div>
                        <input type="hidden" id="photo_id" name="photo_id" value="" >
                    </div>

                    <div class="btn_wrap d-flex justify-content-between">
                        <button class="btn style_2" onclick="changeTab('mc-tab-2')" type="button">Previous</button>
                        <button class="btn style_4 btn-submit" type="submit">Submit</button>
                    </div>

                </div>
            </div>

        </form> -->
    
    </div>
</section>
<script>
function changeTab(tabId) {
    var tab = new bootstrap.Tab(document.querySelector('#' + tabId + '-tab'));
    scrollToTop();
    tab.show();
}

function scrollToTop() {
    jQuery('html, body').animate({
        scrollTop: 0
    }, 800); // Adjust the animation speed if needed
}

(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})();
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
/* else:
    wp_redirect( home_url() );
    die();
endif;  */
?>