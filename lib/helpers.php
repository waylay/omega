<?php
// debugging
function dd($value)
{
  echo "<pre style='position:fixed'>";
  print_r($value);
  echo "</pre>";

}
function omega_template_redirect() {
  if (! is_admin() ) {
    global $post;
    if ( is_page('contact') ) {
      wp_redirect( '/contact/contact-information/', 301 );
      exit();
    }
    if ( is_page('about') ) {
      wp_redirect( '/about/company-background/', 301 );
      exit();
    }
  }

}
add_action( 'template_redirect', 'omega_template_redirect', 1 );
function header_background(){
  if (get_field('header_background')) {
    $image = get_field('header_background', false);
    return 'style="background-image:url('.$image['url'].')" !important;';
  }
}

function this_is_a_blog_page(){
  if (is_home() || is_singular( 'post' ) || is_post_type_archive('post') || is_tag() || is_category() || is_date() || is_search()) {
    if(!is_post_type_archive('product')){
      return true;
    }
  }
  return false;
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
          <a href="#" class="btn btn-primary btn-arrow-right">View Products</a>
        </div>
        <div class="col-xs-5 col-sm-4 slider_image">
          <img src="<?= get_stylesheet_directory_uri() ?>/dist/images/slide1.png">
        </div>

      </li>
      <li data-headerbg="/wp-content/uploads/2016/03/header_home1.jpg">
        <div class="col-xs-7 col-sm-8 slider_text">
          <h2>NURSE CALL SYSTEMS</h2>
          <h3 class="hidden-xs">It is a long established fact that any reader will be distracted by the readable content of a page when he is looking at its layout.</h3>
          <a href="#" class="btn btn-primary btn-arrow-right">View Products</a>
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
  if( this_is_a_blog_page() ){
    $parent_title = get_the_title( get_option('page_for_posts', true));
  }
  if( is_tax('product_category') || is_post_type_archive('product' ) ){
    $parent_title = 'Products';
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
  <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
  </div>
  <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search Products:', 'label' ) ?></span>
        <?php if (this_is_a_blog_page()): ?>
          <input type="search" class="search-field" required="true"
            placeholder="<?php echo esc_attr_x( 'Search Blog', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search Blog', 'label' ) ?>" />
        <?php else: ?>
          <input type="hidden" name="post_type" value="product" />
          <input type="search" class="search-field" required="true"
            placeholder="<?php echo esc_attr_x( 'Search Products', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search Products', 'label' ) ?>" />
        <?php endif ?>

    </label>
  </form>
</div>
</div>
<?php } //endif
}


function expandable_products_list(){

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

function expandable_blog_categories_list(){

$args = array(
  'taxonomy'     => 'category',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 1,
  'title_li'     => '',
  'hide_empty'   => 0
);
?>
<div id="listContainer">
  <h3>Blog Categories</h3>
  <ul id="expList">
    <?php wp_list_categories( $args ); ?>
  </ul>

<?php
 $archive_args = array(
  'type'            => 'yearly',
  'limit'           => '',
  'format'          => 'html',
  'before'          => '',
  'after'           => '',
  'show_post_count' => false,
  'echo'            => 1,
  'order'           => 'DESC',
        'post_type'     => 'post'
);
?>
<h3>Blog Archives</h3>
<ul>
<?php wp_get_archives( $archive_args ); ?>
</ul>
</div>
<?php
}


function sidebar_list_child_pages(){

  global $post;
  if (is_page_template( 'template-b1-common.php' ) ||
      is_page_template( 'template-b2-team.php' ) ||
      is_page_template( 'template-f-contact.php' )) {
    if ( is_page() ){
      if ($post->post_parent) {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&exclude=297' );
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


function initiate_masonry_on_solutions_page(){
  if ( is_page_template( 'template-c1-solutions.php' ) ) {
?>
<script type="text/javascript">
$(window).load(function() {
   $('.grid').masonry({
    // options...
    columnWidth: 263,
    itemSelector: '.grid-item',
    percentPosition: true,
    gutter: 4

  });
});
</script>
<?php
  }
}
add_action( 'wp_footer', 'initiate_masonry_on_solutions_page',99 );



// Adds .current_page_parent to Custom Post Type and removes it from default "Blog"
function omega_nav_classes( $classes, $item ) {
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
add_filter( 'nav_menu_css_class', 'omega_nav_classes', 10, 2 );


function omega_custom_pagination_links(){
    global $wp_query;
    $big = 99999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type'  => 'array',
            'prev_next'   => true,
      'prev_text'    => __('&laquo; previous page'),
      'next_text'    => __('next page &raquo;'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
        }
}

function we_should_display_the_sharing_icons(){
  global $post;
  if (!function_exists( 'ADDTOANY_SHARE_SAVE_KIT' )) {
    return false;
  }
  if(is_front_page() || is_archive() || is_home() || is_search()){
    return false;
  }

  if(is_tax('product_category' )){
    return false;
  }

  $sharing_disabled = get_post_meta( get_the_ID(), 'sharing_disabled', true );
  $sharing_disabled = apply_filters( 'addtoany_sharing_disabled', $sharing_disabled );
  if ( get_post_status( get_the_ID() ) == 'private' || ! empty( $sharing_disabled ) ){
    return false;
  }

  return true;
}

// inserts a hidden field in a CF7 form with product name
function cf7_add_product_name(){
  if(isset($_GET['product_id'])){

    $product_id = intval( esc_attr($_GET['product_id']));
    if($product_id==0){ return false; }

    $product_name = get_the_title($product_id);

    return $product_name;
  }
  return false;
}

add_shortcode('CF7_ADD_PRODUCT_NAME', 'cf7_add_product_name');


// inserts a hidden field in a CF7 form with product manufacturer
function cf7_add_product_manufacturer(){

  if(isset($_GET['product_id'])){

    $product_id = intval( esc_attr($_GET['product_id']));
    if($product_id == 0){ return false; }

    $product_manufacturer = strip_tags( get_the_term_list( $product_id, 'manufacturer', '', ' / ' ) );

    return $product_manufacturer;
  }
  return false;

}

add_shortcode('CF7_ADD_PRODUCT_MANUFACTURER', 'cf7_add_product_manufacturer');


// Displays a box with the selected product for which one is requesting more info
function cf7_display_product_box(){
  if(isset($_GET['product_id'])){

    $product_id = intval( esc_attr($_GET['product_id']));
    if($product_id == 0){ return false; }

    $product_name = get_the_title($product_id);
    $product_manufacturer = strip_tags( get_the_term_list( $product_id, 'manufacturer', '', ' / ' ) );
    $product_image = get_the_post_thumbnail( $product_id, 'thumbnail' );

    $box = '<div class="wpcf7 product-box form-group form-control">';
      $box .= '<div class="row">';
        $box .= '<div class="col-sm-4">';
          $box .= $product_image;
        $box .= '</div>';
        $box .= '<div class="col-sm-8">';
          $box .= '<p><strong>Product: </strong>'.$product_name.'</p>';
          $box .= '<p><strong>Manufacturer: </strong>'.$product_manufacturer.'</p>';
        $box .= '</div>';
      $box .= '</div>';
    $box .= '</div>';

    return $box;
  }
  return false;
}

add_shortcode('display_product_box', 'cf7_display_product_box');
