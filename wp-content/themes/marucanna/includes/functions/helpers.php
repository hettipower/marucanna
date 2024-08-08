<?php
function get_patient_ids() {
    $patients = get_users( array(
        'role__in' => array( 'patient' )
    ));
    $options = array();
  
    foreach ($patients as $patient) {
        $item = array('text' => $patient->data->user_login, 'value' => $patient->data->user_login);
        array_push($options , $item);
    }
  
    return $options;
}
  
function isImageUrl($url) {
    // Use getimagesize to fetch image information
    $imageInfo = getimagesize($url);
  
    // Check if getimagesize was successful and if it's an image
    if ($imageInfo !== false && ($imageInfo[2] === IMAGETYPE_GIF || $imageInfo[2] === IMAGETYPE_JPEG || $imageInfo[2] === IMAGETYPE_PNG || $imageInfo['mime'] === 'image/webp' )) {
        return true; // It's an image
    } else {
        return false; // It's not an image
    }
}

function get_next_user_id() {
    global $wpdb;

    // Get the highest user ID from the wp_users table
    $max_user_id = $wpdb->get_var("SELECT MAX(ID) FROM $wpdb->users");

    // Increment the highest user ID to get the next user ID
    $next_user_id = $max_user_id + 1;

    return $next_user_id;
}

function insert_patient_id($patient_id , $patient_id_num){

    global $wpdb;

    $table_name = $wpdb->prefix . 'patient_ids';

    $data = array(
        'patient_id'  => $patient_id,
        'patient_id_num' => $patient_id_num
    );

    $wpdb->insert($table_name, $data);

}

function check_patient_id_exist($patient_id_num) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'patient_ids';

    // Use $wpdb->get_var to get a single value from the database
    $existing_patient_id_num = $wpdb->get_var(
        $wpdb->prepare("SELECT patient_id_num FROM $table_name WHERE patient_id_num = %s", $patient_id_num)
    );

    if ($existing_patient_id_num !== null) {
        return true;
    } else {
        return false;
    }
}

function get_latest_prescription_date($patient_post_id) {

    $other_prescription_data = get_field('other_prescription_data' , $patient_post_id);
    $prescription_date_3 = get_field('prescription_date_3' , $patient_post_id);
    $prescription_date_2 = get_field('prescription_date_2' , $patient_post_id);
    $prescription_date_1 = get_field('prescription_date_1' , $patient_post_id);

    if( !empty($other_prescription_data) ){
        $last_payment = end($other_prescription_data);

        return $last_payment['prescription_date'];
    } elseif( $prescription_date_3 ) {
        return $prescription_date_3;
    } elseif( $prescription_date_2 ) {
        return $prescription_date_2;
    } elseif( $prescription_date_1 ) {
        return $prescription_date_1;
    } else {
        return false;
    }

}

function get_latest_prescription_note($patient_post_id) {

    $other_prescription_data = get_field('other_prescription_data' , $patient_post_id);
    $prescription_note_3 = get_field('prescription_note_3' , $patient_post_id);
    $prescription_note_2 = get_field('prescription_note_2' , $patient_post_id);
    $prescription_note_1 = get_field('prescription_note_1' , $patient_post_id);

    if( !empty($other_prescription_data) ){
        $last_payment = end($other_prescription_data);

        return $last_payment['prescription_note'];
    } elseif( $prescription_note_3 ) {
        return $prescription_note_3;
    } elseif( $prescription_note_2 ) {
        return $prescription_note_2;
    } elseif( $prescription_note_1 ) {
        return $prescription_note_1;
    } else {
        return false;
    }

}

function check_valid_patinet($patient_id) {

    $patient_post_id = get_user_meta( $patient_id, 'patient_info', true );
    $csr_file = get_field('csr_file', $patient_post_id);
    $photo_id = get_field('photo_id', $patient_post_id);

    if( $csr_file && $photo_id ) {
        return true;
    }

    return false;

}

function get_admin_email() {

    return get_field('admin_email' , 'option') ? get_field('admin_email' , 'option') : get_option('admin_email');

}

function check_patient_email_exist($email) {
    $patients_loop = new WP_Query(
        array(
            'post_type' => 'marucanna-patients',
            'posts_per_page' => '1',
            'meta_query' => array(
                array(
                    'key' => 'email',
                    'value' => $email,
                    'compare' => '=',
                ),
            ),
        )
    );

    if( $patients_loop->found_posts > 0 ) {
        return $patients_loop->posts[0]->ID;
    }

    return false;
}

