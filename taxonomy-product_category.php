<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found. Please try again later or search for something else.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>


<?php echo category_description(); ?>
<div class="row">
<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

<?php endwhile; ?>
</div>
<div class="clear">
<?php echo omega_custom_pagination_links(); ?>
</div>
