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
    add_action('after_setup_theme', 'bootstrap_setup');

if (!function_exists('bootstrap_setup')):

        function bootstrap_setup()
        {
            add_action('init', 'register_menu');

            function register_menu()
            {
                register_nav_menu('top-bar', 'Bootstrap Top Menu');
            }

            class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu
            {
                public function start_lvl(&$output, $depth)
                {
                    $indent = str_repeat("\t", $depth);
                    $output    .= "\n$indent<ul class=\"dropdown-menu\">\n";
                }

                public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
                {
                    $indent = ($depth) ? str_repeat("\t", $depth) : '';

                    $li_attributes = '';
                    $class_names = $value = '';

                    $classes = empty($item->classes) ? array() : (array) $item->classes;
                    $classes[] = ($args->has_children) ? 'dropdown' : '';
                    $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
                    $classes[] = 'menu-item-'.$item->ID;

                    $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
                    $class_names = ' class="'.esc_attr($class_names).'"';

                    $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
                    $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

                    $output .= $indent.'<li'.$id.$value.$class_names.$li_attributes.'>';

                    $attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
                    $attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
                    $attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
                    $attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';
                    $attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

                    $item_output = $args->before;
                    $item_output .= '<a'.$attributes.'>';
                    $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
                    $item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
                    $item_output .= $args->after;

                    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
                }

                public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
                {
                    if (!$element) {
                        return;
                    }

                    $id_field = $this->db_fields['id'];

                                //display this element
                                if (is_array($args[0])) {
                                    $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
                                } elseif (is_object($args[0])) {
                                    $args[0]->has_children = !empty($children_elements[$element->$id_field]);
                                }
                    $cb_args = array_merge(array(&$output, $element, $depth), $args);
                    call_user_func_array(array(&$this, 'start_el'), $cb_args);

                    $id = $element->$id_field;

                                // descend only when the depth is right and there are childrens for this element
                                if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
                                    foreach ($children_elements[ $id ] as $child) {
                                        if (!isset($newlevel)) {
                                            $newlevel = true;
                                                        //start the child delimiter
                                                        $cb_args = array_merge(array(&$output, $depth), $args);
                                            call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                                        }
                                        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                                    }
                                    unset($children_elements[ $id ]);
                                }

                    if (isset($newlevel) && $newlevel) {
                        //end the child delimiter
                                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
                    }

                                //end this element
                                $cb_args = array_merge(array(&$output, $element, $depth), $args);
                    call_user_func_array(array(&$this, 'end_el'), $cb_args);
                }
            }
        }

endif;
