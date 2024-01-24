<?php
// Redirect users after successful login based on their roles
add_filter('login_redirect', 'mc_custom_login_redirect', 10, 3);
function mc_custom_login_redirect($redirect_to, $request, $user) {
    // Is there a user to check?
    if (isset($user->roles) && is_array($user->roles)) {
        // Is it a patient?
        if (in_array('patient', $user->roles)) {
            // Redirect them to the patient dashboard
            return home_url('/patient-dashboard');
        }
        // Is it a doctor?
        elseif (in_array('doctor', $user->roles)) {
            // Redirect them to the doctor dashboard
            return home_url('/doctor-dashboard');
        } else {
            // Redirect other roles to the default dashboard
            return admin_url();
        }
    } else {
        return $redirect_to;
    }
}

// Restrict access to the admin dashboard for patients and doctors
//add_action('admin_init', 'mc_restrict_admin_dashboard');
function mc_restrict_admin_dashboard() {
    if (is_admin() && !current_user_can('administrator')) {
        wp_redirect(home_url());
        exit;
    }
}

/**
 * Redirect the user to the custom login page instead of wp-login.php.
 */
add_action( 'login_form_login', 'redirect_to_custom_login' );
function redirect_to_custom_login() {
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
        $redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
        
        if ( is_user_logged_in() ) {
            redirect_logged_in_user( $redirect_to );
            exit;
        }
    
        // The rest are redirected to the login page
        $login_url = home_url( 'login' );
        if ( ! empty( $redirect_to ) ) {
            $login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
        }
    
        wp_redirect( $login_url );
        exit;
    }
}

function redirect_logged_in_user( $redirect_to = null ) {
    $user = wp_get_current_user();

    if (isset($user->roles) && is_array($user->roles)) {
        // Is it a patient?
        if (in_array('patient', $user->roles)) {
            wp_redirect( home_url('/patient-dashboard') );
        }
        // Is it a doctor?
        elseif (in_array('doctor', $user->roles)) {
            wp_redirect( home_url('/doctor-dashboard') );
        } else {
            wp_redirect( admin_url() );
        }
    } else {
        wp_redirect( home_url() );
    }
}