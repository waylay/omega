<?php
/**
 * Template Name: C2 Solutions Pages Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'solution'); ?>
<?php endwhile; ?>
