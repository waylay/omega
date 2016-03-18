<article <?php post_class('row'); ?>>
  <div class="col-md-3 post-thumbnail">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
  </div>
  <div class="col-md-9">
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>">
      <?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>
