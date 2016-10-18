<?php get_header(); ?>
<div class="Main_Page">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h2 style="text-shadow:none;"><?php the_title(); ?></h2>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>


			</div>

			<?php edit_post_link('Edit this entry','','.'); ?>

		</div>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

<p style="text-align:center;"><?php previous_post_link() ?> || <?php next_post_link() ?></p>
	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>
