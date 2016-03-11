<?php
/**
 * Template Name: B2 Common Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Daren Lowe
</button>

<!-- Modal -->
<div class="modal modal-md fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h3 class="modal-title" id="myModalLabel">Daren Lowe</h3>
      </div>
      <div class="modal-body">
        <p>
          Daren started with Omega in 2000 as a solutions provider in sales. As he was promoted within the company, he became manager of the healthcare solutions division in 2007 and became a partner in the business in 2008.
        </p>
        <p>Daren is passionate about providing solutions that benefit seniors in Canada and seeks to expand across Canada as fast as possible.</p>

        <em>“If you enjoy what you do, you will never work another day in your life.” – Confucius</em>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-arrow-right">Contact Daren</a>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>
