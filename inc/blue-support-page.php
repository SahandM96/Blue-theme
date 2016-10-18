<h1>Blue Restuarant Support </h1>
<?php settings_errors(); ?>
<form  action="options.php" method="post">
  <?php settings_fields( 'blue-theme-support' ); ?>
  <?php do_settings_sections( 'blue_theme_support_page' ); ?>
  <?php submit_button(); ?>
</form>
