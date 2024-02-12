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
        $follow_up_appointments = get_field('follow_up_appointments' , $patient_post_id);
        
        $payment_date_1 = get_field('payment_date_1' , $patient_post_id);
        $payment_date_2 = get_field('payment_date_2' , $patient_post_id);
        $payment_date_3 = get_field('payment_date_3' , $patient_post_id);
        $transaction_id_1 = get_field('transaction_id_1' , $patient_post_id);
        $transaction_id_2 = get_field('transaction_id_2' , $patient_post_id);
        $transaction_id_3 = get_field('transaction_id_3' , $patient_post_id);
        $other_payments = get_field('other_payments' , $patient_post_id);

        $prescription_date_1 = get_field('prescription_date_1' , $patient_post_id);
        $prescription_date_2 = get_field('prescription_date_2' , $patient_post_id);
        $prescription_date_3 = get_field('prescription_date_3' , $patient_post_id);
        $prescription_note_1 = get_field('prescription_note_1' , $patient_post_id);
        $prescription_note_2 = get_field('prescription_note_2' , $patient_post_id);
        $prescription_note_3 = get_field('prescription_note_3' , $patient_post_id);
        $other_prescription_data = get_field('other_prescription_data' , $patient_post_id);

        $currentDate = new DateTime();
        $latest_prescription_date = get_latest_prescription_date($patient_post_id);

        if( $latest_prescription_date ) {
            $prescriptionDateTime = DateTime::createFromFormat('d/m/Y', $latest_prescription_date);
            $expire_prescription_date = $prescriptionDateTime->modify('+19 days');
        }

        $repeat_eligible = true;

        $form = (isset($_GET['form'])) ? $_GET['form'] : false;
        $status = (isset($_GET['status'])) ? $_GET['status'] : false;
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

        <div class="row">
            <?php if( $form == 'cd' && $status ): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Contact Details updated successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if( $form == 'cld' && $status ): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Clinic Details updated successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="row profile-detail-wrap rounded mb-4 repeat_order_wrap">
            <div class="col-12 col-md-9 m-auto">
                <?php if( $currentDate >= $expire_prescription_date ): ?>
                    Congratulations, you are now eligible for repeat prescription
                <?php else: ?>
                    <?php $repeat_eligible = false; ?>
                    You are only eligible for repeat prescription 20 days or more from your last prescription issued date, which was <?php echo $latest_prescription_date; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-3">
                <?php if( $repeat_eligible ): ?>
                    <a href="<?php echo admin_url( 'admin-post.php?action=repeat_prescription&patient='.$patient_post_id ); ?>" id="repeat_order" class="btn style_2">ORDER REPEAT Prescription</a>
                <?php else: ?>
                    <button type="button" class="btn style_2" disabled>ORDER REPEAT Prescription</button>
                <?php endif; ?>
            </div>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-contact-details-tab" data-bs-toggle="pill" data-bs-target="#pills-contact-details" type="button" role="tab" aria-controls="pills-contact-details" aria-selected="true">Contact Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-clinic-details-tab" data-bs-toggle="pill" data-bs-target="#pills-clinic-details" type="button" role="tab" aria-controls="pills-clinic-details" aria-selected="false">Clinic Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-treatment-tab" data-bs-toggle="pill" data-bs-target="#pills-treatment" type="button" role="tab" aria-controls="pills-treatment" aria-selected="false">Treatment Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill" data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents" aria-selected="false">Documents</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-consultation-tab" data-bs-toggle="pill" data-bs-target="#pills-consultation" type="button" role="tab" aria-controls="pills-consultation" aria-selected="false">Consultation</button>
            </li>

            <?php if( $payment_date_1 || $payment_date_2 || $payment_date_3 || $other_payments ): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-payments-tab" data-bs-toggle="pill" data-bs-target="#pills-payments" type="button" role="tab" aria-controls="pills-payments" aria-selected="false">Payments</button>
                </li>
            <?php endif; ?>
            
            <?php if( $prescription_date_1 || $prescription_date_2 || $prescription_date_3 || $other_prescription_data ): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-prescriptions-tab" data-bs-toggle="pill" data-bs-target="#pills-prescriptions" type="button" role="tab" aria-controls="pills-prescriptions" aria-selected="false">Prescriptions</button>
                </li>
            <?php endif; ?>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-contact-details" role="tabpanel" aria-labelledby="pills-contact-details-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">
                    <div class="col-12 col-sm-3 profile-pic">
                        <?php if( $photo_id ): ?>
                            <?php if( isImageUrl($photo_id) ): ?>
                                <img src="<?php echo $photo_id; ?>" class="img-fluid rounded" alt="">
                            <?php else: ?>
                                <img src="<?php bloginfo( 'template_url' ); ?>/img/profile-pic.webp" class="img-fluid rounded" alt="">
                            <?php endif; ?>
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
                            <div class="col-12 profile-item">
                                <?php echo do_shortcode('[gravityform id="9" title="false" field_values="patient_id='.$user_id.'&patient_post_id='.$patient_post_id.'&full_name='.$name.'&email='.$email.'&phone='.$phone.'&gender='.$gender.'&address_line_1='.$address_line_1.'&address_line_2='.$address_line_2.'&town='.$town.'&country='.$country.'&postcode='.$postcode.'&dob='.$dob.'"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-treatment" role="tabpanel" aria-labelledby="pills-treatment-tab" tabindex="0">
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
            </div>

            <div class="tab-pane fade" id="pills-clinic-details" role="tabpanel" aria-labelledby="pills-clinic-details-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">
                    <div class="profile-detail">
                        <h3>Clinic Details</h3>
                        <div class="row">
                            <div class="col-12 profile-item">
                                <?php echo do_shortcode('[gravityform id="10" title="false" field_values="patient_id='.$user_id.'&patient_post_id='.$patient_post_id.'&referred_clinic='.$referred_clinic.'&clinic_name='.$clinic_name.'&clinic_postcode='.$clinic_postcode.'&clinic_phone_number='.$clinic_phone_number.'&gp_name='.$gp_name.'&practice_name='.$practice_name.'&gp_address_line_1='.$gp_address_line_1.'&gp_address_line_2='.$gp_address_line_2.'&gp_town='.$gp_town.'&gp_country='.$gp_country.'&gp_postal_code='.$gp_postal_code.'&gp_phone='.$gp_phone.'"]'); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">

                    <div class="profile-detail">
                        <h3>Documents</h3>
                        <div class="row">

                            <?php if( $csr_file ): ?>
                                <div class="col-12 col-md-3 profile-item">
                                    <div class="label">CSR file</div>
                                    <div class="value">
                                        <a href="<?php echo $csr_file; ?>" target="_blank" rel="noopener noreferrer">View File</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $photo_id ): ?>
                                <div class="col-12 col-md-3 profile-item">
                                    <div class="label">Photo ID</div>
                                    <div class="value">
                                        <?php if( isImageUrl($photo_id) ): ?>
                                            <a href="<?php echo $photo_id; ?>" data-fancybox="photo">View File</a>
                                        <?php else: ?>
                                            <a href="<?php echo $photo_id; ?>" target="_blank" rel="noopener noreferrer">View File</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if( $follow_up_appointments ): ?>
                        <div class="profile-detail">
                            <h3>Follow Ups</h3>
                            <div class="row">

                                <div class="col-12 profile-item">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Follow Up Date</th>
                                                    <th class="text-end">Follow Up File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach( $follow_up_appointments as $follow_up ): ?>
                                                    <tr>
                                                        <td><?php echo $follow_up['appointment_date']; ?></td>
                                                        <td class="text-end">
                                                            <a class="btn style_4 small" href="<?php echo $follow_up['appointment_file']; ?>" target="_blank" rel="noopener noreferrer">View File</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade" id="pills-payments" role="tabpanel" aria-labelledby="pills-payments-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">

                    <?php if( $payment_date_1 || $payment_date_2 || $payment_date_3 || $other_payments ): ?>
                        <div class="profile-detail">
                            <h3>Payment Info</h3>
                            <div class="row">

                                <div class="col-12 profile-item">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Payment Date</th>
                                                    <th class="text-end">Transaction ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( $payment_date_1 ): ?>
                                                    <tr>
                                                        <td><?php echo $payment_date_1; ?></td>
                                                        <td class="text-end"><?php echo $transaction_id_1; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if( $payment_date_2 ): ?>
                                                    <tr>
                                                        <td><?php echo $payment_date_2; ?></td>
                                                        <td class="text-end"><?php echo $transaction_id_2; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if( $payment_date_3 ): ?>
                                                    <tr>
                                                        <td><?php echo $payment_date_3; ?></td>
                                                        <td class="text-end"><?php echo $transaction_id_3; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php 
                                                    if( $other_payments ):
                                                        foreach( $other_payments as $payment ): 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $payment['payment_date']; ?></td>
                                                        <td class="text-end"><?php echo $payment['transaction_id']; ?></td>
                                                    </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade" id="pills-prescriptions" role="tabpanel" aria-labelledby="pills-prescriptions-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">

                    <?php if( $prescription_date_1 || $prescription_date_2 || $prescription_date_3 || $other_prescription_data ): ?>
                        <div class="profile-detail">
                            <h3>Prescriptions Info</h3>
                            <div class="row">

                                <div class="col-12 profile-item">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Prescription Date</th>
                                                    <th>Prescription Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( $prescription_date_1 ): ?>
                                                    <tr>
                                                        <td><?php echo $prescription_date_1; ?></td>
                                                        <td><?php echo $prescription_note_1; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if( $prescription_date_2 ): ?>
                                                    <tr>
                                                        <td><?php echo $prescription_date_2; ?></td>
                                                        <td><?php echo $prescription_note_2; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if( $prescription_date_3 ): ?>
                                                    <tr>
                                                        <td><?php echo $prescription_date_3; ?></td>
                                                        <td><?php echo $prescription_note_3; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php 
                                                    if( $other_prescription_data ):
                                                        foreach( $other_prescription_data as $prescription ): 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $prescription['prescription_date']; ?></td>
                                                        <td><?php echo $prescription['prescription_note']; ?></td>
                                                    </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-pane fade" id="pills-consultation" role="tabpanel" aria-labelledby="pills-consultation-tab" tabindex="0">
                <div class="row profile-detail-wrap rounded mb-3">

                    <?php
                        $mc_information_1 = get_field('mc_information_1' , $patient_post_id);
                        $mc_medical_history_1 = get_field('mc_medical_history_1' , $patient_post_id);
                        $mc_medical_history_2 = get_field('mc_medical_history_2' , $patient_post_id);
                        $mc_medical_history_3 = get_field('mc_medical_history_3' , $patient_post_id);
                        $mc_medical_history_4 = get_field('mc_medical_history_4' , $patient_post_id);
                        $mc_medical_history_5 = get_field('mc_medical_history_5' , $patient_post_id);
                        $mc_medical_condition_1 = get_field('mc_medical_condition_1' , $patient_post_id);
                        $mc_medical_condition_2 = get_field('mc_medical_condition_2' , $patient_post_id);
                        $mc_medical_condition_3 = get_field('mc_medical_condition_3' , $patient_post_id);
                        $mc_previous_treatments_1 = get_field('mc_previous_treatments_1' , $patient_post_id);
                        $mc_previous_treatments_2 = get_field('mc_previous_treatments_2' , $patient_post_id);
                        $mc_previous_treatments_3 = get_field('mc_previous_treatments_3' , $patient_post_id);
                        $mc_expectations_1 = get_field('mc_expectations_1' , $patient_post_id);
                        $mc_expectations_2 = get_field('mc_expectations_2' , $patient_post_id);
                        $mc_expectations_3 = get_field('mc_expectations_3' , $patient_post_id);
                        $mc_allergies_1 = get_field('mc_allergies_1' , $patient_post_id);
                        $mc_allergies_2 = get_field('mc_allergies_2' , $patient_post_id);
                        $mc_family_medical_history_1 = get_field('mc_family_medical_history_1' , $patient_post_id);
                        $mc_family_medical_history_2 = get_field('mc_family_medical_history_2' , $patient_post_id);
                        $mc_habits_1 = get_field('mc_habits_1' , $patient_post_id);
                        $mc_habits_2 = get_field('mc_habits_2' , $patient_post_id);
                        $mc_habits_3 = get_field('mc_habits_3' , $patient_post_id);
                        $mc_psychosocial_assessment_1 = get_field('mc_psychosocial_assessment_1' , $patient_post_id);
                        $mc_psychosocial_assessment_2 = get_field('mc_psychosocial_assessment_2' , $patient_post_id);
                        $mc_psychosocial_assessment_3 = get_field('mc_psychosocial_assessment_3' , $patient_post_id);
                        $mc_legal_1 = get_field('mc_legal_1' , $patient_post_id);
                        $mc_legal_2 = get_field('mc_legal_2' , $patient_post_id);
                        $mc_complementary_medicines_1 = get_field('mc_complementary_medicines_1' , $patient_post_id);
                        $mc_complementary_medicines_2 = get_field('mc_complementary_medicines_2' , $patient_post_id);
                        $mc_patient_preferences_1 = get_field('mc_patient_preferences_1' , $patient_post_id);
                        $mc_additional_notes = get_field('mc_additional_notes' , $patient_post_id);
                    ?>

                    <div class="profile-detail mb-3">
                        <h3>General Patient Information</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you have a legal guardian, and if so, please provide their information?</div>
                                <div class="value"><?php echo $mc_information_1; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Medical History</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you been diagnosed with any medical conditions or diseases?</div>
                                <div class="value"><?php echo $mc_medical_history_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">What treatments, medications, or therapies have you previously tried for your medical condition(s)?</div>
                                <div class="value"><?php echo $mc_medical_history_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you undergone any surgeries or medical procedures in the past? If so, please provide details.</div>
                                <div class="value"><?php echo $mc_medical_history_3; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are you currently taking any medications, supplements, or herbal remedies? Please list them.</div>
                                <div class="value"><?php echo $mc_medical_history_4; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Review SCR</div>
                                <div class="value"><?php echo $mc_medical_history_5; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Current Medical Condition</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">What are the speciﬁc symptoms or issues you are experiencing due to your medical condition(s)?</div>
                                <div class="value"><?php echo $mc_medical_condition_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">How long have you been dealing with these symptoms?</div>
                                <div class="value"><?php echo $mc_medical_condition_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are there any recent changes or developments in your condition that you would like to mention?</div>
                                <div class="value"><?php echo $mc_medical_condition_3; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Response to Previous Treatments</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you tried any medications, therapies, or interventions for your current medical condition(s)? If so, what were the results?</div>
                                <div class="value"><?php echo $mc_previous_treatments_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Were there any side eﬀects or adverse reactions to previous treatments?</div>
                                <div class="value"><?php echo $mc_previous_treatments_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you found any treatments to be eﬀective or ineﬀective in managing your symptoms?</div>
                                <div class="value"><?php echo $mc_previous_treatments_3; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Patient Goals and Expectations</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">What are your goals for treatment with medicinal cannabis?</div>
                                <div class="value"><?php echo $mc_expectations_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">What outcomes are you hoping to achieve?</div>
                                <div class="value"><?php echo $mc_expectations_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you have speciﬁc expectations regarding symptom relief, improved quality of life, or other treatment outcomes?</div>
                                <div class="value"><?php echo $mc_expectations_3; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Allergies and Sensitivities</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are you allergic to any medications, substances, or foods? Please provide details.</div>
                                <div class="value"><?php echo $mc_allergies_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you ever experienced adverse reactions or sensitivities to any medications in the past?</div>
                                <div class="value"><?php echo $mc_allergies_2; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Family Medical History</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Is there a family history of the medical condition(s) you are currently experiencing?</div>
                                <div class="value"><?php echo $mc_family_medical_history_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are there any genetic conditions or predispositions that run in your family?</div>
                                <div class="value"><?php echo $mc_family_medical_history_2; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Lifestyle and Habits</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you smoke or use tobacco products?</div>
                                <div class="value"><?php echo $mc_habits_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you consume alcohol or recreational drugs?</div>
                                <div class="value"><?php echo $mc_habits_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are you physically active, and if so, how often do you engage in exercise or physical activities?</div>
                                <div class="value"><?php echo $mc_habits_3; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Psychosocial Assessment</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">How is your mental and emotional well-being?</div>
                                <div class="value"><?php echo $mc_psychosocial_assessment_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you experienced any mental health conditions, such as anxiety or depression?</div>
                                <div class="value"><?php echo $mc_psychosocial_assessment_2; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you have a support system, including family and friends, to assist you during your treatment?</div>
                                <div class="value"><?php echo $mc_psychosocial_assessment_3; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Legal and Regulatory Information</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Are you aware of the legal regulations surrounding the use of medicinal cannabis in your jurisdiction?</div>
                                <div class="value"><?php echo $mc_legal_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you have any concerns about the legal status of medicinal cannabis?</div>
                                <div class="value"><?php echo $mc_legal_2; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail mb-3">
                        <h3>Alternative Therapies and Complementary Medicines</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Have you explored or considered alternative therapies or complementary medicines for your condition(s), such as acupuncture, chiropractic care, or dietary supplements?</div>
                                <div class="value"><?php echo $mc_complementary_medicines_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">If so, please provide details about your experiences with these treatments.</div>
                                <div class="value"><?php echo $mc_complementary_medicines_2; ?></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="profile-detail">
                        <h3>Patient Preferences and Concerns</h3>
                        <div class="row">
                            
                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Do you have any preferences regarding the type of medicinal cannabis product (e.g., oil, capsules, inhalation) you would prefer?</div>
                                <div class="value"><?php echo $mc_patient_preferences_1; ?></div>
                            </div>

                            <div class="col-12 col-md-6 profile-item">
                                <div class="label">Additional notes</div>
                                <div class="value"><?php echo $mc_additional_notes; ?></div>
                            </div>
                            
                        </div>
                    </div>

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