<?php

use Dompdf\Dompdf;
use Dompdf\Options;

add_action('add_meta_boxes', 'mc_patient_consent_sidebar_metabox');
function mc_patient_consent_sidebar_metabox() {
    add_meta_box(
        'mc_patient_consent_button',
        'Patient Consent',
        'mc_patient_consent_button_content',
        'marucanna-patients', // Replace with your custom post type slug
        'side',
        'default'
    );

	add_meta_box(
        'mc_patient_file_download',
        'Patient File',
        'mc_patient_file_download_content',
        'marucanna-patients', // Replace with your custom post type slug
        'side',
        'default'
    );

    add_meta_box(
        'mc_patient_letters',
        'Patient Letters',
        'mc_patient_letters_content',
        'marucanna-patients', // Replace with your custom post type slug
        'side',
        'default'
    );
}

function mc_patient_consent_button_content($post) {

	$consent_url = admin_url( 'admin-post.php?action=sent_consent_form&patient='.get_the_ID() );
	$send_consent = get_post_meta( get_the_ID(), 'send_consent', true );
	$consent_date = get_field('consent_date' , get_the_ID());
	$patient = get_the_ID();

	if( $send_consent ) {
		if( $consent_date ) {
			echo '<p><strong>The patient has given consent.</strong></p>';
		} else {
			echo '<p><strong>The Patient Consent email has been sent.</strong></p><p><a href="#" class="button action" id="send_consent" data-patient="'.$patient.'">Resend</a></p>';
		}
	} else {
		echo '<a href="#" class="button action" id="send_consent" data-patient="'.$patient.'">Send Consent</a>';
	}
}

function mc_patient_file_download_content($post) {

	$patient_file_url = admin_url( 'admin-post.php?action=create_patient_file_pdf&patient='.get_the_ID() );

	echo '<a href="'.$patient_file_url.'" class="button action">Download Patient File</a>';
}

function mc_patient_letters_content($post) {

    $patient = get_the_ID();
    $send_initial_consult_letter = get_post_meta( get_the_ID(), 'send_initial_consult_letter', true );
    $send_after_mdt = get_post_meta( get_the_ID(), 'send_after_mdt', true );
    $send_refusal_following_mdt = get_post_meta( get_the_ID(), 'send_refusal_following_mdt', true );
    $send_stopping_after_follow_up = get_post_meta( get_the_ID(), 'send_stopping_after_follow_up', true );

    $initial_consult_letter_date = get_post_meta( get_the_ID(), 'initial_consult_letter_date', true );
    $after_mdt_date = get_post_meta( get_the_ID(), 'after_mdt_date', true );
    $refusal_following_mdt_date = get_post_meta( get_the_ID(), 'refusal_following_mdt_date', true );
    $follow_up_letter_date = get_post_meta( get_the_ID(), 'follow_up_letter_date', true );
    $after_followup_appointment_date = get_post_meta( get_the_ID(), 'after_followup_appointment_date', true );
    $stopping_after_follow_up_date = get_post_meta( get_the_ID(), 'stopping_after_follow_up_date', true );

    ?>

    <div id="letter-loading"><div class="sk-chase"><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div></div></div>

    <table class="wp-list-table widefat fixed striped table-view-list posts" cellspacing="0">
        <thead>
            <tr>
                <th class="manage-column" scope="col">Action/Note</th>
                <th class="manage-column" scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                        if( $send_initial_consult_letter ) {
                            echo '<p><strong>Initial Consult Letter has been sent.</strong></p>';
                        } else {
                            echo '<p><button class="button action" id="send_initial_consult" data-patient="'.$patient.'" >Send Initial Consult Letter</button></p>';
                        }
                    ?>
                </td>
                <td><?php echo $initial_consult_letter_date; ?></td>
            </tr>
            <tr>
                <td>
                    <?php
                        if( $send_after_mdt ) {
                            echo '<p><strong>First Letter after MDT has been sent.</strong></p>';
                        } else {
                            echo '<p><button class="button action" id="send_after_mdt" data-patient="'.$patient.'" >Send First Letter after MDT</button></p>';
                        }
                    ?>
                </td>
                <td><?php echo $after_mdt_date; ?></td>
            </tr>
            <tr>
                <td>
                    <?php
                        if( $send_refusal_following_mdt ) {
                            echo '<p><strong>Refusal Following MDT Letter has been sent.</strong></p>';
                        } else {
                            echo '<p><button class="button action" id="send_refusal_following_mdt" data-patient="'.$patient.'" >Send Refusal Following MDT Letter</button></p>';
                        }
                    ?>
                </td>
                <td><?php echo $refusal_following_mdt_date; ?></td>
            </tr>
            <tr>
                <td>
                    <?php
                        echo '<p><button class="button action" id="send_follow_up_letter" data-patient="'.$patient.'" >Send Follow up Letter</button></p>';
                    ?>
                </td>
                <td><?php echo $follow_up_letter_date; ?></td>
            </tr>
            <tr>
                <td>
                    <?php
                        echo '<p><button class="button action" id="send_after_followup_appointment" data-patient="'.$patient.'" >Send Change after a follow up appointment Letter</button></p>';
                    ?>
                </td>
                <td><?php echo $after_followup_appointment_date; ?></td>
            </tr>
            <tr>
                <td>
                    <?php
                        if( $send_stopping_after_follow_up ) {
                            echo '<p><strong>Stopping after follow up Letter has been sent.</strong></p>';
                        } else {
                            echo '<p><button class="button action" id="send_stopping_after_follow_up" data-patient="'.$patient.'" >Send Stopping after follow up Letter</button></p>';
                        }
                    ?>
                </td>
                <td><?php echo $stopping_after_follow_up_date; ?></td>
            </tr>
        </tbody>
    </table>
    
    <?php
}

