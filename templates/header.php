<header class="banner" >
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

        <div class="col-xs-7 col-sm-8 slider_text">
          <h2>WIRELESS TECHNOLOGIES</h2>
          <h3 class="hidden-xs">Omega is a distributor of Motorola Two Way Radios, Icom Radios, and other wireless solutions.</h3>
          <a href="#" class="btn btn-primary btn-arrow-right">VIEW PRODUCTS</a>
        </div>
        <div class="col-xs-5 col-sm-4 slider_image">
          <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/slide1.png">
        </div>

      </li>
      <li data-headerbg="/wp-content/uploads/2016/03/header_home1.jpg">
        <div class="col-xs-7 col-sm-8 slider_text">
          <h2>NURSE CALL SYSTEMS</h2>
          <h3 class="hidden-xs">It is a long established fact that any reader will be distracted by the readable content of a page when he is looking at its layout.</h3>
          <a href="#" class="btn btn-primary btn-arrow-right">VIEW PRODUCTS</a>
        </div>
        <div class="col-xs-5 col-sm-4 slider_image">
          <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/slide2.png">
        </div>
      </li>
    </ul>

  </div>
</div>
</header>

<?php if(is_front_page()): ?>


<div class="container homecards">

  <div class="col-sm-3">
    <div class="card-title"><a href="#">Business &amp; Government</a></div>
    <div class="card-content">
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta explicabo quis nostrum exercitation ullam autem vel eum iure qui voluptate.</p>
    </div>
    <div class="card-image">
      <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card1.png">
    </div>
  </div>


  <div class="col-sm-3">
    <div class="card-title"><a href="#">Healthcare</a></div>
    <div class="card-content">
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta explicabo quis nostrum exercitation ullam autem vel eum iure qui voluptate.</p>
    </div>
    <div class="card-image">
      <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card2.png">
    </div>
  </div>


  <div class="col-sm-3">
    <div class="card-title"><a href="#">Big White Cable</a></div>
    <div class="card-content">
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta explicabo quis nostrum exercitation ullam autem vel eum iure qui voluptate.</p>
    </div>
    <div class="card-image">
      <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card3.png">
    </div>
  </div>


  <div class="col-sm-3">
    <div class="card-title"><a href="#">Fire Monitoring</a></div>
    <div class="card-content">
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta explicabo quis nostrum exercitation ullam autem vel eum iure qui voluptate.</p>
    </div>
    <div class="card-image">
      <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card4.png">
    </div>
  </div>

</div>

<?php endif; ?>
