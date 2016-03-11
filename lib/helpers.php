<?php
function dd($value)
{
  echo "<pre style='position:fixed'>";
  print_r($value);
  echo "</pre>";
  exit(0);

}

function header_background(){
  if (get_field('header_background')) {
    $image = get_field('header_background', false);
    return 'style="background-image:url('.$image['url'].')"';
  }
}


function front_page_slider(){
?>

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

<?php
}

function front_page_cards()
{
?>

<div class="container homecards">

  <div class="col-sm-3">
    <div class="homecard">
      <div class="card-title"><a href="#">Business &amp; Government</a></div>
      <div class="card-content">
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem.</p>
      </div>
      <div class="card-image">
        <a href="#" class="btn btn-primary btn-arrow-right">more</a>
        <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card1.png">
      </div>
    </div>
  </div>


  <div class="col-sm-3">
    <div class="homecard">
      <div class="card-title"><a href="#">Healthcare</a></div>
      <div class="card-content">
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab.</p>
      </div>
      <div class="card-image">
        <a href="#" class="btn btn-primary btn-arrow-right">more</a>
        <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card2.png">
      </div>
    </div>
  </div>


  <div class="col-sm-3">
    <div class="homecard">
      <div class="card-title"><a href="#">Big White Cable</a></div>
      <div class="card-content">
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
      </div>
      <div class="card-image">
        <a href="#" class="btn btn-primary btn-arrow-right">more</a>
        <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card3.png">
      </div>
    </div>
  </div>


  <div class="col-sm-3">
    <div class="homecard">
      <div class="card-title"><a href="#">Fire Monitoring</a></div>
      <div class="card-content">
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
      <div class="card-image">
        <a href="#" class="btn btn-primary btn-arrow-right">more</a>
        <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/card4.png">
      </div>
    </div>
  </div>

</div>

<?php
}


function page_header_area()
{

  $parent_title = '';
  /* is it a page */
  if( is_page() ) {
    global $post;
    /* Get an array of Ancestors and Parents if they exist */
    $parents = get_post_ancestors( $post->ID );
    /* Get the top Level page->ID count base 1, array base 0 so -1 */
    $id = ($parents) ? $parents[count($parents)-1]: $post->ID;
    /* Get the parent and set the $parent_title with the page title */
    $parent = get_post( $id );
    $parent_title = $parent->post_title;

  }
  if( is_single() || is_category() ){
    $parent_title = get_the_title( get_option('page_for_posts', true));
  }

  if('' != $parent_title): ?>
    <div class="container parent-page-title">
      <h1><?= $parent_title; ?></h1>
    </div>

  <?php endif;
}



function breadcrumbs_and_search(){
  if(!is_front_page()){
?>
<div class="container hidden-xs">
<div class="row">
  <div class="col-sm-7">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
        <?php if(function_exists('bcn_display'))
        {
            bcn_display();
        }?>
    </div>
  </div>
  <div class="col-sm-5">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
      <label>
          <span class="screen-reader-text"><?php echo _x( 'Search Products:', 'label' ) ?></span>
          <input type="search" class="search-field"
              placeholder="<?php echo esc_attr_x( 'Search Products', 'placeholder' ) ?>"
              value="<?php echo get_search_query() ?>" name="s"
              title="<?php echo esc_attr_x( 'Search Products', 'label' ) ?>" />
      </label>

    </form>
  </div>
</div>
</div>

<?php
  } //endif
}


function expandable_products_list()
{
  ?>
  <div id="listContainer">
    <ul id="expList">
        <li>
            Item A
            <ul>
                <li>
                    Item A.1
                    <ul>
                        <li>
                            <span>Link</span>
                        </li>
                    </ul>
                </li>
                <li>
                    Item A.2
                </li>
                <li>
                    Item A.3
                    <ul>
                        <li>
                            <span>Link</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            Item B
        </li>
        <li>
            Item C
            <ul>
                <li>
                    Item C.1
                </li>
                <li>
                    Item C.2
                    <ul>
                        <li>
                            <span>Link.</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
  </div>
  <?php
}
