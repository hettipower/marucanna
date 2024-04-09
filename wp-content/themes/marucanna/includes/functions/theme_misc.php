<?php
// Add the action to track user login time
add_action('wp_login', 'track_user_login_time', 10, 2);
function track_user_login_time($user_login, $user) {
  // Save the login time in user meta data
  update_user_meta($user->ID, 'last_login_time', current_time('mysql'));
}

// Add the action to track user logout time
add_action('wp_logout', 'track_user_logout_time');
function track_user_logout_time() {
  // Get the current user
  $user = wp_get_current_user();
  
  // Save the logout time in user meta data
  update_user_meta($user->ID, 'last_logout_time', current_time('mysql'));
}

// Function to display content in the dashboard widget
function users_login_info_widget_content() {

    $users = get_users( array(
        'role__in' => array( 'patient' , 'pharmacist' , 'doctor' )
    ));
    if( $users ) : ?>
        <table class="wp-list-table widefat fixed striped table-view-list posts" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column" scope="col">Username</th>
                    <th class="manage-column" scope="col">User Type</th>
                    <th class="manage-column" scope="col">Login Time</th>
                    <th class="manage-column" scope="col">Logout Time</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            foreach( $users as $user ): 
                $lastLoginTime = get_user_meta($user->ID, 'last_login_time', true);
                $lastLogoutTime = get_user_meta($user->ID, 'last_logout_time', true);
        ?>
            <tr>
                <td><?php echo $user->data->user_login; ?></td>
                <td><?php echo $user->roles[0]; ?></td>
                <td><?php echo $lastLoginTime ? $lastLoginTime : '-'; ?></td>
                <td><?php echo $lastLogoutTime ? $lastLogoutTime : '-'; ?></td>
            </tr>
        <?php endforeach;?>
            </tbody>
        </table>
    <?php endif;
}

// Function to add the dashboard widget
//add_action('wp_dashboard_setup', 'add_users_login_info_widget');
function add_users_login_info_widget() {
    wp_add_dashboard_widget(
        'users_login_info_widget', // Widget ID
        'Users Login Informations',     // Widget Title
        'users_login_info_widget_content' // Callback function to display content
    );
}