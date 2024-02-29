<?php
use Dompdf\Dompdf;
use Dompdf\Options;

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
    $new_user_ID = get_next_user_id();
    $patient_id_num = $new_user_ID.time();

    if( !check_patient_id_exist($patient_id_num) ) {
        $patient_ID = "MP-".$patient_id_num;
    } else {
        $patient_id_num = $new_user_ID.time();
        $patient_ID = "MP-".$patient_id_num;
    }
    
    $password = wp_generate_password(15 , false);

    if($fname && $email && $contact_no) {
        if(!validatePhoneNumberUK($contact_no)) {
            $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=Please enter valid Contact Number.'.'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
        } elseif(email_exists($email)) {
            $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=User exists.'.'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
        } else {

            $is_email_exist = check_patient_email_exist($email);

            if( !$is_email_exist ) {

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
            
                    if($eligibility_q1 && !$eligibility_q5) {
                        $eligibility = 'Eligible';
                    }else{
                        $eligibility = 'Unqualified';
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
                            update_field('patient_id', $patient_ID , $patient_post_id);
    
                            //Add Patiet ID to DB
                            insert_patient_id($patient_ID , $patient_id_num);
                
                            $return_url = get_field('booking_page' , 'option').'?patient='.$user_id.'&booking='.$patient_post_id;
                
                        } else {
                            $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$user_id->get_error_message().'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
                        }
            
                    }else{
                        $return_url = get_field('check_eligibility_page' , 'option').'?status=2&mgs=You are not Eligible.'.'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
                    }
            
                } else {
                    $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$patient_post_id->get_error_message().'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
                }
            } else {

                update_post_meta( $is_email_exist, 'eligibility_q1', wp_slash( $eligibility_q1 ) );
                update_post_meta( $is_email_exist, 'eligibility_q2', wp_slash( $eligibility_q2 ) );
                update_post_meta( $is_email_exist, 'eligibility_q3', wp_slash( $eligibility_q3 ) );
                update_post_meta( $is_email_exist, 'eligibility_q4', wp_slash( $eligibility_q4 ) );
                update_post_meta( $is_email_exist, 'eligibility_q5', wp_slash( $eligibility_q5 ) );
        
                update_field('name', $fname , $is_email_exist);
                update_field('email', $email , $is_email_exist);
                update_field('phone', $contact_no , $is_email_exist);
        
                if($eligibility_q1 && !$eligibility_q5) {
                    $eligibility = 'Eligible';
                }else{
                    $eligibility = 'Unqualified';
                }

                update_field('eligibility', $eligibility , $is_email_exist);
            
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
                        add_user_meta($user_id, 'patient_info', $is_email_exist);
                        add_user_meta($user_id, 'consultant', false);

                        update_field('patient', $user_id , $is_email_exist);
                        update_field('patient_id', $patient_ID , $is_email_exist);

                        //Add Patiet ID to DB
                        insert_patient_id($patient_ID , $patient_id_num);
            
                        $return_url = get_field('booking_page' , 'option').'?patient='.$user_id.'&booking='.$is_email_exist;
            
                    } else {
                        $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs='.$user_id->get_error_message().'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
                    }
        
                }else{
                    $return_url = get_field('check_eligibility_page' , 'option').'?status=2&mgs=You are not Eligible.'.'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
                }

            }
        }
    } else {
        $return_url = get_field('check_eligibility_page' , 'option').'?status=0&mgs=Please fill in all required fields.'.'&fname='.$fname.'&email='.$email.'&contact='.$contact_no;
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

    $csr_attachment_id = mc_gf_save_file_to_attachment($entry , '110');
    $photo_attachment_id = mc_gf_save_file_to_attachment($entry , '111');
	
	$payment_date_1 = rgar( $entry, 'payment_date' );
	$transaction_id_1 = rgar( $entry, 'transaction_id' );

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

        update_field('csr_file', $csr_attachment_id , $booking);
        update_field('photo_id', $photo_attachment_id , $booking);
		
		update_field('payment_date_1', $payment_date_1 , $booking);
		update_field('transaction_id_1', $transaction_id_1 , $booking);
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

add_filter( 'gform_phone_formats', 'uk_phone_format' );
function uk_phone_format( $phone_formats ) {
    $phone_formats['uk'] = array(
        'label'       => 'UK',
        'mask'        => '999 9999 9999',
        'regex'       => '/^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/',
        'instruction' => false,
    );
 
    return $phone_formats;
}

if (class_exists('GF_Field')) {
    class FoodDelivery extends GF_Field {
        public $type = 'adverse_effect';
 
        public $choices = [
            [ 'text' => 'Nausea' ],
            [ 'text' => 'Vomiting' ],
            [ 'text' => 'Dizziness' ],
            [ 'text' => 'Dry Mouth' ],
            [ 'text' => 'Fatigue' ],
            [ 'text' => 'Sleep Disturbances' ],
            [ 'text' => 'Mood Changes' ],
            [ 'text' => 'Anxiety' ],
            [ 'text' => 'Confusion' ],
            [ 'text' => 'Headaches' ],
            [ 'text' => 'Memory Impairment' ],
            [ 'text' => 'Increased Heart Rate' ],
            [ 'text' => 'Coordination Problems' ],
            [ 'text' => 'Gastrointestinal Problems' ],
            [ 'text' => 'Other (specify)' ],
        ];
 
        private $field_coumns = ['Severity (0-3)', 'Onset Date', 'Description (if any)'];
 
        public function get_form_editor_field_title() {
            return esc_attr__('Adverse Effect', 'marucanna');
        }
 
        public function get_form_editor_button() {
            return [
                'group' => 'advanced_fields',
                'text'  => $this->get_form_editor_field_title(),
            ];
        }
 
        public function get_form_editor_field_settings() {
            return [
                'label_setting',
                'choices_setting',
                'description_setting',
                'rules_setting',
                'error_message_setting',
                'css_class_setting',
                'conditional_logic_field_setting',
                'label_placement_setting',
            ];
        }
 
        public function is_value_submission_array() {
            return true;
        }
 
        public function get_field_input($form, $value = '', $entry = null) {
            if ($this->is_form_editor()) {
                return '';
            }
 
            $id = (int) $this->id;
            
            if ($this->is_entry_detail()) {
                $table_value = maybe_unserialize($value);
            } else {
                $table_value = $this->translateValueArray($value);
            }
 
            $table = '<div class="table-responsive">
            <table class="table adverse-effect"><thead><tr>';
            $table .= '<th>' . __('Adverse Effect', 'marucanna') . '</th>';
            foreach ($this->field_coumns as $day) {
                $table .= '<th>' . $day . '</th>';
            }
            $table .= '</tr></thead>';
 
            $table .= '<tbody>';
            foreach ($this->choices as $course) {
                $table .= '<tr>';
                $table .= '<td class="text-box">' . $course['text'] . '</td>';
                foreach ($this->field_coumns as $day) {
                    if( $day == 'Onset Date' ) {
                        $table .= '<td class="datepicker_wrap"><input type="text" class="datepicker gform-datepicker mdy datepicker_no_icon gdatepicker-no-icon" name="input_' . $id . '[]" value="' . $table_value[$course['text']][$day] . '" placeholder="mm/dd/yyyy" /></td>';
                    } elseif( $day == 'Severity (0-3)' ){
                        $table .= '<td><input type="number" size="1" min="0" max="3" class="large" name="input_' . $id . '[]" value="' . $table_value[$course['text']][$day] . '" /></td>';
                    } else {
                        $table .= '<td class="description"><input type="text" class="large" name="input_' . $id . '[]" value="' . $table_value[$course['text']][$day] . '" /></td>';
                    }
                }
                $table .= '</tr>';
            }
 
            $table .= '</tbody></table></div>';
 
            return $table;
        }
 
        private function translateValueArray($value) {
            if (empty($value)) {
                return [];
            }
            $table_value = [];
            $counter = 0;
            foreach ($this->choices as $course) {
                foreach ($this->field_coumns as $day) {
                    $table_value[$course['text']][$day] = $value[$counter++];
                }
            }
            return $table_value;
        }
 
        public function get_value_save_entry($value, $form, $input_name, $lead_id, $lead) {
            if (empty($value)) {
                $value = '';
            } else {
                $table_value = $this->translateValueArray($value);
                $value = serialize($table_value);
            }
            return $value;
        }
 
        private function prettyListOutput($value) {
            $str = '<ul>';
            foreach ($value as $course => $days) {
                $week = '';
                foreach ($days as $day => $delivery_number) {
                    if (!empty($delivery_number)) {
                        $week .= '<li>' . $day . ': ' . $delivery_number . '</li>';
                    }
                }
                // Only add week if there were any requests at all
                if (!empty($week)) {
                    $str .= '<li><h3>' . $course . '</h3><ul class="days">' . $week . '</ul></li>';
                }
            }
            $str .= '</ul>';
            return $str;
        }
 
        public function get_value_entry_list($value, $entry, $field_id, $columns, $form) {
            return __('Enter details to see delivery details', 'marucanna');
        }
 
        public function get_value_entry_detail($value, $currency = '', $use_text = false, $format = 'html', $media = 'screen') {
            $value = maybe_unserialize($value);		
            if (empty($value)) {
                return $value;
            }
            $str = $this->prettyListOutput($value);
            return $str;
        }
 
        public function get_value_merge_tag($value, $input_id, $entry, $form, $modifier, $raw_value, $url_encode, $esc_html, $format, $nl2br) {
            return $this->prettyListOutput($value);
        }
 
        public function is_value_submission_empty($form_id) {
            $value = rgpost('input_' . $this->id);
            foreach ($value as $input) {
                if (strlen(trim($input)) > 0) {
                    return false;
                }
            }
            return true;
        }
    }
    GF_Fields::register(new FoodDelivery());
}

add_action( 'gform_after_submission_7', 'mc_create_follow_up_pdf', 10, 2 );
function mc_create_follow_up_pdf( $entry, $form ) {
  
    $current_date = date('d/m/Y');
    $patient = rgar( $entry, '28' );
    $patient_post_id = rgar( $entry, '29' );
    $name = rgar( $entry, '3' );
    $date_of_birth = rgar( $entry, '4' );
    $date_of_assessment = rgar( $entry, '5' );
    $healthcare = rgar( $entry, '6' );
    $baseline_info_1 = rgar( $entry, '10' );
    $baseline_info_2 = rgar( $entry, '12' );
    $baseline_info_3 = rgar( $entry, '11' );
    $baseline_info_4 = rgar( $entry, '13' );
    $adverse_effects = maybe_unserialize(rgar( $entry, '19' ));
    $impact  = rgar( $entry, '21' );
    $additional_comments = rgar( $entry, '23' );
    $recommendations = rgar( $entry, '25' ); 
    
    $upload_dir = wp_upload_dir();
    $follow_up_dir = $upload_dir['basedir'] . '/follow_ups/';
    $follow_up_url = $upload_dir['url'] . '/follow_ups/';
    $site_logo = get_template_directory_uri() . '/img/logo.png';

    $html = '<html>
    <body>
    <table style="width:100%;margin-bottom:15px;">
        <tr>
            <td style="width: 170px;"><img style="width: 170px;" src="'.$site_logo.'" /></td>
            <td>
                <h4 style="background-color: #0c8e36;color: #fff;padding: 10px; width:100%; text-align: center;">Medicinal Cannabis follow up and Adverse Effects Assessment Questionnaire</h4>
                <h4 style="text-align: right;color: #000;">Confidential Document</h4>
            </td>
        </tr>
    </table>
    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Patient Information:</h4>
    <ul>
        <li>Name: '.$name.'</li>
        <li>Date of Birth: '.$date_of_birth.'</li>
        <li>Date of Assessment: '.$date_of_assessment.'</li>
        <li>Healthcare Provider: '.$healthcare.'</li>
    </ul>
    <p><strong>Instructions:</strong> Please answer the following questionsto the best of your ability. Be honest and specific about
    any symptoms or experiences you\'ve had since starting medicinal cannabis treatment.</p>
    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Section 1: Baseline Information</h4>
    <ol>
        <li><strong>Diagnosis/Condition Requiring Medicinal Cannabis:</strong> '.$baseline_info_1.'</li>
        <li><strong>Date Started Medicinal Cannabis Treatment:</strong> '.$baseline_info_2.'</li>
        <li><strong>Cannabis-Based Product Name (if known):</strong> '.$baseline_info_3.'</li>
        <li><strong>On a scale of 1-5 (1 the least 5 the most), how much improvement has there been of your medical
    condition?</strong> '.$baseline_info_4.'</li>
    </ol>

    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Section 2: Adverse Effects Assessment</h4>
    <p>Please mark the appropriate box for each item below:</p>
    <p><em>(Use a scale from 0 to 3, where 0 = None, 1 = Mild, 2 = Moderate, 3 = Severe)</em></p>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Adverse Effect</th>
                <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Severity (0-3)</th>
                <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Onset Date</th>
                <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Description (if any)</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($adverse_effects as $effect => $data) {
            $item = ''; 
            foreach ($data as $dataItem) {
                $item .= '<td>'.$dataItem.'</td>';
            }
            
            $html .= '<tr><td>'.$effect.'</td>'.$item.'</tr>';
        }
    $html .= '</tbody>
    </table>

    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Section 3: Impact on Daily Life</h4>
    <ul>
        <li><strong>Please describe how the adverse effects have affected your daily life, including work, social
    activities, and personal well-being.</strong> '.$impact.'</li>
    </ul>

    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Section 4: Additional Comments</h4>
    <ul>
        <li><strong>Do you have any other comments or concerns about your experience with medicinal
    cannabis treatment and its adverse effects?</strong> '.$additional_comments.'</li>
    </ul>

    <h4 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Section 5: Follow-up and Recommendations</h4>
    <ul>
        <li><strong>Based on your responses and our discussion, we may need to make adjustments to your
    treatment plan. Please check the appropriate box as to what you would prefer:</strong> '.$recommendations.'</li>
    </ul>
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

    $user = get_user_by('login', $patient);
    $pdf_name = 'follow-up-'.$patient.'-'.time().'.pdf';
    if ($user) {
        $pdf_name = 'follow-up-'.$user->username.'-'.time().'.pdf';
    }

    $pdf_path = $follow_up_dir . $pdf_name;
    file_put_contents($pdf_path, $pdf_content);
    
    if($patient_post_id) {

        $file_url = $follow_up_url . '/' . $pdf_name;

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

        // Generate attachment metadata and update the attachment
        //$attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
        //wp_update_attachment_metadata($attachment_id, $attachment_data);

        $existing_follow_up_appointments = get_field('follow_up_appointments' , $patient_post_id) ? get_field('follow_up_appointments' , $patient_post_id) : array();

        //Update Follow up Data
        $new_follow_up = array(
            'appointment_date' => $current_date,
            'appointment_file' => $attachment_id,
        );

        $existing_follow_up_appointments[] = $new_follow_up;

        update_field('follow_up_appointments', $existing_follow_up_appointments, $patient_post_id);
        
    }
    
}

add_action( 'gform_after_submission_8', 'mc_update_follow_up_payments', 10, 2 );
function mc_update_follow_up_payments( $entry, $form ) {
  
    $patient = rgar( $entry, '6' );
    $patient_post_id = rgar( $entry, '7' );

    $payment_date = rgar( $entry, 'payment_date' );
	$transaction_id = rgar( $entry, 'transaction_id' );
    
    if($patient_post_id) {

        $payment_date_2 = get_field('payment_date_2', $patient_post_id);
        $payment_date_3 = get_field('payment_date_3', $patient_post_id);
        $transaction_id_2 = get_field('transaction_id_2', $patient_post_id);
        $transaction_id_3 = get_field('transaction_id_3', $patient_post_id);
        $existing_other_payments = get_field('other_payments', $patient_post_id);
        $existing_follow_up_appointments = get_field('follow_up_appointments', $patient_post_id);

        if( !($payment_date_2 && $transaction_id_2) ) {
            update_field('payment_date_2', $payment_date , $patient_post_id);
            update_field('transaction_id_2', $transaction_id , $patient_post_id);
        } elseif( !($payment_date_3 && $transaction_id_3) ) {
            update_field('payment_date_3', $payment_date , $patient_post_id);
            update_field('transaction_id_3', $transaction_id , $patient_post_id);
        } else {
            // Create a new row of data
            $new_row = array(
                'payment_date' => $payment_date,
                'transaction_id' => $transaction_id,
            );

            $existing_other_payments[] = $new_row;

            update_field('other_payments', $existing_other_payments, $patient_post_id);
        }
        
    }
    
}

add_action( 'automated_follow_up_booking', 'mc_automated_follow_up_booking_cron' );
function mc_automated_follow_up_booking_cron() {

    $currentDate = new DateTime();
    $patients = new WP_Query("post_type=marucanna-patients&posts_per_page=-1");

    while ($patients->have_posts()) : $patients->the_post();

        $eligibility = get_field('eligibility');
        $patient_post = get_the_ID();
        $patient = get_field('patient');
        $patient_id = get_field('patient_id');
        $name = get_field('name');
        $patient_email = get_field('email');

        if( $eligibility == 'Eligible' ) {
            $follow_up_appointments = get_field('follow_up_appointments');
            $prescriptionDate = get_field('prescription_date_1');
            $prescriptionDateTime = DateTime::createFromFormat('d/m/Y', $prescriptionDate);

            $after_90_days = false;
            if( !empty($follow_up_appointments) ) {
                $follow_up_DateTime = DateTime::createFromFormat('d/m/Y', $follow_up_appointments[0]['appointment_date']);
                $after_90_days = $follow_up_DateTime->modify('+90 days');
            }

            $after_28_days = $prescriptionDateTime->modify('+28 days');

            $payment_url = home_url("payment?patient=$patient&patient_id=$patient_id&patient_post=$patient_post");

            if( $after_90_days ) {
                if( $currentDate >= $after_90_days ) {
                    $subject = 'Follow-Up after 90 days on Your Prescription Date';
                    $html .= "Dear $name,";
                    $html .= "<p>We hope this email finds you in good health. We appreciate you choosing Marucanna for your recent medical appointment.We trust that your experience was satisfactory.</p>";
                    $html .= "<p>As part of our commitment to providing quality healthcare, we would like to follow up with you to ensure that all your concerns were addressed during your visit.</p>";
                    $html .= "<p>Please click this <a href='$payment_url'>here</a> to follow up consultation</p>";
                    $html .= "<p>Best regards,</p>";
                    $html .= "<p>MARUCANNA</p>";
                    $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The Marucana Team <noreply@marucanna.co.uk>');
    
                    wp_mail( $patient_email, $subject, $html, $headers );
    
                }
            } elseif( $currentDate >= $after_28_days ) {
                $subject = 'Follow-Up after 28 days on Your Prescription Date';
                $html .= "Dear $name,";
                $html .= "<p>We hope this email finds you in good health. We appreciate you choosing Marucanna for your recent medical appointment.We trust that your experience was satisfactory.</p>";
                $html .= "<p>As part of our commitment to providing quality healthcare, we would like to follow up with you to ensure that all your concerns were addressed during your visit.</p>";
                $html .= "<p>Please click this <a href='$payment_url'>here</a> to follow up consultation</p>";
                $html .= "<p>Best regards,</p>";
                $html .= "<p>MARUCANNA</p>";
                $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The Marucana Team <noreply@marucanna.co.uk>');

                wp_mail( $patient_email, $subject, $html, $headers );
            }
            
        }

    endwhile; wp_reset_postdata();

}

add_action( 'gform_after_submission_9', 'mc_update_patient_contact_details', 10, 2 );
function mc_update_patient_contact_details( $entry, $form ) {
  
    $patient = rgar( $entry, '11' );
    $patient_post_id = rgar( $entry, '12' );
    $full_name = rgar( $entry, '1' );
    $email = rgar( $entry, '3' );
    $phone = rgar( $entry, '4' );
    $gender = rgar( $entry, '5' );
    $address_line_1 = rgar( $entry, '6.1' );
    $address_line_2 = rgar( $entry, '6.2' );
    $town = rgar( $entry, '7' );
    $country = rgar( $entry, '8.6' );
    $postcode = rgar( $entry, '9' );
    $dob = rgar( $entry, '10' );
    
    if($patient_post_id) {

        update_field('name', $full_name , $patient_post_id);
        update_field('email', $email , $patient_post_id);
        update_field('phone', $phone , $patient_post_id);
        update_field('gender', $gender , $patient_post_id);
        update_field('address_line_1', $address_line_1 , $patient_post_id);
        update_field('address_line_2', $address_line_2 , $patient_post_id);
        update_field('town', $town , $patient_post_id);
        update_field('country', $country , $patient_post_id);
        update_field('postcode', $postcode , $patient_post_id);
        update_field('dob', $dob , $patient_post_id);
        
    }
    
}

add_action( 'gform_after_submission_10', 'mc_update_patient_clinic_details', 10, 2 );
function mc_update_patient_clinic_details( $entry, $form ) {
  
    $patient = rgar( $entry, '15' );
    $patient_post_id = rgar( $entry, '16' );
    $referred_clinic = rgar( $entry, '1' );
    $clinic_name = rgar( $entry, '3' );
    $clinic_postcode = rgar( $entry, '6' );
    $clinic_phone_number = rgar( $entry, '7' );
    $gp_name = rgar( $entry, '8' );
    $practice_name = rgar( $entry, '9' );
    $gp_address_line_1 = rgar( $entry, '10.1' );
    $gp_address_line_2 = rgar( $entry, '10.2' );
    $gp_town = rgar( $entry, '11' );
    $gp_country = rgar( $entry, '12' );
    $gp_postal_code = rgar( $entry, '13' );
    $gp_phone = rgar( $entry, '14' );
    
    if($patient_post_id) {

        update_field('referred_clinic', $referred_clinic , $patient_post_id);
        update_field('clinic_name', $clinic_name , $patient_post_id);
        update_field('clinic_postcode', $clinic_postcode , $patient_post_id);
        update_field('clinic_phone_number', $clinic_phone_number , $patient_post_id);
        update_field('gp_name', $gp_name , $patient_post_id);
        update_field('practice_name', $practice_name , $patient_post_id);
        update_field('gp_address_line_1', $gp_address_line_1 , $patient_post_id);
        update_field('gp_address_line_2', $gp_address_line_2 , $patient_post_id);
        update_field('gp_town', $gp_town , $patient_post_id);
        update_field('gp_country', $gp_country , $patient_post_id);
        update_field('gp_postal_code', $gp_postal_code , $patient_post_id);
        update_field('gp_phone', $gp_phone , $patient_post_id);
        
    }
    
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

    // Generate attachment metadata and update the attachment
    //$attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
    //wp_update_attachment_metadata($attachment_id, $attachment_data);

    // Update the entry with the attachment ID
    gform_update_meta($entry['id'], $file_field_id, $attachment_id);

    return $attachment_id;

}

//Date of Birth Validation
add_filter('gform_field_validation_1_81', 'validate_date_of_birth', 10, 4);
add_filter('gform_field_validation_2_5', 'validate_date_of_birth', 10, 4);
add_filter('gform_field_validation_7_4', 'validate_date_of_birth', 10, 4);
add_filter('gform_field_validation_9_10', 'validate_date_of_birth', 10, 4);
function validate_date_of_birth($result, $value, $form, $field) {
    // Parse the submitted date
    $dob_timestamp = strtotime($value);

    // Calculate the minimum age required (18 years)
    $min_age_timestamp = strtotime('-18 years');

    // Check if the date of birth is at least 18 years ago
    if ($dob_timestamp > $min_age_timestamp) {
        $result['is_valid'] = false;
        $result['message'] = 'You must be at least 18 years old to submit this form.';
    }

    return $result;
}

add_action( 'admin_post_create_patient_file_pdf', 'mc_create_patient_file_pdf' );
function mc_create_patient_file_pdf() {

    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    
    if( $patient ) {
        
        $photo_id = get_field('photo_id' , $patient);
        $patient_id = get_field('patient_id' , $patient);
        $name = get_field('name' , $patient);
        $email = get_field('email' , $patient);
        $phone = get_field('phone' , $patient);
        $gender = get_field('gender' , $patient);
        $address_line_1 = get_field('address_line_1' , $patient);
        $address_line_2 = get_field('address_line_2' , $patient);
        $town = get_field('town' , $patient);
        $country = get_field('country' , $patient);
        $postcode = get_field('postcode' , $patient);
        $dob = get_field('dob' , $patient);

        $treatment = get_field('treatment' , $patient);
        $additional_notes = get_field('additional_notes' , $patient);
        $medical_history_1 = get_field('medical_history_1' , $patient);
        $medical_history_2 = get_field('medical_history_2' , $patient);
        $medical_history_3 = get_field('medical_history_3' , $patient);
        $medical_history_4 = get_field('medical_history_4' , $patient);
        $current_medical_condition_1 = get_field('current_medical_condition_1' , $patient);
        $current_medical_condition_2 = get_field('current_medical_condition_2' , $patient);
        $current_medical_condition_3 = get_field('current_medical_condition_3' , $patient);

        $referred_clinic = get_field('referred_clinic' , $patient);
        $clinic_name = get_field('clinic_name' , $patient);
        $clinic_postcode = get_field('clinic_postcode' , $patient);
        $clinic_phone_number = get_field('clinic_phone_number' , $patient);
        $gp_name = get_field('gp_name' , $patient);
        $practice_name = get_field('practice_name' , $patient);
        $gp_address_line_1 = get_field('gp_address_line_1' , $patient);
        $gp_address_line_2 = get_field('gp_address_line_2' , $patient);
        $gp_town = get_field('gp_town' , $patient);
        $gp_country = get_field('gp_country' , $patient);
        $gp_postal_code = get_field('gp_postal_code' , $patient);
        $gp_phone = get_field('gp_phone' , $patient);
        $csr_file = get_field('csr_file' , $patient);
        $follow_up_appointments = get_field('follow_up_appointments' , $patient);
        
        $payment_date_1 = get_field('payment_date_1' , $patient);
        $payment_date_2 = get_field('payment_date_2' , $patient);
        $payment_date_3 = get_field('payment_date_3' , $patient);
        $transaction_id_1 = get_field('transaction_id_1' , $patient);
        $transaction_id_2 = get_field('transaction_id_2' , $patient);
        $transaction_id_3 = get_field('transaction_id_3' , $patient);
        $other_payments = get_field('other_payments' , $patient);

        $prescription_date_1 = get_field('prescription_date_1' , $patient);
        $prescription_date_2 = get_field('prescription_date_2' , $patient);
        $prescription_date_3 = get_field('prescription_date_3' , $patient);
        $prescription_note_1 = get_field('prescription_note_1' , $patient);
        $prescription_note_2 = get_field('prescription_note_2' , $patient);
        $prescription_note_3 = get_field('prescription_note_3' , $patient);
        $other_prescription_data = get_field('other_prescription_data' , $patient);

        $mc_information_1 = get_field('mc_information_1' , $patient);
        $mc_medical_history_1 = get_field('mc_medical_history_1' , $patient);
        $mc_medical_history_2 = get_field('mc_medical_history_2' , $patient);
        $mc_medical_history_3 = get_field('mc_medical_history_3' , $patient);
        $mc_medical_history_4 = get_field('mc_medical_history_4' , $patient);
        $mc_medical_history_5 = get_field('mc_medical_history_5' , $patient);
        $mc_medical_condition_1 = get_field('mc_medical_condition_1' , $patient);
        $mc_medical_condition_2 = get_field('mc_medical_condition_2' , $patient);
        $mc_medical_condition_3 = get_field('mc_medical_condition_3' , $patient);
        $mc_previous_treatments_1 = get_field('mc_previous_treatments_1' , $patient);
        $mc_previous_treatments_2 = get_field('mc_previous_treatments_2' , $patient);
        $mc_previous_treatments_3 = get_field('mc_previous_treatments_3' , $patient);
        $mc_expectations_1 = get_field('mc_expectations_1' , $patient);
        $mc_expectations_2 = get_field('mc_expectations_2' , $patient);
        $mc_expectations_3 = get_field('mc_expectations_3' , $patient);
        $mc_allergies_1 = get_field('mc_allergies_1' , $patient);
        $mc_allergies_2 = get_field('mc_allergies_2' , $patient);
        $mc_family_medical_history_1 = get_field('mc_family_medical_history_1' , $patient);
        $mc_family_medical_history_2 = get_field('mc_family_medical_history_2' , $patient);
        $mc_habits_1 = get_field('mc_habits_1' , $patient);
        $mc_habits_2 = get_field('mc_habits_2' , $patient);
        $mc_habits_3 = get_field('mc_habits_3' , $patient);
        $mc_psychosocial_assessment_1 = get_field('mc_psychosocial_assessment_1' , $patient);
        $mc_psychosocial_assessment_2 = get_field('mc_psychosocial_assessment_2' , $patient);
        $mc_psychosocial_assessment_3 = get_field('mc_psychosocial_assessment_3' , $patient);
        $mc_legal_1 = get_field('mc_legal_1' , $patient);
        $mc_legal_2 = get_field('mc_legal_2' , $patient);
        $mc_complementary_medicines_1 = get_field('mc_complementary_medicines_1' , $patient);
        $mc_complementary_medicines_2 = get_field('mc_complementary_medicines_2' , $patient);
        $mc_patient_preferences_1 = get_field('mc_patient_preferences_1' , $patient);
        $mc_additional_notes = get_field('mc_additional_notes' , $patient);

        $upload_dir = wp_upload_dir();
        $patient_dir = $upload_dir['basedir'] . '/patients/';
        $patient_url = $upload_dir['url'] . '/patients/';
        $site_logo = get_template_directory_uri() . '/img/logo.png';

        $html = '<html>
        <body>
        <table style="width:100%;margin-bottom:15px;">
            <tr>
                <td style="width: 170px;"><img style="width: 170px;" src="'.$site_logo.'" /></td>
                <td>
                    <h4 style="background-color: #0c8e36;color: #fff;padding: 10px; width:100%; text-align: center;">Patient File</h4>
                </td>
            </tr>
        </table>
        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Patient Details</h3>
        <p><strong>Patient ID :</strong><br/>'.$patient_id.'</p>
        <p><strong>Full Name :</strong><br/>'.$$name.'</p>
        <p><strong>Email :</strong><br/>'.$email.'</p>
        <p><strong>Phone :</strong><br/>'.$phone.'</p>
        <p><strong>Gender :</strong><br/>'.$gender.'</p>
        <p><strong>Addrerss :</strong><br/>'.$address_line_1.'<br/>'.$address_line_2.'</p>
        <p><strong>Town :</strong><br/>'.$town.'</p>
        <p><strong>Country :</strong><br/>'.$country.'</p>
        <p><strong>Postcode :</strong><br/>'.$postcode.'</p>
        <p><strong>Date of Birth :</strong><br/>'.$dob.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Treatment Details</h3>
        <p><strong>Treatment :</strong><br/>'.$treatment.'</p>
        <p><strong>Additional Notes :</strong><br/>'.$additional_notes.'</p>
        <p><strong>Have you been diagnosed with any medical conditions or diseases? :</strong><br/>'.$medical_history_1.'</p>
        <p><strong>What treatments, medications, or therapies have you previously tried for your medical condition(s)? :</strong><br/>'.$medical_history_2.'</p>
        <p><strong>Have you undergone any surgeries or medical procedures in the past? :</strong><br/>'.$medical_history_3.'</p>
        <p><strong>Are you currently taking any medications, supplements, or herbal remedies? :</strong><br/>'.$medical_history_4.'</p>
        <p><strong>What are the specific symptoms or issues you are experiencing due to your medical condition(s)? :</strong><br/>'.$current_medical_condition_1.'</p>
        <p><strong>How long have you been dealing with these symptoms? :</strong><br/>'.$current_medical_condition_2.'</p>
        <p><strong>Are there any recent changes or developments in your condition that you would like to mention? :</strong><br/>'.$current_medical_condition_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Clinic Details</h3>
        <p><strong>Referred from another clinic :</strong><br/>'.$referred_clinic.'</p>
        <p><strong>Clinic name :</strong><br/>'.$clinic_name.'</p>
        <p><strong>Clinic Postcode :</strong><br/>'.$clinic_postcode.'</p>
        <p><strong>Clinic Phone number :</strong><br/>'.$clinic_phone_number.'</p>
        <p><strong>GP name :</strong><br/>'.$gp_name.'</p>
        <p><strong>Practice name :</strong><br/>'.$practice_name.'</p>
        <p><strong>GP Address :</strong><br/>'.$gp_address_line_1.'<br/>'.$gp_address_line_2.'</p>
        <p><strong>GP Town :</strong><br/>'.$gp_town.'</p>
        <p><strong>GP Country :</strong><br/>'.$gp_country.'</p>
        <p><strong>GP Postal Code :</strong><br/>'.$gp_postal_code.'</p>
        <p><strong>GP Phone :</strong><br/>'.$gp_phone.'</p>

        <h2>Consultation Data</h2>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">General Patient Information</h3>
        <p><strong>Do you have a legal guardian, and if so, please provide their information? :</strong><br/>'.$mc_information_1.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Medical History</h3>
        <p><strong>Have you been diagnosed with any medical conditions or diseases? :</strong><br/>'.$mc_medical_history_1.'</p>
        <p><strong>What treatments, medications, or therapies have you previously tried for your medical condition(s)? :</strong><br/>'.$mc_medical_history_2.'</p>
        <p><strong>Have you undergone any surgeries or medical procedures in the past? If so, please provide details. :</strong><br/>'.$mc_medical_history_3.'</p>
        <p><strong>Are you currently taking any medications, supplements, or herbal remedies? Please list them. :</strong><br/>'.$mc_medical_history_4.'</p>
        <p><strong>Review SCR :</strong><br/>'.$mc_medical_history_5.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Current Medical Condition</h3>
        <p><strong>What are the speciﬁc symptoms or issues you are experiencing due to your medical condition(s)? :</strong><br/>'.$mc_medical_condition_1.'</p>
        <p><strong>How long have you been dealing with these symptoms? :</strong><br/>'.$mc_medical_condition_2.'</p>
        <p><strong>Are there any recent changes or developments in your condition that you would like to mention? :</strong><br/>'.$mc_medical_condition_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Response to Previous Treatments</h3>
        <p><strong>Have you tried any medications, therapies, or interventions for your current medical condition(s)? If so, what were the results? :</strong><br/>'.$mc_previous_treatments_1.'</p>
        <p><strong>Were there any side eﬀects or adverse reactions to previous treatments? :</strong><br/>'.$mc_previous_treatments_2.'</p>
        <p><strong>Have you found any treatments to be eﬀective or ineﬀective in managing your symptoms? :</strong><br/>'.$mc_previous_treatments_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Patient Goals and Expectations</h3>
        <p><strong>What are your goals for treatment with medicinal cannabis? :</strong><br/>'.$mc_expectations_1.'</p>
        <p><strong>What outcomes are you hoping to achieve? :</strong><br/>'.$mc_expectations_2.'</p>
        <p><strong>Do you have speciﬁc expectations regarding symptom relief, improved quality of life, or other treatment outcomes? :</strong><br/>'.$mc_expectations_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Allergies and Sensitivities</h3>
        <p><strong>Are you allergic to any medications, substances, or foods? Please provide details. :</strong><br/>'.$mc_allergies_1.'</p>
        <p><strong>Have you ever experienced adverse reactions or sensitivities to any medications in the past? :</strong><br/>'.$mc_allergies_2.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Family Medical History</h3>
        <p><strong>Is there a family history of the medical condition(s) you are currently experiencing? :</strong><br/>'.$mc_family_medical_history_1.'</p>
        <p><strong>Are there any genetic conditions or predispositions that run in your family? :</strong><br/>'.$mc_family_medical_history_2.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Lifestyle and Habits</h3>
        <p><strong>Do you smoke or use tobacco products? :</strong><br/>'.$mc_habits_1.'</p>
        <p><strong>Do you consume alcohol or recreational drugs? :</strong><br/>'.$mc_habits_2.'</p>
        <p><strong>Are you physically active, and if so, how often do you engage in exercise or physical activities? :</strong><br/>'.$mc_habits_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Psychosocial Assessment</h3>
        <p><strong>How is your mental and emotional well-being? :</strong><br/>'.$mc_psychosocial_assessment_1.'</p>
        <p><strong>Have you experienced any mental health conditions, such as anxiety or depression? :</strong><br/>'.$mc_psychosocial_assessment_2.'</p>
        <p><strong>Do you have a support system, including family and friends, to assist you during your treatment? :</strong><br/>'.$mc_psychosocial_assessment_3.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Legal and Regulatory Information</h3>
        <p><strong>Are you aware of the legal regulations surrounding the use of medicinal cannabis in your jurisdiction? :</strong><br/>'.$mc_legal_1.'</p>
        <p><strong>Do you have any concerns about the legal status of medicinal cannabis? :</strong><br/>'.$mc_legal_2.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Alternative Therapies and Complementary Medicines</h3>
        <p><strong>Have you explored or considered alternative therapies or complementary medicines for your condition(s), such as acupuncture, chiropractic care, or dietary supplements? :</strong><br/>'.$mc_complementary_medicines_1.'</p>
        <p><strong>If so, please provide details about your experiences with these treatments. :</strong><br/>'.$mc_complementary_medicines_2.'</p>

        <h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Patient Preferences and Concerns</h3>
        <p><strong>Do you have any preferences regarding the type of medicinal cannabis product (e.g., oil, capsules, inhalation) you would prefer? :</strong><br/>'.$mc_patient_preferences_1.'</p>
        <p><strong>Additional notes :</strong><br/>'.$mc_additional_notes.'</p>

        <hr/>';

        if( $follow_up_appointments ) {
            $html .= '<h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Follow Ups</h3>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Follow Up Date</th>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Follow Up File</th>
                    </tr>
                </thead>
                <tbody>';
                foreach( $follow_up_appointments as $follow_up ) {
                    $appointment_date = $follow_up['appointment_date'];
                    $appointment_file = $follow_up['appointment_file'];

                    if( $appointment_file ) {
                        $html .= '<tr>
                            <td>'.$appointment_date.'</td>
                            <td><a href="'.$appointment_file.'" download>View file</a></td>
                        </tr>';
                    }

                }
            $html .= '</tbody>
            </table>';
        }

        if( $prescription_date_1 || $prescription_date_2 || $prescription_date_3 ||$other_prescription_data ) {
            $html .= '<h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Prescription Info</h3>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Prescription Date</th>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Prescription Note</th>
                    </tr>
                </thead>
                <tbody>';
    
                if( $prescription_date_1 ) {
                    $html .= '<tr>
                        <td>'.$prescription_date_1.'</td>
                        <td>'.$prescription_note_1.'</td>
                    </tr>';
                }
    
                if( $prescription_date_2 ) {
                    $html .= '<tr>
                        <td>'.$prescription_date_2.'</td>
                        <td>'.$prescription_note_2.'</td>
                    </tr>';
                }
    
                if( $prescription_date_3 ) {
                    $html .= '<tr>
                        <td>'.$prescription_date_3.'</td>
                        <td>'.$prescription_note_3.'</td>
                    </tr>';
                }
    
                if( $other_prescription_data ) {
                    foreach( $other_prescription_data as $prescription ) {
                        $prescription_date = $prescription['prescription_date'];
                        $prescription_note = $prescription['prescription_note'];
                        $html .= '<tr>
                            <td>'.$prescription_date.'</td>
                            <td>'.$prescription_note.'</td>
                        </tr>';
                    }
                }
            $html .= '</tbody>
            </table>';
        }

        if( $payment_date_1 || $payment_date_2 || $payment_date_3 || $other_payments ) {
            $html .= '<h3 style="background-color: #9cc52b;padding: 10px;color: #fff;font-weight: 500;margin-bottom: 10px;">Payment Info</h3>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Payment Date</th>
                        <th style="background-color: #9cc52b;padding: 10px;text-align: center;color: #fff;">Transaction ID</th>
                    </tr>
                </thead>
                <tbody>';
    
                if( $payment_date_1 ) {
                    $html .= '<tr>
                        <td>'.$payment_date_1.'</td>
                        <td>'.$transaction_id_1.'</td>
                    </tr>';
                }
    
                if( $payment_date_2 ) {
                    $html .= '<tr>
                        <td>'.$payment_date_2.'</td>
                        <td>'.$transaction_id_2.'</td>
                    </tr>';
                }
    
                if( $payment_date_3 ) {
                    $html .= '<tr>
                        <td>'.$payment_date_3.'</td>
                        <td>'.$transaction_id_3.'</td>
                    </tr>';
                }
    
                if( $other_payments ) {
                    foreach( $other_payments as $payment ) {
                        $payment_date = $payment['payment_date'];
                        $transaction_id = $payment['transaction_id'];
                        $html .= '<tr>
                            <td>'.$payment_date.'</td>
                            <td>'.$transaction_id.'</td>
                        </tr>';
                    }
                }
            $html .= '</tbody>
            </table>';
        }

        $html .= '</body>
        </html>';

        // Create a Dompdf instance
        $options = new Options();
        $options->setDefaultFont('Helvetica');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        $pdf_name = 'patient-'.$patient_id.'-'.time().'.pdf';
        $dompdf->stream($pdf_name,array('Attachment'=>1));
        
    }
    
}

add_action( 'admin_post_repeat_prescription', 'mc_repeat_prescription' );
function mc_repeat_prescription() {

    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;
    $admin_email = get_admin_email();

    if( $patient ) {

        $patient_id = get_field('patient_id' , $patient);
        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);

        $subject = "Patient $patient_id eligible for repeat prescription.";
        $html .= "<p>Dear Admin,</p>";
        $html .= "<p>Patient <strong>$patient_id</strong> eligible for and has requested repeat prescription.</p>";
        $html .= "<p>MARUCANNA</p>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The Marucana Team <noreply@marucanna.co.uk>');

        wp_mail( $admin_email, $subject, $html, $headers );

        //Patient Email
        $subjectPatient = "Repeat order prescription";
        $htmlPatient .= "<p>Hello $name,</p>";
        $htmlPatient .= "<p>Thank you for your repeat prescription request. </p>";
        $htmlPatient .= "<p>Our team will be contacting you shortly to confirm your request and to collect your payment.</p>";
        $htmlPatient .= "<p>Kind Regards,</p>";
        $htmlPatient .= "<p>The Marucana Team</p>";

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers );
    }

    wp_redirect( home_url("patient-dashboard?form=rep&status=1") );
    die();

}

