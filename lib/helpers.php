<?php
function dd($value)
{
  echo "<pre style='position:fixed'>";
  print_r($value);
  echo "</pre>";

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


function page_header_area(){

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
  if(!is_front_page()){ ?>
<div class="hidden-xs breadcrumbs_and_search">
<div class="container">
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
</div>
<?php } //endif
}


function expandable_products_list()
{

$args = array(
  'taxonomy'     => 'product_category',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 1,
  'title_li'     => '',
  'hide_empty'   => 0
);
?>
<div id="listContainer">
  <h3>Product Categories</h3>
  <ul id="expList">
    <?php wp_list_categories( $args ); ?>
  </ul>
</div>
   <?php
}

function sidebar_list_child_pages() {

  global $post;
  if (is_page_template( 'template-b1-common.php' ) || is_page_template( 'template-b2-team.php' )) {
    if ( is_page() ){
      if ($post->post_parent) {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
        $parent_title = get_the_title($post->post_parent);
      }else{
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
        $parent_title = get_the_title($post->ID);
      }
    }

    if (isset($childpages )) {
      $string = '<section class="widget sub_pages"><h3>'.$parent_title.'</h3><ul>' . $childpages . '</ul></section>';
      echo $string;
    }
  }


}


function initiate_masonry_on_solutions_page() {
  if ( is_page_template( 'template-c1-solutions.php' ) ) {
?>
<script type="text/javascript">
(function($) {
   $('.grid').masonry({
    // options...
    columnWidth: 263,
    itemSelector: '.grid-item',
    percentPosition: true,
    gutter: 4

  });
})(jQuery);
</script>
<?php
  }
}
add_action( 'wp_footer', 'initiate_masonry_on_solutions_page',99 );



// Adds .current_page_parent to Custom Post Type and removes it from default "Blog"
function wpdev_nav_classes( $classes, $item ) {
    if( is_post_type_archive( 'product' ) || is_singular( 'product' ) || is_tax('product_category') ){
      if($item->title == 'Blog'){
        $classes = array_diff( $classes, array( 'current_page_parent' ) );
      }
      if($item->title == 'Products'){
        $classes[] = 'current_page_parent';
      }

    }

    if( is_page() ){
      if($item->title == 'Solutions' && is_page_template( 'template-c2-solutions-pages.php' )){
        $classes[] = 'current_page_parent';
      }

    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'wpdev_nav_classes', 10, 2 );
