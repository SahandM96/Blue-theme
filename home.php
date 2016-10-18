<?php get_header(); ?>
    <div id="SlideShow" class="container">
      <?php wd_slider(1); ?>
     </div>
  <div class="Home-Boxs">
    <?php
    $args = array( 'numberposts' => 3, 'cat' => '21' );
    $postslist = get_posts( $args );
      foreach ($postslist as $post) :  setup_postdata($post); ?>
        <div class="Home-Box">
          <?php the_post_thumbnail( 'frontpage-thumb' ); ?>
          <div class="Home-Box_info" style="">
            <h4 style="text-shadow:none;"><?php the_title() ?></h4>
                <?php the_excerpt (); ?><br>
          </div>
          <div class="Home-Box_Link">
            <a href="<?php the_permalink(); ?>"><p>بیشتر بخوانید</p></a>
          </div>
        </div>
      <?php endforeach;?>
  </div>

<?php get_footer(); ?>
