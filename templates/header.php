<header class="banner" >
<div class="nav-container">
  <div class="container">
    <nav class="navbar" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <div class="phone-facebook">
          <span><?php the_field('phone','options'); ?></span>
          <a href="<?php the_field('facebook','options'); ?>" target="_blank">
            <img class="hidden-xs" src="<?= get_stylesheet_directory_uri() ?>/dist/images/fb_icon.png" >
          </a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary_navigation">MENU
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
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
                  'depth'             => 2,
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

<div class="container slider-container">
  <div class="flexslider">
    <ul class="slides">
      <li data-headerbg="/wp-content/uploads/2016/03/header_home.jpg">
      <div class="row">
        <div class="col-xs-7 slider_text">
          <h2>WIRELESS TECHNOLOGIES</h2>
          <h3 class="hidden-sm hidden-xs">Omega is a distributor of Motorola Two Way Radios, Icom Radios, and other wireless solutions.</h3>
          <a href="#" class="btn btn-primary btn-arrow-right">VIEW PRODUCTS</a>
        </div>
        <div class="col-xs-5 slider_image">
          <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/slide1.png">
        </div>
      </div>
      </li>
      <li data-headerbg="/wp-content/uploads/2016/03/header_home1.jpg">
      <div class="row">
        <div class="col-xs-7 slider_text">
          <h2>NURSE CALL SYSTEMS</h2>
          <h3 class="hidden-sm hidden-xs">It is a long established fact that any reader will be distracted by the readable content of a page when he is looking at its layout.</h3>
          <h4> <a href="#" class="btn btn-primary btn-arrow-right">VIEW PRODUCTS</a></h4>
        </div>
        <div class="col-xs-5 slider_image">
          <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/slide2.png">
        </div>
      </div>
      </li>
    </ul>

  </div>
</div>

</header>
