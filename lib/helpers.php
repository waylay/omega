<?php
// debugging
function dd($value)
{
  echo "<pre style='position:fixed'>";
  print_r($value);
  echo "</pre>";

}

/*
* Redirect 'Menu Only' pages
*/
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


// Sets the headere bg using default backgorunds and specific ones (assigned for posts and pages)
function header_background(){
  $image = '';

  // Load default values
  if(is_page()){
    $image = get_field('header_for_pages','option');
  } else if(this_is_a_blog_page()){
    $image = get_field('header_for_blog','option');
  } else {
    $image = get_field('header_for_products','option');
  }

  // Overwrite them if we have a specific bg
  if (get_field('header_background') && ( is_single() || is_page() ) ) {
    $image = get_field('header_background');
  }
  return 'style="background-image:url('.$image.')" !important;';
}

// Check if the page belongs to the blog
function this_is_a_blog_page(){
  if (is_home() || is_singular( 'post' ) || is_post_type_archive('post') || is_tag() || is_category() || is_date() || is_search()) {
    if(!is_post_type_archive('product')){
      return true;
    }
  }
  return false;
}


// Generates the page slider
function front_page_slider(){ ?>
<div class="container slider-container">
  <div class="flexslider">
    <ul class="slides">
<?php // check if the repeater field has rows of data
if( have_rows('slides') ):

  // loop through the rows of data
  while ( have_rows('slides') ) : the_row();

    // display a sub field value
    $slide_title      = get_sub_field('slide_title');
    $slide_text       = get_sub_field('slide_text');
    $slide_button_text= get_sub_field('slide_button_text');
    $slide_button_url = get_sub_field('slide_button_url');
    $slide_background_attr = wp_get_attachment_image_src( get_sub_field('slide_background'), 'home-slide-background' );
    $slide_background = $slide_background_attr[0];
    $slide_image_attr      = wp_get_attachment_image_src( get_sub_field('slide_image'), 'home-slide-image' );
    $slide_image      = $slide_image_attr[0];

    ?>
      <li data-headerbg="<?= $slide_background; ?>">

        <div class="col-xs-7 col-sm-8 slider_text">
          <h2><?= $slide_title; ?></h2>
          <h3 class="hidden-xs"><?= $slide_text; ?></h3>
          <a href="<?= $slide_button_url; ?>" class="btn btn-primary btn-arrow-right"><?= $slide_button_text; ?></a>
        </div>
        <div class="col-xs-5 col-sm-4 slider_image">
          <img src="<?= $slide_image; ?>">
        </div>

      </li>

    <?php
  endwhile;

else :

    echo "<li>Please set up the home page slider.</li>";

endif; ?>
    </ul>
  </div>
</div>


<?php
}


// Generates the front cards.
function front_page_cards(){ ?>

<div class="container homecards">

<?php // check if the repeater field has rows of data
if( have_rows('page_cards', 'option') ):

  // loop through the rows of data
  while ( have_rows('page_cards', 'option') ) : the_row();

    // display a sub field value
    $card = get_sub_field('page_card','option');

    ?>
    <div class="col-sm-4">
      <div class="homecard">
        <div class="card-title"><a href="<?= get_permalink($card->ID); ?>"><?= $card->post_title; ?></a></div>
        <div class="card-content">
          <p><?=  wp_trim_words( $card->post_content, 15, '...' ); ?></p>
        </div>
        <div class="card-image">
          <a href="<?= get_permalink($card->ID); ?>" class="btn btn-primary btn-arrow-right">more</a>
          <?= get_the_post_thumbnail($card->ID, "home-card");  ?>
        </div>
      </div>
    </div>
  <?php
  endwhile;

else :

    echo "Please set the cards in the Setup/Home Cards option.";

endif; ?>

</div>

<?php
}


// The H1 title shown inside the header

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




// Shows the breadcrumbs and the search form above the content.
// The Search is dynamic (for posts and for products) depending of the page you're looking at
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

// Limit search to a post types
function limit_search_results_filter($query) {
  if(isset($_GET['post_type'])){
    $post_type = $_GET['post_type'];
  }
  if (!isset($post_type)) {
    $post_type = 'post';
  }
    if ($query->is_search) {
        $query->set('post_type', $post_type);
    };
    return $query;
};

add_filter('pre_get_posts','limit_search_results_filter',99);

function expandable_products_list(){

$args = array(
  'taxonomy'     => 'product_category',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 1,
  'title_li'     => '',
  'hide_empty'   => 0,
  'use_desc_for_title' => 0
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
  'hide_empty'   => 0,
  'use_desc_for_title' => 0
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

      if ($post->post_parent) {
        // we are looking at a child page
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&exclude=297' );
        $parent_title = get_the_title($post->post_parent);
      }else{
        // check to see if the page has child pages
        $children = get_pages('child_of='.$post->ID);
        if( count( $children ) != 0 ){
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

function sidebar_list_child_solutions(){

  global $post;
  if (is_page_template( 'template-c1-solutions.php' )) {

    $post_parent = ($post->post_parent > 0) ? $post->post_parent : $post->ID;

    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $post_parent,
        'orderby'       => 'menu_order',
        'order'         => 'ASC',
        'meta_query'    => array(
            array(
                'key'   => '_wp_page_template',
                'value' => 'template-c1-solutions.php'
            )
        )
    );

    $solutions = new WP_Query( $args );

    $post_ids = implode(',', wp_list_pluck( $solutions->posts, 'ID' ));

      if($post->ID == $post_parent){
        $childpages = '<li class="page_item current_page_item"><a href="'.get_the_permalink($post_parent).'">Industry Solutions</a></li>';
      } else {
        $childpages = '<li class="page_item"><a href="'.get_the_permalink($post_parent).'">Industry Solutions</a></li>';
      }

      if($post_ids){
        $childpages .= wp_list_pages( 'sort_column=menu_order&title_li=&include=' . $post_ids . '&echo=0' );
      }
      if (isset($childpages )) {
        $string = '<section class="widget sub_pages"><h3>'.get_the_title($post_parent).'</h3><ul>' . $childpages . '</ul></section>';
        echo $string;
      }

  }

}

function sidebar_list_cards(){

  if (is_page_template( 'template-b1-common.php' ) || is_page_template( 'template-b2-team.php' ) ) { ?>

<section class="widget sub_pages sidecards">
<?php // check if the repeater field has rows of data
if( have_rows('page_cards', 'option') ):

  // loop through the rows of data
  while ( have_rows('page_cards', 'option') ) : the_row();

    // display a sub field value
    $card = get_sub_field('page_card','option');

    ?>
    <h3><a href="<?= get_permalink($card->ID); ?>"><?= $card->post_title; ?></a></h3>
    <div class="sidecard">
      <div class="card-image">
        <a href="<?= get_permalink($card->ID); ?>" class="btn btn-primary btn-arrow-right">more</a>
        <?= get_the_post_thumbnail($card->ID, "home-card");  ?>
      </div>
      <div class="card-content">
        <?=  wp_trim_words( $card->post_content, 15, '...' ); ?>
      </div>

    </div>

  <?php
  endwhile;

else :

    echo "Please set the cards in the Setup/Home Cards option.";

endif; ?>

</section>

<?php
  } // endif
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
