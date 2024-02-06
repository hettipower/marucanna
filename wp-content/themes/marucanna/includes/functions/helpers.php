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
    $pattern = '/^(?:(?:\+44)|(?:0))(?:(?:(?:20|21|22|23|24|25|26|27|28|29)|(?:(?:11|12|13|14|15|16|17|18|19)(?:[0-9])))(?:[1-9](?:\d{0,8}))?)$/';

    // Check if the cleaned number matches the pattern
    return preg_match($pattern, $cleanedNumber) === 1;
}