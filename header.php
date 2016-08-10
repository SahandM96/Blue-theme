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

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
	<?php	if(is_page_template('home.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/Home.css">
		<?php }?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
		<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page-wrap">

		<div id="header">
			<nav class="navbar ">
				<?php

								$args = array(
												'theme_location' => 'top-bar',
												'depth'          => 2,
												'container'      => false,
												'menu_class'     => 'nav navbar-nav',
												'walker'         => new Bootstrap_Walker_Nav_Menu()
								);

								wp_nav_menu($args);

				?>
			</nav>
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<!-- <div class="description">
				<?php bloginfo('description'); ?>
			</div> -->
		</div>
