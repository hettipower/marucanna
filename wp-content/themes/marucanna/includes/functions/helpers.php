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
    $imageInfo = @getimagesize($url);
  
    // Check if getimagesize was successful and if it's an image
    if ($imageInfo !== false && ($imageInfo[2] === IMAGETYPE_GIF || $imageInfo[2] === IMAGETYPE_JPEG || $imageInfo[2] === IMAGETYPE_PNG)) {
        return true; // It's an image
    } else {
        return false; // It's not an image
    }
}