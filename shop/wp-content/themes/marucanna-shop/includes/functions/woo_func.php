<?php
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

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