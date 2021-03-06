<?php
/**
 * Template Name: F Contact Template
 */

// Only Load CF7 styles/scrips on Contact Pages
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
    wpcf7_enqueue_scripts();
}

if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
    wpcf7_enqueue_styles();
}
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<?php if (get_field('bussiness_hours')) { ?>
 <div class="bussiness_hours">
   <div class="row">
     <div class="col-xs-12">
       <?php the_field('bussiness_hours'); ?>
     </div>
   </div>
 </div>
<?php } ?>
