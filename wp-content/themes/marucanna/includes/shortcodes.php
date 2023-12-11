<?php
function lightgreen_shortcode( $atts , $content = null) {
return '<span>'.$content.'</span>';
}
add_shortcode( 'lg', 'lightgreen_shortcode' );





/*
 function btn_shortcode_mypro( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'class' => '',
        'href'  =>  ''
    ), $atts );

    return '<a href="' . esc_attr($a['href']) . '" class="btn btn-download btn-lg"><i class="fa fa-download"></i>'. $content.'</a>';
}
add_shortcode( 'button', 'btn_shortcode_mypro' );
*/