add_action( 'wp_ajax_sent_consent_form_action', 'mc_sent_consent_form' );
function mc_sent_consent_form() {

    $results = array();
    $patient = (isset($_REQUEST['patient'])) ? $_REQUEST['patient'] : false;

    if( $patient ) {

        //http://localhost/marucanna/patient-consent/
        $patient_id = get_field('patient' , $patient);
        $patient_email = get_field('email' , $patient);
        $name = get_field('name' , $patient);
        $consent_url = home_url( 'patient-consent?patient='.$patient_id.'&patient_post='.$patient );

        //Patient Email
        $subjectPatient = "We need your Consent";
        $htmlPatient .= "<p>Hello $name,</p>";
        $htmlPatient .= "<p>Your consent required. follow this <a href='".$consent_url."'>link</a></p>";
        $htmlPatient .= "<p>Kind Regards,</p>";
        $htmlPatient .= "<p>The Marucana Team</p>";
        $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: The Marucana Team <noreply@marucanna.co.uk>');

        wp_mail( $patient_email, $subjectPatient, $htmlPatient, $headers );

        if ( ! add_post_meta( $patient, 'send_consent', true, true ) ) { 
            update_post_meta ( $patient, 'send_consent', true );
        }

        $results['status'] = true;
		$results['msg'] = 'Consent email has been sent.';

    } else {
        $results['status'] = false;
		$results['msg'] = 'Somethings went wrong. Please try again.';
    }

    echo json_encode($results);
    wp_die();

}

add_action( 'gform_after_submission_11', 'mc_patient_consent_details', 10, 2 );
function mc_patient_consent_details( $entry, $form ) {
  
    $patient = rgar( $entry, '8' );
    $patient_post_id = rgar( $entry, '9' );
    $date = rgar( $entry, '11' );
    
    if($patient_post_id) {

        update_field('consent_date', $date , $patient_post_id);
        
    }
    
}