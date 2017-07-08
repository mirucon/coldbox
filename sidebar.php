<?php if ( cd_sidebar_stg() === 'hide' ) { return; } ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

  <aside class="sidebar-s1">

    <div class="sidebar">

      <div class="sidebar-inner">

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

      </div>

    </div>

  </aside><!--/.sidebar-->

<?php endif; ?>
