<?php
// Register HTML5 Blank Navigation
add_action('init', 'register_html5_menu');
function register_html5_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'html5blank'), 
        'footer-menu-1' => __('Footer Menu #1', 'html5blank'),
        'footer-menu-2' => __('Footer Menu #2', 'html5blank'),
    ));
}

//Header Menu Html
class MC_Header_Menu_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = null) {
        // Add custom classes to the sub-menu <ul> tag
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null , $current_object_id = 0) {

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Add custom classes to the <li> and <a> tags
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if( $item->menu_item_parent ) {
            $output .=$indent . '<li>';
        } else {
            if( in_array('menu-item-has-children' , $classes) ) {
                $output .=$indent . '<li class="' . esc_attr(implode(' ', $classes)) . ' nav-item dropdown">';
            } else {
                $output .=$indent . '<li class="' . esc_attr(implode(' ', $classes)) . ' nav-item">';
            }
        }
        

        $atts = array();
        $atts['title']  = ! empty($item->title)  ? $item->title  : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel']    = ! empty($item->xfn)    ? $item->xfn    : '';
        $atts['href']   = ! empty($item->url)    ? $item->url    : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;

        if( $item->menu_item_parent ) {
            $item_output .= '<a' . $attributes . ' class="dropdown-item">';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
        } else {
            if( in_array('menu-item-has-children' , $classes) ) {
                $item_output .= '<a href="#" class="dropdown-toggle dropdown-click" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-chevron-down"></i></a>';

                $item_output .= '<a' . $attributes . ' class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= '</a>';
            } else {
                $item_output .= '<a' . $attributes . ' class="nav-link">';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= '</a>';
            }
        }
        
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
