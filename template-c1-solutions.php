<?php
/**
 * Template Name: C1 Solutions Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php // get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>


<div class="grid solutions">
<?php
global $post;
  $args = array(
      'post_type'      => 'page',
      'posts_per_page' => -1,
      'post_parent'    => $post->ID,
      'orderby'       => 'menu_order',
      'order'         => 'ASC'
   );
  $solutions = new WP_Query( $args );

  if ( $solutions->have_posts() ) :
    while ( $solutions->have_posts() ) : $solutions->the_post();

      if ( has_post_thumbnail() ): ?>
      <article class="grid-item">
        <?php the_post_thumbnail('full',array( 'class' => 'hidden-xs hidden-sm' )); ?>

        <a class="overlay" href="<?php the_permalink(); ?>">
          <div class="overlay-description">
            <?php the_field('hover_description'); ?>
            <h3 class="overlay-title">LEARN MORE<span></span></h3>
          </div>

        </a>
        <div class="grid-item-title" style="background-color: <?php the_field('color'); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
      </article>
    <?php endif;
    endwhile;
    wp_reset_postdata();
  endif;
?>

</div>

<?php endwhile; ?>