add_action( 'wp_ajax_send_initial_consult_letter_action', 'mc_send_initial_consult_letter' );
function mc_send_initial_consult_letter() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    $cannabinoid_history = (isset($_REQUEST['cannabinoid_history'])) ? $_REQUEST['cannabinoid_history'] : '';
    $current_diagnosis = (isset($_REQUEST['current_diagnosis'])) ? $_REQUEST['current_diagnosis'] : '';
    $doctor = (isset($_REQUEST['doctor'])) ? $_REQUEST['doctor'] : '';
    $key_symptoms = (isset($_REQUEST['key_symptoms'])) ? $_REQUEST['key_symptoms'] : '';
    $previous_management = (isset($_REQUEST['previous_management'])) ? $_REQUEST['previous_management'] : '';

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $payment_date_1 = get_field('payment_date_1' , $patient);
        $dob = get_field('dob' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $patient_id = get_field('patient_id' , $patient);
        
        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";

        $letter_content = get_field('initial_consult_letter' , 'option');
        $letter_name = "Initial Consult Letter";

        $replacements = array(
            'patient_name_address' => "$name, $address_line_1, $address_line_2",
            'initial_consultation_date' => $payment_date_1,
            'patient_name' => $name,
            'dob' => $dob,
            'nhs_no' => $nhs_number,
            'key_symptoms' => $key_symptoms,
            'current_diagnosis' => $current_diagnosis,
            'previous_management' => $previous_management,
            'cannabinoid_history' => $cannabinoid_history,
            'doctor' => $doctor,
            'feedback_link' => get_feedback_url($patient)
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body><footer>';
                    $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/initial-consult-letter-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "Initial Consult Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>' );

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }

        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        if ( ! add_post_meta( $patient, 'send_initial_consult_letter', true, true ) ) { 
            update_post_meta ( $patient, 'send_initial_consult_letter', true );
        }

        update_post_meta ( $patient, 'initial_consult_letter_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'Initial Consult Letter has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}

add_action( 'wp_ajax_send_after_mdt_letter_action', 'mc_send_after_mdt_letter' );
function mc_send_after_mdt_letter() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $meeting_date = get_latest_mdt_date($patient);
        $dob = get_field('dob' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $patient_id = get_field('patient_id' , $patient);
        
        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";

        $letter_content = get_field('first_letter_after_mdt' , 'option'); 
        $letter_name = "First Letter after MDT";

        $replacements = array(
            'patient_name_address' => "$name, $address_line_1, $address_line_2",
            'mdt_date' => $meeting_date,
            'patient_name' => $name,
            'dob' => $dob,
            'nhs_no' => $nhs_number,
            'feedback_link' => get_feedback_url($patient)
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body>

                <footer>';
                $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/first-letter-after-mdt-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "First Letter after MDT Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>');

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }

        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        if ( ! add_post_meta( $patient, 'send_after_mdt', true, true ) ) { 
            update_post_meta ( $patient, 'send_after_mdt', true );
        }

        update_post_meta ( $patient, 'after_mdt_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'First Letter after MDT has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}

add_action( 'wp_ajax_send_refusal_following_mdt_letter_action', 'mc_send_refusal_following_mdt_letter' );
function mc_send_refusal_following_mdt_letter() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    $refusal = (isset($_REQUEST['refusal'])) ? $_REQUEST['refusal'] : '';
    $doctor = (isset($_REQUEST['doctor'])) ? $_REQUEST['doctor'] : '';

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $patient_id = get_field('patient_id' , $patient);
        
        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";

        $letter_content = get_field('refusal_following_mdt' , 'option');
        $letter_name = "Refusal Following MDT Letter";

        $replacements = array(
            'patient_name' => $name,
            'refusal' => $refusal,
            'doctor' => $doctor,
            'feedback_link' => get_feedback_url($patient),
            'gp_details' => $gp_details,
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body>

                <footer>';
                $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/refusal-following-mdt-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "Refusal Following MDT Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>');

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }

        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        if ( ! add_post_meta( $patient, 'send_refusal_following_mdt', true, true ) ) { 
            update_post_meta ( $patient, 'send_refusal_following_mdt', true );
        }

        update_post_meta ( $patient, 'refusal_following_mdt_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'Refusal Following MDT Letter has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}

add_action( 'wp_ajax_send_follow_up_letter_action', 'mc_send_follow_up_letter' );
function mc_send_follow_up_letter() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $meeting_date = get_latest_mdt_date($patient);
        $dob = get_field('dob' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $patient_id = get_field('patient_id' , $patient);

        $letter_content = get_field('follow_up_letter' , 'option');
        $latest_prescription_date = get_latest_prescription_date($patient);
        $latest_prescription_note = get_latest_prescription_note($patient);
        $latest_followup_date = get_last_followup_date($patient);

        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";
        $letter_name = "Follow up Letter";

        $replacements = array(
            'patient_name_address' => "$name, $address_line_1, $address_line_2",
            'mdt_date' => $meeting_date,
            'patient_name' => $name,
            'dob' => $dob,
            'nhs_no' => $nhs_number,
            'feedback_link' => get_feedback_url($patient),
            'latest_followup_date' => $latest_followup_date,
            'latest_prescription_date' => $latest_prescription_date,
            'latest_prescription_note' => $latest_prescription_note,
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body>

                <footer>';
                $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/follow-up-letter-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "Follow up Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>');

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }
        
        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        update_post_meta ( $patient, 'follow_up_letter_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'Follow up Letter has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}

add_action( 'wp_ajax_send_after_followup_appointment_letter_action', 'mc_send_after_followup_appointment_letter' );
function mc_send_after_followup_appointment_letter() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    $appointment_changes = (isset($_REQUEST['appointment_changes'])) ? $_REQUEST['appointment_changes'] : '';
    $doctor = (isset($_REQUEST['doctor'])) ? $_REQUEST['doctor'] : '';

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $meeting_date = get_latest_mdt_date($patient);
        $dob = get_field('dob' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $patient_id = get_field('patient_id' , $patient);

        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";

        $letter_content = get_field('after_followup_appointment' , 'option');
        $letter_name = "Change after a follow up Letter";

        $replacements = array(
            'patient_name' => $name,
            'nhs_no' => $nhs_number,
            'appointment_changes' => $appointment_changes,
            'doctor' => $doctor,
            'gp_details' => $gp_details,
            'feedback_link' => get_feedback_url($patient)
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body>

                <footer>';
                $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/after-followup-appointment-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "Change after a follow up appointment Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>');

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }
        
        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        update_post_meta ( $patient, 'after_followup_appointment_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'Change after a follow up appointment Letter has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}

add_action( 'wp_ajax_send_stopping_after_follow_up_action', 'mc_send_stopping_after_follow_up' );
function mc_send_stopping_after_follow_up() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    $discontinuation = (isset($_REQUEST['discontinuation'])) ? $_REQUEST['discontinuation'] : '';
    $doctor = (isset($_REQUEST['doctor'])) ? $_REQUEST['doctor'] : '';

    if( $patient ) {

        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $meeting_date = get_latest_mdt_date($patient);
        $dob = get_field('dob' , $patient);
        $nhs_number = get_field('nhs_number' , $patient);
        $patient_id = get_field('patient_id' , $patient);

        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);

        $gp_details = "$gp_name <br/> $practice_name <br/> $gp_address_line_1 <br/> $gp_address_line_2 <br/> $gp_town <br/> $gp_country <br/> $gp_postal_code <br/> $gp_phone";

        $letter_content = get_field('stopping_after_follow_up' , 'option');
        $letter_name = "Stopping after follow up Letter";

        $replacements = array(
            'patient_name' => $name,
            'discontinuation' => $discontinuation,
            'doctor' => $doctor,
            'gp_details' => $gp_details,
            'feedback_link' => get_feedback_url($patient)
        );

        foreach ($replacements as $placeholder => $value) {
            $placeholder_with_braces = '{' . $placeholder . '}';
            $letter_content = str_replace($placeholder_with_braces, $value, $letter_content);
        }

        $html = '<html>
            <head>'.letter_pdf_styles().'</head>
            <body>

                <footer>';
                $html .= admin_letters_footer();
                $html .= '</footer>
                <main><div class="header">';
                    $html .= admin_letters_header($letter_name);
                $html .= '</div>';
                    $html .= $letter_content;
                $html .= '</main>
            </body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Get PDF content
        $pdf_content = $dompdf->output();
        $file_path = wp_upload_dir()['path'] . '/stopping-after-follow-up-'.$patient_id.'.pdf';
        file_put_contents($file_path, $pdf_content);

        //Patient Email
        $subjectPatient = "Stopping after follow up Letter - $patient_id - $nhs_number";
        $htmlPatient .= '<p>Please find the attached document</p>';
        $htmlPatient .= "<table style='width: 500px;'>
            <tbody>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>Patient ID</th>
                    <td>$patient_id</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>NHS Number</th>
                    <td>$nhs_number</td>
                </tr>
                <tr>
                    <th style='text-align: left;vertical-align: top;'>GP Details</th>
                    <td>$gp_details</td>
                </tr>
            </tbody>
        </table>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The MARUCANNA Team <noreply@marucanna.co.uk>');

        $letter_emails = explode(",",get_field('letter_emails' , 'option'));
        if( is_array($letter_emails) ) {
            for ($i=0; $i < count($letter_emails); $i++) { 
                $headers[] = 'Bcc: <'.$letter_emails[$i].'>';
            }
        }
        
        // Attach the PDF
        $attachments = array($file_path);

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers , $attachments );

        if ( ! add_post_meta( $patient, 'send_stopping_after_follow_up', true, true ) ) { 
            update_post_meta ( $patient, 'send_stopping_after_follow_up', true );
        }

        update_post_meta ( $patient, 'stopping_after_follow_up_date', date('Y-m-d') );

        unlink($file_path);

        $results['status'] = true;
		$results['msg'] = 'Stopping after follow up Letter has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    } 

    echo json_encode($results);
    wp_die();

}