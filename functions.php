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

require_once('wp_bootstrap_navwalker.php');
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'THEMENAME' ),
) );
?>
