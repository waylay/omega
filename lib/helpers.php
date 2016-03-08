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
