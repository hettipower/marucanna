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

    if (!checkRemoteFile($url)) {
        return false;
    }

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
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $patient = get_field('patient');

            $is_valid_patient = check_valid_patinet($patient);

            if( !$is_valid_patient ) {
                continue;
            }

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
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order'   => 'ASC',
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
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order'   => 'ASC',
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

function admin_letters_header($letter_name) {
    $site_logo = get_field('site_logo' , 'option');
    $html = '<table style="width:100%;margin-bottom:15px;">
            <tr>
                <td style="width: 170px;"><img style="width: 170px;" src="'.$site_logo['url'].'" /></td>
                <td>
                    <h4 style="background-color: #0c8e36;color: #fff;padding: 10px; width:100%; text-align: center;">'.$letter_name.'</h4>
                    <p style="color: #000;width:100%; text-align: center; margin: 10px 0 0;text-transform: uppercase;"><strong>Private and Confidential</strong></p>
                </td>
            </tr>
        </table>';
    $html .= '<div class="address">'.get_field( 'address', 'option' ).'</div>';

    return $html;
}

function admin_letters_footer() {
    return get_field('letters_footer' , 'option');
}

function get_feedback_url($patient_ID) {
    $url = get_field( 'feedback_survey_link', 'option' ).'?patient='.$patient_ID;
    return "<a href='$url'>click here</a>";
}

function check_patient_nhs_no_exist($nhs_no) {
    $patients_loop = new WP_Query(
        array(
            'post_type' => 'marucanna-patients',
            'posts_per_page' => -1,
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
        return true;
    }

    return false;
}

function letter_pdf_styles() {
    return '<style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
        .header {
            margin-left: 0;
            margin-right: 0;
            text-align : center;
            position: relative;
        }
        .logo {
            margin: auto;
        }
		.address {
            width: 100%;
			font-size: 13px;
            text-align : right;
		}
        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
            font-size: 15px;
            margin-left: 0;
            margin-right: 0;
            background-color: #9cc52b;
            color: #fff;
            padding: 5px 20px;
            text-align: center;
        }
        footer p {
            color: #fff;
        }
    </style>';
}

function calculate_average(array $numbers) {
    // Check if the array is not empty to avoid division by zero
    if (count($numbers) === 0) {
        return 0;
    }
    
    // Sum all the numbers in the array
    $sum = array_sum($numbers);
    
    // Calculate the average
    $average = $sum / count($numbers);
    
    return number_format($average , 2);
}

function calculate_percentage($totalObtained, $totalMax) {
    // Check if totalMax is greater than 0 to avoid division by zero
    if ($totalMax <= 0) {
        return 0;
    }
    
    // Calculate the percentage
    $percentage = ($totalObtained / $totalMax) * 100;
    
    return number_format($percentage , 2);
}

function mc_gf_save_file_to_attachment($entry , $file_field_id) {

    // Get the uploaded file URL
    $file_url = rgar($entry, $file_field_id);

    // Get the file path from the URL
    $file_path = str_replace(site_url(), ABSPATH, $file_url);

    // Get the file name
    $file_name = basename($file_path);

    // Prepare the attachment data
    $attachment = array(
        'post_title'     => $file_name,
        'post_content'   => '',
        'post_status'    => 'inherit',
        'post_mime_type' => wp_check_filetype($file_name)['type'],
    );

    // Insert the attachment into the media library
    $attachment_id = wp_insert_attachment($attachment, $file_path);

    // Update the entry with the attachment ID
    gform_update_meta($entry['id'], $file_field_id, $attachment_id);

    return $attachment_id;

}

function get_latest_mdt_date($patient_post_id) {

    $meetings = get_field('meetings' , $patient_post_id);

    if( !empty($meetings) ){
        $last_meeting = end($meetings);

        return $last_meeting['date'];
    } else {
        return false;
    }

}

function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);
    if($result !== FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_last_payment_date($patient_post_id) {

    $other_payments = get_field('other_payments' , $patient_post_id);
    $transaction_id_3 = get_field('transaction_id_3' , $patient_post_id);
    $transaction_id_2 = get_field('transaction_id_2' , $patient_post_id);
    $transaction_id_1 = get_field('transaction_id_1' , $patient_post_id);

    if( !empty($other_payments) ){
        $last_payment = end($other_payments);
        return $last_payment['transaction_id'];
    } elseif( $transaction_id_3 ) {
        return $transaction_id_3;
    } elseif( $transaction_id_2 ) {
        return $transaction_id_2;
    } elseif( $transaction_id_1 ) {
        return $transaction_id_1;
    } else {
        return false;
    }

}