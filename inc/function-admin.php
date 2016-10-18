<?php
/*
  @package BLUE--RESTUARANT
  ====================================
            ADMIN PAGE
  ====================================
*/
function blurestuarant_add_admin_page()
{
//Generat Blue Admin Page
    add_menu_page('Blue Restuarant Theme Options', 'Blue Restuarant', 'manage_options', 'sahandm96_bluerestuarant_options', 'blue_theme_create_page',get_template_directory_uri().'/css/icons/Admin-Logo.png', 112);
//Generat Blue Admin Sub Page
    add_submenu_page('sahandm96_bluerestuarant_options', 'Blue Restuarant Theme Options', 'General', 'manage_options', 'sahandm96_bluerestuarant_options', 'blue_theme_create_page');
    //add_submenu_page('sahandm96_bluerestuarant_options', 'Custom CSS', 'CSS', 'manage_options', 'sahandm96_blue_options_css', 'sahandm96_css_page');
    add_submenu_page('sahandm96_bluerestuarant_options', 'Blue Restuarant Contact Form', 'Contact Form', 'manage_options', 'sahandm96_bluerestuarant_options_contact', 'blue_theme_contact_page');
    add_submenu_page('sahandm96_bluerestuarant_options', 'Blue Restuarant Settings', 'Settings', 'manage_options','sahandm96_bluerestuarant_settings','blue_theme_support_page');
//Activate Custom Settings
  add_action('admin_init', 'blue_custom_settings');
}
add_action('admin_menu', 'blurestuarant_add_admin_page');
 function blue_theme_create_page()
 {
     require_once get_template_directory().'/inc/Template/Blue-Admin.php';
 }
// function sahandm96_blue_css_page()
// {
//     echo '<h1>Blue Restuarant Custom CSS</h1>';
// }
//contact page
function blue_theme_contact_page()
{
    require_once get_template_directory().'/inc/Template/blue-contact-page.php';
}
//support page
function blue_theme_support_page()
{
    require_once get_template_directory().'/inc/Template/blue-support-page.php';
}
function blue_custom_settings()
{
    register_setting('blue-settings-group', 'first_name');
    register_setting('blue-settings-group', 'last_name');
    add_settings_section('blue-sidebar-option', 'Sidebar Options', 'blue_sidebar_options', 'sahandm96_bluerestuarant_options');
    add_settings_field('sidebar-name', 'Full Name', 'blue_sidebar_name', 'sahandm96_bluerestuarant_options', 'blue-sidebar-option');

//Contact Form Options
    register_setting('blue-contact-options', 'activated_contact');
    add_settings_section('blue-contact-section', 'Contact Form', 'blue_custom_section', 'sahandm96_blue_options_contact');
    add_settings_field('activate-form', 'activate Contact Forme', 'blue_activate_contact', 'sahandm96_blue_options_contact', 'blue-contact-section');

//Support
    register_setting( 'blue-theme-support','post_format','blue_post_format_callback' );
    add_settings_section( 'blue-theme-support','Theme Settings','blue_theme_settings','blue_theme_support_page' );
    add_settings_field( 'post-fomat','Post Format', 'blue_post_formats', 'blue_theme_settings', 'blue_theme_settings');
  }
//post_format function
function blue_post_format_callback($input)
{
  return $input;
}
function blue_theme_settings()
{
  echo "Activate and Dective theme";
}
function blue_post_formats()
{
  $formats=array('aside' , 'gallery','link','image','quote','status','video','audio','chat');
  $output='';
  foreach ($formats as $format) {
    $output.='<label><input type="checkbox" id="'.$format.'" name="'.$format.'" value="1"/>'.$format.'</label><br>';

  }
    echo $output;
}
function blue_activate_contact()
{
  $options =get_option( 'activated_contact');
  $checked =(@$options==1 ?'checked':'');
  echo '<label><input type="checkbox" id="custom_header" name="activated_contact" value="1"'.$checked.'/> Activate the Contact Form</label><br>';;
}
function blue_sidebar_name()
{
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));

    echo '<input type="text" name="first_name" value="'.$first_name.'" placeholder="First Name"/>
        <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
}
function blue_sidebar_options()
{
    echo 'Customize your Sidebar Information';
}
