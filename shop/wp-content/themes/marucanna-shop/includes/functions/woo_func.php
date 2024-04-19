<?php
//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 6 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );

//Add a new custom product tab
add_filter( 'woocommerce_product_tabs', 'mp_woo_product_tabs' );
function mp_woo_product_tabs( $tabs ) {

    $about_brand = get_field( 'about_brand' );
    $shipping_delivery = get_field( 'shipping_delivery' );

    if( $about_brand ) {
        $tabs['about_brand'] = array(
            'title' => __( 'About Brand', 'woocommerce' ),
            'priority' => 50,
            'callback' => 'mp_about_brand_product_tab_content'
        );
    }

    if( $shipping_delivery ) {
        $tabs['shipping_delivery'] = array(
            'title' => __( 'Shipping & Delivery', 'woocommerce' ),
            'priority' => 55,
            'callback' => 'mp_shipping_delivery_product_tab_content'
        );
    }

    return $tabs;
}

function mp_about_brand_product_tab_content() {
    the_field( 'about_brand' );
}

function mp_shipping_delivery_product_tab_content() {
    the_field( 'shipping_delivery' );
}

/**
 * Function for `woocommerce_share` action-hook.
 * 
 * @return void
 */
add_action( 'woocommerce_share', 'mp_woocommerce_share_action' );
function mp_woocommerce_share_action(){
    $link = get_permalink();
    $title = get_the_title();
    ?>
    <div class="list-group list-group-horizontal share_group">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $link; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
        <a href="mailto:?body=<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"><i class="far fa-envelope"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=&description=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-pinterest"></i></a>
        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link; ?>&title=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
    </div>
    <?php
}

add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1 );
function cart_count_fragments( $fragments ) {
    $fragments['span#cart_count.count'] = '<span id="cart_count" class="count">'.WC()->cart->get_cart_contents_count().'</span>';
    return $fragments;
}

/* Wishlist Count */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
    function yith_wcwl_get_items_count() {
        ob_start();
        ?>
        <a class="nav-link" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
            <i class="far fa-heart"></i>
            <span>Wishlist</span>
            <span id="whishlist_count" class="count"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
        </a>
        <?php
        return ob_get_clean();
    }
    add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}
  
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
    function yith_wcwl_ajax_update_count() {
        wp_send_json( array(
            'count' => yith_wcwl_count_all_products()
        ) );
    }

    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}
  
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
    function yith_wcwl_enqueue_custom_script() {
        wp_add_inline_script(
        'jquery-yith-wcwl',
        "
            jQuery( function( $ ) {
                $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
                    $.get( yith_wcwl_l10n.ajax_url, {
                        action: 'yith_wcwl_update_wishlist_count'
                    }, function( data ) {
                        $('#whishlist_count').html( data.count );
                    } );
                } );
            } );
        "
        );
    }

    add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}

//Add Form Validation Script
add_action('woocommerce_after_customer_login_form' , 'mp_form_validation_script');
add_action('woocommerce_after_reset_password_form' , 'mp_form_validation_script');
add_action('woocommerce_after_edit_account_form' , 'mp_form_validation_script');
function mp_form_validation_script() {
    ?>
    <script>
    (() => {
      'use strict'
    
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
    
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
    
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
    <?php
}

//Customize My Account nav items
add_filter( 'woocommerce_account_menu_items', 'mp_customize_my_account_nav', 99, 1 );
function mp_customize_my_account_nav( $items ) {
    
    unset($items['downloads']);

    return $items;
}

add_action('woocommerce_archive_description', 'custom_category_archive_description', 10);
function custom_category_archive_description() {

    if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
		$term = get_queried_object();

		if ( $term ) {
			/**
			 * Filters the archive's raw description on taxonomy archives.
			 *
			 * @since 6.7.0
			 *
			 * @param string  $term_description Raw description text.
			 * @param WP_Term $term             Term object for this taxonomy archive.
			 */
			$term_description = apply_filters( 'woocommerce_taxonomy_archive_description_raw', $term->description, $term );

            $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 
            $image_url = wp_get_attachment_url( $thumbnail_id ); 

			if ( ! empty( $term_description ) ) {
				echo '<div class="term-description">';
                    if( $image_url ) {
                        echo '<div class="category_image"><img src="'. $image_url .'" alt="'.$term->name.'" /></div>';
                    }
                    echo '<div class="category_content">'.wc_format_content( wp_kses_post( $term_description ) ).'</div>';
                echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
    
}

add_action('wp_ajax_update_mini_cart_quantity', 'update_mini_cart_quantity');
add_action('wp_ajax_nopriv_update_mini_cart_quantity', 'update_mini_cart_quantity');
function update_mini_cart_quantity() {
    $product_key = wc_clean($_POST['product_key']);
    $quantity = wc_clean($_POST['quantity']);

    // Update the cart quantity
    WC()->cart->set_quantity($product_key, $quantity);
    
    ob_start();
    woocommerce_mini_cart();
    $mini_cart_content = ob_get_clean();

    // Send back the updated mini cart HTML
    wp_send_json_success($mini_cart_content);
}

add_action('wc_ajax_mp_single_insert_to_cart', 'single_product_insert_to_cart');
function single_product_insert_to_cart(){
        
    // phpcs:disable WordPress.Security.NonceVerification.Missing
    if ( ! isset( $_POST['product_id'] ) ) {
        return;
    }

    $product_id         = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $product            = wc_get_product( $product_id );
    $quantity           = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );
    $variation_id       = !empty( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $variations         = !empty( $_POST['variations'] ) ? array_map( 'sanitize_text_field', json_decode( stripslashes( $_POST['variations'] ), true ) ) : array();
    $passed_validation  = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );
    $product_status     = get_post_status( $product_id );

    $cart_item_data = $_POST['alldata'];

    if ( $passed_validation && 'publish' === $product_status ) {

        if( count( $variations ) == 0 ){
            \WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations, $cart_item_data );
        }

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        if ( 'yes' === get_option('woocommerce_cart_redirect_after_add') ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
        }
        \WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
        );
        echo wp_send_json( $data );
    }
    wp_send_json_success();
    
}

/**
 * Is woocommerce page
 *
 * @param   string $page        ( 'cart' | 'checkout' | 'account' | 'endpoint' )
 * @param   string $endpoint    If $page == 'endpoint' and you want to check for specific endpoint
 * @return  boolean
 */
if( ! function_exists('is_woocommerce_page') ){
    function is_woocommerce_page( $page = '', $endpoint = '' ){
        if( ! $page ){
            return ( is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() );
        }

        switch ( $page ) {
            case 'cart':
                return is_cart();
                break;

            case 'checkout':
                return is_checkout();
                break;

            case 'account':
                return is_account_page();
                break;

            case 'endpoint':
                if( $endpoint ) {
                    return is_wc_endpoint_url( $endpoint );
                }

                return is_wc_endpoint_url();
                break;
        }

        return false;
    }
}

add_action( 'woocommerce_product_query', 'mp_product_query' );
function mp_product_query( $q ){

    $sale = (isset($_GET['sale'])) ? $_GET['sale'] : false ;

    if( $sale ) {
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $q->set( 'post__in', $product_ids_on_sale );
    }

}