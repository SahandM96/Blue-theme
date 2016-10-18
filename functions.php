<?php

    // Add RSS links to <head> section
    automatic_feed_links();

    // Load jQuery
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', ('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'), false);
        wp_enqueue_script('jquery');
    }

    // Clean up the <head>
    function removeHeadLinks()
    {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

    // Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Sidebar Widgets',
            'id' => 'sidebar-widgets',
            'description' => 'These are widgets for the sidebar.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }
     if (function_exists('register_nav_menus')) {
         register_nav_menus(
            array(
                'main_nav' => 'Main navgation Menu',
             )
        );
     }
    add_image_size('frontpage-thumb', 120, 280); //300 x400px image
    add_theme_support('post-thumbnails');
    /* Modify the read more link on the_excerpt() */

function et_excerpt_length($length)
{
    return 220;
}
add_filter('excerpt_length', 'et_excerpt_length');

/* Add a link  to the end of our excerpt contained in a div for styling purposes and to break to a new line on the page.*/

function et_excerpt_more($more)
{
    global $post;

    return '<div class="view-full-post"><a href="'.get_permalink($post->ID).'" class="view-full-post-btn">View Full Post</a></div>;';
}
require get_template_directory().'/inc/function-admin.php';
//new nav Menu
function blue_register_nav_menu()
{
  register_nav_menu( 'primary', 'Header Navgation Menu' );
}
add_action( 'after_switch_theme','blue_register_nav_menu' );
//End of new nav Menu
add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles' );
function cssmenumaker_scripts_styles() {
wp_enqueue_style( 'cssmenu-styles', get_template_directory_uri() . '/css/header.css');
}
class CSS_Menu_Maker_Walker extends Walker {

var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

function start_lvl( &$output, $depth = 0, $args = array() ) {
$indent = str_repeat("\t", $depth);
$output .= "\n$indent

\n";
}
function end_lvl( &$output, $depth = 0, $args = array() ) {
$indent = str_repeat("\t", $depth);
$output .= "$indent

\n";
}

function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

global $wp_query;
$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
$class_names = $value = '';
$classes = empty( $item->classes ) ? array() : (array) $item->classes;

/* Add active class */
if(in_array('current-menu-item', $classes)) {
$classes[] = 'active';
unset($classes['current-menu-item']);
}

/* Check for children */
$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
if (!empty($children)) {
$classes[] = 'has-sub';
}

$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

$output .= $indent . '
';

$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

$item_output = $args->before;
$item_output .= '';
$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
$item_output .= '';
$item_output .= $args->after;

$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

function end_el( &$output, $item, $depth = 0, $args = array() ) {
$output .= "

\n";
}
}
