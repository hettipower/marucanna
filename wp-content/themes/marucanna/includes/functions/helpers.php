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
    if ($imageInfo !== false && ($imageInfo[2] === IMAGETYPE_GIF || $imageInfo[2] === IMAGETYPE_JPEG || $imageInfo[2] === IMAGETYPE_PNG)) {
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