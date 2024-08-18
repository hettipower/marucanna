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

// Function to add the dashboard widget
add_action('wp_dashboard_setup', 'add_feedback_submissions_average_widget');
function add_feedback_submissions_average_widget() {
    wp_add_dashboard_widget(
        'feedback_submissions_average_widget', // Widget ID
        'Feedback Submissions Overall Percentage/Average',     // Widget Title
        'feedback_submissions_average_widget_content' // Callback function to display content
    );
}

// Function to display content in the dashboard widget
function feedback_submissions_average_widget_content() {

    $items = array();
    $feedback_loop = new WP_Query(
        array(
            'post_type' => 'feedback_submissions',
            'posts_per_page' => -1,
        )
    );
    if ($feedback_loop->have_posts()) {
        while ($feedback_loop->have_posts()) {
            $feedback_loop->the_post();

            $questions_1 = get_field('questions_1');
            $questions_2 = get_field('questions_2');
            $questions_3 = get_field('questions_3');
            $questions_4 = get_field('questions_4');
            $questions_5 = get_field('questions_5');

            $items['questions_1'][] = $questions_1;
            $items['questions_2'][] = $questions_2;
            $items['questions_3'][] = $questions_3;
            $items['questions_4'][] = $questions_4;
            $items['questions_5'][] = $questions_5;

        }
    }
    wp_reset_postdata();

    $total = $feedback_loop->found_posts * 5;

    if( $items ):
    ?>
        <table class="wp-list-table widefat fixed striped table-view-list posts" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column" scope="col">Question</th>
                    <th class="manage-column" scope="col">Average</th>
                    <th class="manage-column" scope="col">Overall Percentage (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>How satisfied are you with the service and care received?</td>
                    <td><?php echo calculate_average($items['questions_1']); ?></td>
                    <td><?php echo calculate_percentage(array_sum($items['questions_1']) , $total); ?></td>
                </tr>
                <tr>
                    <td>How were your interactions with the doctor and medical team?</td>
                    <td><?php echo calculate_average($items['questions_2']); ?></td>
                    <td><?php echo calculate_percentage(array_sum($items['questions_2']) , $total); ?></td>
                </tr>
                <tr>
                    <td>Did you get enough time to discuss your care and needs?</td>
                    <td><?php echo calculate_average($items['questions_3']); ?></td>
                    <td><?php echo calculate_percentage(array_sum($items['questions_3']) , $total); ?></td>
                </tr>
                <tr>
                    <td>How easy was it to schedule an appointment?</td>
                    <td><?php echo calculate_average($items['questions_4']); ?></td>
                    <td><?php echo calculate_percentage(array_sum($items['questions_4']) , $total); ?></td>
                </tr>
                <tr>
                    <td>How likely are you to recommend us to others?</td>
                    <td><?php echo calculate_average($items['questions_5']); ?></td>
                    <td><?php echo calculate_percentage(array_sum($items['questions_5']) , $total); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif;
}