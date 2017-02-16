<?php if ( cd_sidebar_stg() === 'hide' ) { return; } ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

  <aside class="sidebar">

    <?php dynamic_sidebar('sidebar-1'); ?>

  </aside><!--/.sidebar-->

<?php endif; ?>
