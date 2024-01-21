<?php
add_action( 'admin_post_mc_eligibility_checker', 'admin_mc_eligibility_checker' );
add_action( 'admin_post_nopriv_mc_eligibility_checker', 'admin_mc_eligibility_checker' );
function admin_mc_eligibility_checker() {

    $fname = isset($_POST['fname']) ? $_POST['fname'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : false;
    $eligibility_q1 = isset($_POST['eligibility_q1']) ? $_POST['eligibility_q1'] : false;
    $eligibility_q2 = isset($_POST['eligibility_q2']) ? $_POST['eligibility_q2'] : false;
    $eligibility_q3 = isset($_POST['eligibility_q3']) ? $_POST['eligibility_q3'] : false;
    $eligibility_q4 = isset($_POST['eligibility_q4']) ? $_POST['eligibility_q4'] : false;
    $eligibility_q5 = isset($_POST['eligibility_q5']) ? $_POST['eligibility_q5'] : false;
    $last_user_ID = get_last_user_ID();
    $new_user_ID = intval($last_user_ID) + 1;

    $patient_ID = "MP-".$new_user_ID;
    $password = wp_generate_password();

    if($fname && $email && $contact_no) {
        if(email_exists($email)) {
            $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=User exists.';
        } else {
            // Create Patient Object
            $patient = array(
                'post_title'    => wp_strip_all_tags($fname),
                'post_status'   => 'publish',
                'post_type' => 'marucanna-patients',
            );
        
            $patient_post_id = wp_insert_post($patient);
        
            if(!is_wp_error($patient_post_id)) {
        
                update_post_meta( $patient_post_id, 'eligibility_q1', wp_slash( $eligibility_q1 ) );
                update_post_meta( $patient_post_id, 'eligibility_q2', wp_slash( $eligibility_q2 ) );
                update_post_meta( $patient_post_id, 'eligibility_q3', wp_slash( $eligibility_q3 ) );
                update_post_meta( $patient_post_id, 'eligibility_q4', wp_slash( $eligibility_q4 ) );
                update_post_meta( $patient_post_id, 'eligibility_q5', wp_slash( $eligibility_q5 ) );
        
                update_field('name', $fname , $patient_post_id);
                update_field('email', $email , $patient_post_id);
                update_field('phone', $contact_no , $patient_post_id);
                update_field('patient_id', $patient_ID , $patient_post_id);
        
                if($eligibility_q1 && !$eligibility_q5) {
                    $eligibility = 'Eligible';
                }else{
                    $eligibility = 'Unqualified Patients';
                }
        
                update_field('eligibility', $eligibility , $patient_post_id);
        
                if($eligibility_q1 && !$eligibility_q5) {
            
                    //Create User
                    $user_data = array(
                        'user_login' => $patient_ID,
                        'user_pass'  => $password,
                        'user_email' => $email,
                        'role'       => 'patient',
                    );
            
                    // Insert the user into the database
                    $user_id = wp_insert_user($user_data);
            
                    if( !is_wp_error($user_id) ) {
                        
                        // Add user meta data
                        add_user_meta($user_id, 'patient_password', $password);
                        add_user_meta($user_id, 'patient_info', $patient_post_id);
                        add_user_meta($user_id, 'consultant', false);

                        update_field('patient', $user_id , $patient_post_id);
            
                        $return_url = get_field('booking_page' , 'option').'?patient='.$user_id.'&booking='.$patient_post_id;
            
                    } else {
                        $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$user_id->get_error_message();
                    }
        
                }else{
                    $return_url = get_field('check_eligibility_page' , 'option').'?status=2&mgs=You are not Eligible.';
                }
        
            } else {
                $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$patient_post_id->get_error_message();
            }
        }
    } else {
        $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=Please fill in all required fields.';
    }
    
    wp_redirect( $return_url );
    exit;
  
}

add_action( 'gform_after_submission_1', 'mc_patient_booking_post_type_update', 10, 2 );
function mc_patient_booking_post_type_update( $entry, $form ) {

    $patient = rgar( $entry, '84' );
    $booking = rgar( $entry, '85' );
    $gender = rgar( $entry, '80' );
    $address = rgar( $entry, '82.1' );
    $address_2 = rgar( $entry, '82.2' );
    $town = rgar( $entry, '86' );
    $country = rgar( $entry, '83.6' );
    $postcode = rgar( $entry, '87' );
    $dob = rgar( $entry, '81' );
    $treatment = rgar( $entry, '88' );
    $additional_note = rgar( $entry, '89' );
    $medical_history_1 = rgar( $entry, '90' );
    $medical_history_2 = rgar( $entry, '91' );
    $medical_history_3 = rgar( $entry, '92' );
    $medical_history_4 = rgar( $entry, '93' );
    $current_medical_condition_1 = rgar( $entry, '94' );
    $current_medical_condition_2 = rgar( $entry, '95' );
    $current_medical_condition_3 = rgar( $entry, '96' );
    $referred_clinic = rgar( $entry, '97' );
    $clinic_name = rgar( $entry, '98' );
    $clinic_postcode = rgar( $entry, '100' );
    $clinic_phone_number = rgar( $entry, '101' );
    $gp_name = rgar( $entry, '102' );
    $practice_name = rgar( $entry, '103' );
    $gp_address_line_1 = rgar( $entry, '104.1' );
    $gp_address_line_2 = rgar( $entry, '104.2' );
    $gp_town = rgar( $entry, '105' );
    $gp_country = rgar( $entry, '108.6' );
    $gp_postal_code = rgar( $entry, '106' );
    $gp_phone = rgar( $entry, '109' );
    $csr_file = rgar( $entry, '110' );
    $photo_id = rgar( $entry, '111' );

    if( $patient && $booking ) {
        update_field('gender', $gender , $booking);
        update_field('address_line_1', $address , $booking);
        update_field('address_line_2', $address_2 , $booking);
        update_field('town', $town , $booking);
        update_field('country', $country , $booking);
        update_field('postcode', $postcode , $booking);
        update_field('dob', $dob , $booking);
        update_field('treatment', $treatment , $booking);
        update_field('additional_note', $additional_note , $booking);
        update_field('medical_history_1', $medical_history_1 , $booking);
        update_field('medical_history_2', $medical_history_2 , $booking);
        update_field('medical_history_3', $medical_history_3 , $booking);
        update_field('medical_history_4', $medical_history_4 , $booking);
        update_field('current_medical_condition_1', $current_medical_condition_1 , $booking);
        update_field('current_medical_condition_2', $current_medical_condition_2 , $booking);
        update_field('current_medical_condition_3', $current_medical_condition_3 , $booking);
        update_field('referred_clinic', $referred_clinic , $booking);
        update_field('clinic_name', $clinic_name , $booking);
        update_field('clinic_postcode', $clinic_postcode , $booking);
        update_field('clinic_phone_number', $clinic_phone_number , $booking);
        update_field('gp_name', $gp_name , $booking);
        update_field('practice_name', $practice_name , $booking);
        update_field('gp_address_line_1', $gp_address_line_1 , $booking);
        update_field('gp_address_line_2', $gp_address_line_2 , $booking);
        update_field('gp_town', $gp_town , $booking);
        update_field('gp_country', $gp_country , $booking);
        update_field('gp_postal_code', $gp_postal_code , $booking);
        update_field('gp_phone', $gp_phone , $booking);
        update_field('csr_file', $csr_file , $booking);
        update_field('photo_id', $photo_id , $booking);
    }
  
}
  
add_action( 'gform_after_submission_2', 'mc_consultant_data_update', 10, 2 );
function mc_consultant_data_update( $entry, $form ) {
  
    $patient = rgar( $entry, '52' );
    $patient_post_id = rgar( $entry, '53' );
    $full_name = rgar( $entry, '3' );
    $date_of_birth = rgar( $entry, '5' );
    $address_line_1 = rgar( $entry, '7.1' );
    $address_line_2 = rgar( $entry, '7.2' );
    $phone = rgar( $entry, '8' );
    $information_1 = rgar( $entry, '9' );
    $medical_history_1 = rgar( $entry, '11' );
    $medical_history_2 = rgar( $entry, '12' );
    $medical_history_3 = rgar( $entry, '13' );
    $medical_history_4 = rgar( $entry, '14' );
    $medical_history_5 = rgar( $entry, '15' );
    $medical_condition_1 = rgar( $entry, '17' );
    $medical_condition_2 = rgar( $entry, '18' );
    $medical_condition_3 = rgar( $entry, '19' );
    $previous_treatments_1 = rgar( $entry, '20' );
    $previous_treatments_2 = rgar( $entry, '22' );
    $previous_treatments_3 = rgar( $entry, '23' );
    $expectations_1 = rgar( $entry, '24' );
    $expectations_2 = rgar( $entry, '26' );
    $expectations_3 = rgar( $entry, '27' );
    $allergies_1 = rgar( $entry, '29' );
    $allergies_2 = rgar( $entry, '30' );
    $family_medical_history_1 = rgar( $entry, '32' );
    $family_medical_history_2 = rgar( $entry, '33' );
    $habits_1 = rgar( $entry, '35' );
    $habits_2 = rgar( $entry, '36' );
    $habits_3 = rgar( $entry, '37' );
    $psychosocial_assessment_1 = rgar( $entry, '39' );
    $psychosocial_assessment_2 = rgar( $entry, '40' );
    $psychosocial_assessment_3 = rgar( $entry, '41' );
    $legal_1 = rgar( $entry, '43' );
    $legal_2 = rgar( $entry, '44' );
    $complementary_medicines_1 = rgar( $entry, '46' );
    $complementary_medicines_2 = rgar( $entry, '47' );
    $patient_preferences_1 = rgar( $entry, '49' );
    $additional_notes = rgar( $entry, '50' );
    
    if($patient_post_id) {
        update_field('mc_full_name', $full_name , $patient_post_id);
        update_field('mc_date_of_birth', $date_of_birth , $patient_post_id);
        update_field('mc_address_line_1', $address_line_1 , $patient_post_id);
        update_field('mc_address_line_2', $address_line_2 , $patient_post_id);
        update_field('mc_phone', $phone , $patient_post_id);
        update_field('mc_information_1', $information_1 , $patient_post_id);
        update_field('mc_medical_history_1', $medical_history_1 , $patient_post_id);
        update_field('mc_medical_history_2', $medical_history_2 , $patient_post_id);
        update_field('mc_medical_history_3', $medical_history_3 , $patient_post_id);
        update_field('mc_medical_history_4', $medical_history_4 , $patient_post_id);
        update_field('mc_medical_history_5', $medical_history_5 , $patient_post_id);
        update_field('mc_medical_condition_1', $medical_condition_1 , $patient_post_id);
        update_field('mc_medical_condition_2', $medical_condition_2 , $patient_post_id);
        update_field('mc_medical_condition_3', $medical_condition_3 , $patient_post_id);
        update_field('mc_previous_treatments_1', $previous_treatments_1 , $patient_post_id);
        update_field('mc_previous_treatments_2', $previous_treatments_2 , $patient_post_id);
        update_field('mc_previous_treatments_3', $previous_treatments_3 , $patient_post_id);
        update_field('mc_expectations_1', $expectations_1 , $patient_post_id);
        update_field('mc_expectations_2', $expectations_2 , $patient_post_id);
        update_field('mc_expectations_3', $expectations_3 , $patient_post_id);
        update_field('mc_allergies_1', $allergies_1 , $patient_post_id);
        update_field('mc_allergies_2', $allergies_2 , $patient_post_id);
        update_field('mc_family_medical_history_1', $family_medical_history_1 , $patient_post_id);
        update_field('mc_family_medical_history_2', $family_medical_history_2 , $patient_post_id);
        update_field('mc_habits_1', $habits_1 , $patient_post_id);
        update_field('mc_habits_2', $habits_2 , $patient_post_id);
        update_field('mc_habits_3', $habits_3 , $patient_post_id);
        update_field('mc_psychosocial_assessment_1', $psychosocial_assessment_1 , $patient_post_id);
        update_field('mc_psychosocial_assessment_2', $psychosocial_assessment_2 , $patient_post_id);
        update_field('mc_psychosocial_assessment_3', $psychosocial_assessment_3 , $patient_post_id);
        update_field('mc_legal_1', $legal_1 , $patient_post_id);
        update_field('mc_legal_2', $legal_2 , $patient_post_id);
        update_field('mc_complementary_medicines_1', $complementary_medicines_1 , $patient_post_id);
        update_field('mc_complementary_medicines_2', $complementary_medicines_2 , $patient_post_id);
        update_field('mc_patient_preferences_1', $patient_preferences_1 , $patient_post_id);
        update_field('mc_additional_notes', $additional_notes , $patient_post_id);

        $user = get_user_by('login', $patient);

        if ($user) {
            $user_id = $user->ID;
            
            // Add user meta data
            update_user_meta($user_id, 'consultant', true);
        }
    }
    
}

//add_filter('gform_pre_render', 'populate_patient_ids_field');
function populate_patient_ids_field($form) {
    // Specify the form ID and the field ID of the dropdown you want to populate
    $form_id = 2; // Change to your form ID
    $field_id = 51; // Change to your field ID
  
    // Check if the current form matches the specified form ID
    if ($form['id'] == $form_id) {
        $dynamic_options = get_patient_ids();
        
        // Find the target field by its ID
        foreach ($form['fields'] as &$field) {
            if ($field['id'] == $field_id && $field['type'] == 'select') {
                $field['choices'] = $dynamic_options;
                break;
            }
        }
    }
    
    return $form;
}