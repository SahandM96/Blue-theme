<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
  <div class="container">
    <div class="row">
    <div id="SlideShow" class="span7 offset5">
      <img src="<?php bloginfo('stylesheet_directory');?>/screenshot.png" alt="" />
    </div>
    </div>
  </div>
  <!-- End of SlideSow -->
  <div class="container"><!--NewsBoxs-->

    <div class="NewsBoxs">
      <?php $recent = new WP_Query('cat=1&showposts=3'); while ($recent->have_posts()) : $recent->the_post();?>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php the_excerpt(); ?>
      <?php endwhile; ?>
    </div>
  </div>

<?php get_footer(); ?>
