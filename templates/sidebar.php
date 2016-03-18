<?php

if (this_is_a_blog_page()) {

  expandable_blog_categories_list();
  dynamic_sidebar('sidebar-blog');

} else {

  expandable_products_list();
  sidebar_list_child_pages();
  dynamic_sidebar('sidebar-primary');

}

?>
