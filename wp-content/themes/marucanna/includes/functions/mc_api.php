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
                $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id,'full', false);
        ?>

                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="condition">
                    <?php if ( has_post_thumbnail() ) {?>
                        <img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?> "/>
                        <?php } ?>
                        <h4><?php the_title(); ?></h4>
                        <a href="<?php the_permalink(); ?>" class="overlay"></a>
                    </div>
                </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>

<?php return ob_get_clean();
}

add_action('wp_ajax_mc_handle_file_upload', 'mc_handle_file_upload');
function mc_handle_file_upload() {

    status_header(200);
	
    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['path'] . DIRECTORY_SEPARATOR;
    $num_files = count($_FILES['file']['tmp_name']);

    $newupload = 0;

    if ( !empty($_FILES) ) {
        $files = $_FILES;
        foreach($files as $file) {
            $newfile = array (
                'name' => $file['name'],
                'type' => $file['type'],
                'tmp_name' => $file['tmp_name'],
                'error' => $file['error'],
                'size' => $file['size']
            );

            $_FILES = array('upload'=>$newfile);
            foreach($_FILES as $file => $array) {
                $newupload = media_handle_upload( $file, 0 );
            }
        }
    }

    echo $newupload;    
    die();
}
