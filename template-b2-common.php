<?php
/**
 * Template Name: B2 Common Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>


<div class="row team_members">

<?php if( get_field('team_members') ): $UID = 0; ?>
  <?php while( has_sub_field('team_members') ): $member = get_sub_field_object('name'); $UID++; ?>

    <div class="col-md-6">
      <img src="<?php the_sub_field('picture'); ?>" alt="<?php the_sub_field('name'); ?>" data-toggle="modal" data-target="#<?= $member['key'].$UID; ?>" />
        <h4 data-toggle="modal" data-target="#<?= $member['key'].$UID; ?>"><?php the_sub_field('name'); ?></h4>
    </div>

    <!-- Modal -->
    <div class="modal modal-md fade" id="<?= $member['key'].$UID; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $member['key'].$UID.'Label'; ?>">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="modal-title" id="<?= $member['key'].$UID.'Label'; ?>"><?php the_sub_field('name'); ?></h3>
          </div>
          <div class="modal-body">
            <div class="alignright hidden-xs modal-profilepicture" style="background: url('<?php the_sub_field('picture'); ?>') no-repeat scroll center;"></div>
            <h5><?php the_sub_field('position'); ?></h5>
            <?php the_sub_field('bio'); ?>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-primary btn-arrow-right">Contact <?= strtok(get_sub_field('name'), " "); ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>

<?php endif; ?>
</div>
<?php endwhile; ?>