function validatePhoneNumberUK($phoneNumber) {
    // Remove spaces and non-digit characters from the phone number
    $cleanedNumber = preg_replace('/\D/', '', $phoneNumber);

    // Define the UK phone number pattern
    $pattern = '/[0-9]{11}/';

    // Check if the cleaned number matches the pattern
    return preg_match($pattern, $cleanedNumber) === 1;
}

function validateNHSNumber($phoneNumber) {
    // Remove spaces and non-digit characters from the phone number
    $cleanedNumber = preg_replace('/\D/', '', $phoneNumber);

    // Define the UK phone number pattern
    $pattern = '/[0-9]{10}/';

    // Check if the cleaned number matches the pattern
    return preg_match($pattern, $cleanedNumber) === 1;
}

function get_need_follow_up_patients() {

    // Calculate the date 3 months ago
    $datetime_three_months_ago = date('Y-m-d H:i:s', strtotime('-3 months'));
    $date_three_months_ago = date('Y-m-d', strtotime('-3 months'));
    $follow_up_patients = array();

    // WP_Query arguments
    $args = array(
        'post_type'      => 'marucanna-patients',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $mc_consultation_date = get_field('mc_consultation_date');
            $last_followup_date = get_last_followup_date(get_the_ID());
            $name = get_field('name');

            if( $last_followup_date < $date_three_months_ago ) {
                $item = array(
                    'ID' => get_the_ID(),
                    'name' => $name,
                );
            } else if( $mc_consultation_date < $datetime_three_months_ago ) {
                $item = array(
                    'ID' => get_the_ID(),
                    'name' => $name,
                );
            }
            
            array_push($follow_up_patients , $item);
        }
    }
    wp_reset_postdata();

    return array_filter($follow_up_patients);

}

function get_last_followup_date($patient_post_id) {

    $follow_up_appointments = get_field('follow_up_appointments' , $patient_post_id);

    if( !empty($follow_up_appointments) ){
        $last_follow_up = end($follow_up_appointments);

        return $last_follow_up['appointment_date'];
    } else {
        return false;
    }

}

function get_all_gp_list_data(){

    $gp_lists = array();
    $query = new WP_Query(
        array(
            'post_type' => 'gp_list',
            'posts_per_page' => -1
        )
    );

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $practice_name = get_field('practice_name');
            $address_line1 = get_field('address_line1');
            $address_line2 = get_field('address_line2');
            $address_line3 = get_field('address_line3');
            $address_line4 = get_field('address_line4');
            $town = get_field('town');
            $postal_code = get_field('postal_code');
            $phone = get_field('phone');

            $item = array(
                'ID' => get_the_ID(),
                'practice_name' => $practice_name,
                'address_line1' => $address_line1,
                'address_line2' => $address_line2,
                'address_line3' => $address_line3,
                'address_line4' => $address_line4,
                'town' => $town,
                'postal_code' => $postal_code,
                'phone' => $phone,
            );
            
            array_push($gp_lists , $item);
        }
    }
    wp_reset_postdata();

    return array_filter($gp_lists);

}

function get_all_gp_postal_codes(){

    $postal_codes = array();
    $query = new WP_Query(
        array(
            'post_type' => 'gp_list',
            'posts_per_page' => -1
        )
    );

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $postal_code = get_field('postal_code');
            
            array_push($postal_codes , $postal_code);
        }
    }
    wp_reset_postdata();

    return array_unique($postal_codes);

}

function admin_letters_header() {
    $html = '<div class="logo"><img src="'.get_template_directory_uri().'/img/letter-logo.png" /></div>';
    $html .= '<div class="address"></div>';

    return $html;
}

function admin_letters_footer() {
    return get_field('letters_footer' , 'option');
}

//Need to fix this func
function get_feedback_url($patient_ID) {
    return get_field( 'feedback_survey_link', 'option' ).'?patient='.$patient_ID;
}

function check_patient_nhs_no_exist($nhs_no) {
    $patients_loop = new WP_Query(
        array(
            'post_type' => 'marucanna-patients',
            'posts_per_page' => '1',
            'meta_query' => array(
                array(
                    'key' => 'nhs_number',
                    'value' => $nhs_no,
                    'compare' => '=',
                ),
            ),
        )
    );

    if( $patients_loop->found_posts > 0 ) {
        return $patients_loop->posts[0]->ID;
    }

    return false;
}

function letter_pdf_styles() {
    return '<style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            text-align : center
        }
        .logo {
            margin: auto;
        }
        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
            font-size: 15px;
            margin-left: 2cm;
            margin-right: 2cm;
        }
    </style>';
}