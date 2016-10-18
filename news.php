<?php
/*
Template Name: News
*/
?>
<?php get_header(); ?>
<div class="Main_Page">
  <?php global $post; // required
  $args = array('category' => 21); // include category 9
  $custom_posts = get_posts($args);
  foreach($custom_posts as $post) : setup_postdata($post);?>
	<h2 style="text-shadow:none;"><?php the_title(); ?></h2>
  <div class="entry">

    <?php the_content(); ?>

    <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

    <hr>

  </div>

  <?php edit_post_link('Edit this entry','','.'); ?>



  <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
  <?php
    endforeach;
  ?>
</div>

<?php get_footer(); ?>
