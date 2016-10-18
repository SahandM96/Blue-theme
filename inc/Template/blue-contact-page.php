<h1>Blue Restuarant Contact form</h1>
<?php settings_errors(); ?>
<form  action="options.php" method="post">
  <?php settings_fields( 'blue-contact-options' ); ?>
  <?php do_settings_sections( 'blue-contact-section' ); ?>
  <?php submit_button( ); ?>
</form>
