<?php
// Rest API
add_action('rest_api_init', function () {
    // Blog page
    register_rest_route('mcapi/', 'conditions', array(
        'methods'  => 'GET',
        'callback' => 'get_condition_handler',
        'permission_callback' => '__return_true'
    ));
});

function get_condition_handler($request)
{

    $name = sanitize_text_field(urldecode($request->get_param('name')));
    $offset = sanitize_text_field(urldecode($request->get_param('offset')));

    $data_obj['data'] = get_condition_list($name, $offset, 9);

    $response = new WP_REST_Response($data_obj);
    $response->set_status(200);

    return $response;
}

function get_condition_list($name = "", $offset = 0, $posts_to_show = 9){


    $args = array(
        'post_type' => 'marucanna-conditions',
        'posts_per_page' => $posts_to_show, 
        'offset' => $offset
    );

    if ($name) {
        $args['s'] = $name;
    }


    $items = new WP_Query($args);
    $data_total = $items->found_posts;

    ob_start(); ?>

    <div class="row" data-total="<?php echo $data_total; ?>">

        <?php
            while ( $items->have_posts() ) : $items->the_post();
        ?>

            <div class="col-md-4 col-sm-12 mb-4">
                <div class="condition">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/conditions/condition1.webp" alt="">
                    <h4>Cancer Pain</h4>
                    <a href="#" class="overlay"></a>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>

<?php return ob_get_clean();
}