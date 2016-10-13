<?php if(we_should_display_the_sharing_icons()): ?>
<div class="container">
  <div class="share-icons">
    <span>Share this page: </span><?php  ADDTOANY_SHARE_SAVE_KIT(); ?>
  </div>
</div>
<?php endif; ?>
<footer class="content-info">
  <div class="container">
    <div class="row">
<?php
      dynamic_sidebar('sidebar-footer');
?>


    </div>
  </div>
</footer>
<div class="container copy-info">
  <p>Copyright &copy; <?= date('Y'); ?> Omega Communications Ltd.  <span class="all-rights-reserved">All Rights Reserved</span> <span class="hidden-xs">|</span> <a href="/about/privacy-policy">Privacy Policy</a> | <a href="http://eramedia.ca/" target="_blank">An Eramedia Project</a></p>
</div>
