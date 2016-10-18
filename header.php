<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />

	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" />
	<?php } ?>

	<title>
		<?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>

	<link rel="shortcut icon" href="/favicon.ico">

	<?php	if(is_home()) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/Home.css">
	<?php }?>
	<?php	if(is_page_template('ContactUs.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contact-us.css">
	<?php }?>
	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/single.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/header.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/footer.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main-page.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/skeleton.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

		<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page-wrap">

		<div id="header">
			<nav class="sixteen colums nav-bar">
				<?php wp_nav_menu(array('container_class' => 'main-nav','container'=>'nav' )); ?>
			</nav>
			<a href="<?php echo get_option('home'); ?>/">
			<div class="container">
				<?php	if(!is_home()) { ?>
				<table>
					<tr>
						 <td>
							<img src="<?php bloginfo('template_url');?>/images/header-Logo.png" alt="رستوران آبی" />
						</td>
					</tr>
				</table>
				<?php }?>
			</div></a>
		</div>
