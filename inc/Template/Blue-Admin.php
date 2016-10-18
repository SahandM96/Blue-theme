<h1>Blue Restuarant Theme Options</h1>
<?php settings_errors(); ?>
<form action="options.php" method="post">
  <?php settings_fields( 'blue-settings-group' ); ?>
  <?php do_settings_sections( 'sahandm96_bluerestuarant_options' ); ?>
  <?php submit_button(); ?>
</form>
