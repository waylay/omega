<?php use Roots\Sage\Titles;

if(!is_front_page()):
?>
<div class="page-header">
  <h1><?= Titles\title(); ?></h1>
</div>
<?php endif; ?>
