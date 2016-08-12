<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
  <!-- <div class="container"> -->
    <div id="slider" class="row sixteens columns">
        <?php if (function_exists('easingsliderlite')) { easingsliderlite(); } ?>
     </div>
  <!-- </div> -->
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
