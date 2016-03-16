<article <?php post_class('col-xs-6 col-sm-4 col-md-3 col-lg-3'); ?> >
  <header>
    <?php global $post; the_post_thumbnail('product-thumbnail'); ?>
    <div class="view-details-download">
      <a class="btn btn-primary" data-toggle="modal" data-target="#<?= $post->post_name; ?>">View Details</a>
      <a href="<?php the_field('product_pdf'); ?>" class="btn btn-secondary">Download PDF</a>
    </div>
  </header>
  <div class="entry-summary">
    <h3 class="entry-title"><?php the_title(); ?></h3>
  </div>
      <!-- Modal -->
    <div class="modal modal-md fade" id="<?= $post->post_name; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $post->post_name.'Label'; ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="modal-title" id="<?= $post->post_name.'Label'; ?>"><?php the_title(); ?></h3>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-sm-6">
                <?php the_post_thumbnail('full'); ?>
              </div>
              <div class="col-sm-6">
                <h5><span>Manufacturer: </span><?php  echo strip_tags( get_the_term_list( $post->ID, 'manufacturer', '', ' / ' ) ); ?></h5>
                <hr/>
                <?php the_content(); ?>
                <div><a href="#" class="btn btn-primary btn-arrow-right">Request more info</a></div>
                <div><a href="<?php the_field('product_pdf'); ?>" class="btn btn-secondary btn-arrow-right">Download PDF</a></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>
</article>
