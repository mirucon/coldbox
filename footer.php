<footer id="footer">
  <div class="container">

    <div id="copyright">
      <p>&copy;<?php echo date( 'Y' ); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a> </p>
      <?php if ( cd_is_theme_credit() ): ?>
        <p><?php _e( 'Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>,  <a href="https://coldbox.miruc.co/" target="_blank">Coldbox</a> Theme by <a href="https://miruc.co/" target="_blank">Mirucon</a>', 'coldbox' ) ?>
      <?php endif; ?>
    </div><!--/#copyright-->

  </div><!--/.container-->

  <a id="back-to-top" href="#"><span class="chevron-up"></span></a>

</footer>


<?php wp_footer(); ?>
</body></html>
