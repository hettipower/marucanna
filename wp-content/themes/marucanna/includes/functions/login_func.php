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
add_action('init', 'mc_restrict_admin_dashboard');
function mc_restrict_admin_dashboard() {
    if (is_admin() && !current_user_can('administrator')) {
        wp_redirect(home_url());
        exit;
    }
}