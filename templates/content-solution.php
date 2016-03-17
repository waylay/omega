<?php if(get_field('featured_project')): ?>
  <div class="row">
      <div class="col-md-4 hidden-xs featured-project">
        <?php  $featured_project = get_field('featured_project'); ?>
        <div class="row">
          <div class="col-sm-5 col-md-12">
            <?= get_the_post_thumbnail($featured_project,'medium'); ?>
          </div>
          <div class="col-sm-7 col-md-12">
            <h3><strong>Featured Project</strong></h3>
            <hr>
            <h5> <?= $featured_project->post_title; ?> </h5>
            <p><?= wp_trim_words( $featured_project->post_content, 30, '...' ); ?>
              <br><a class="btn btn-primary btn-arrow-right" href="<?php echo $featured_project->guid; ?>">read more</a>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <?php the_content(); ?>
        <div class="row related-products-container">
          <?php if(get_field('related_product_categories')): $related_product_categories = get_field('related_product_categories'); ?>
          <div class="col-md-6">
            <h3><strong>Related Product Categories</strong></h3><hr>
              <ul class="related_product_categories">
              <?php foreach ($related_product_categories as $related_product_category) {
                  echo '<li><a href="'.get_term_link($related_product_category).'">'.$related_product_category->name.'</a></li>';
              } ?>
              </ul>
          </div>
          <?php endif; ?>
          <?php if(get_field('related_products')): $related_products = get_field('related_products'); ?>
          <div class="col-md-6">
            <h3><strong>Related Products</strong></h3><hr>
            <ul class="related_products">
            <?php foreach ($related_products as $related_product) {
                echo '<li><a href="#" data-toggle="modal" data-target="#'.$related_product->post_name.'">'.$related_product->post_title.'</a></li>';
                setup_postdata( $GLOBALS['post'] =& $related_product );
                ?>
                    <!-- Modal -->
                    <div class="modal modal-md fade" id="<?= $related_product->post_name; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $related_product->post_name.'Label'; ?>">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            <h3 class="modal-title" id="<?= $related_product->post_name.'Label'; ?>"><?php the_title(); ?></h3>
                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-sm-6">
                                <?php the_post_thumbnail('full'); ?>
                              </div>
                              <div class="col-sm-6">
                                <h5><span>Manufacturer: </span><?php  echo strip_tags( get_the_term_list( $related_product->ID, 'manufacturer', '', ' / ' ) ); ?></h5>
                                <hr/>
                                <?php the_content(); ?>
                                <div><a href="/contact/request-more-info/?product_id=<?= $related_product->ID;  ?>" class="btn btn-primary btn-arrow-right">Request more info</a></div>
                                <div><a href="<?php the_field('product_pdf',$related_product->ID); ?>" class="btn btn-secondary btn-arrow-right" download>Download PDF</a></div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer"></div>
                        </div>
                      </div>
                    </div>
                <?php
                wp_reset_postdata();
            } ?>
            </ul>
          </div>
          <?php endif; ?>
        </div>

        <div class="related-questions col-xs-12">
          <h2>Have Questions?</h2>
          <p>Contact one of communication solution experts today!</p>
          <a href="/contact" class="btn btn-primary btn-arrow-right">Contact Us</a>
        </div>

      </div>
  </div>
<?php else: the_content(); endif; ?>
