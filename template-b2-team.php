<?php
/**
 * Template Name: B2 Team Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>


<div class="row team_members">

<?php if( get_field('team_members') ): $UID = 0; ?>
  <?php while( has_sub_field('team_members') ): $member = get_sub_field_object('name'); $UID++; ?>

    <div class="col-md-6">
      <img src="<?php $team_member_picture = wp_get_attachment_image_src( get_sub_field('picture'), 'team-picture' ); echo $team_member_picture[0]; ?>" alt="<?php the_sub_field('name'); ?>" data-toggle="modal" data-target="#<?= $member['key'].$UID; ?>" />
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
            <h5><?php the_sub_field('position'); ?></h5>
            <div class="row">
              <div class="col-sm-8">
                <hr/>
                <?php the_sub_field('bio'); ?>
              </div>
              <div class="col-sm-4 hidden-xs">
                <div class="alignright modal-profilepicture" style="background: url('<?= $team_member_picture[0]; ?>') no-repeat scroll center;"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="mailto:<?php the_sub_field('contact_email'); ?>?Subject=Hi%20<?= strtok(get_sub_field('name'), " "); ?>," class="btn btn-primary btn-arrow-right">Contact <?= strtok(get_sub_field('name'), " "); ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>

<?php endif; ?>
</div>
<?php endwhile; ?>
