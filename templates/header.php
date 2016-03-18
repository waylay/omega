<header class="banner" <?= header_background(); ?>>
<div class="nav-container">
  <div class="container">
    <nav class="navbar" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <div class="phone-facebook">
          <span><a href="tel:<?php the_field('phone','options'); ?>">Call <?php the_field('phone','options'); ?></span>
          <a href="<?php the_field('facebook','options'); ?>" target="_blank">
            <img class="hidden-xs" src="<?= get_stylesheet_directory_uri() ?>/dist/images/fb_icon.png" >
          </a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary_navigation"><span class="toggle-text">MENU</span>
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar icon-bar-first"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= home_url(); ?>" title="<?php bloginfo('name'); ?>">
          <img class="logo" src="<?= get_stylesheet_directory_uri() ?>/dist/images/logo.png"
          alt="<?php bloginfo('name'); ?>">

        </a>
      </div>

          <?php
              wp_nav_menu(array(
                  'menu'              => 'primary_navigation',
                  'theme_location'    => 'primary_navigation',
                  'depth'             => 4,
                  'container'         => 'div',
                  'container_class'   => 'collapse navbar-collapse',
                  'container_id'      => 'primary_navigation',
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker()
                  ));
          ?>
  </nav>
  </div>
</div>

<?php
if(is_front_page()){
  front_page_slider();
  front_page_cards();
} else {
  page_header_area();
}
?>
</header>
<?php
  breadcrumbs_and_search();
?>
