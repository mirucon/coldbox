<footer id="footer">
  <div class="container">

    <div id="copyright">
      <p>&copy;<?php echo date( 'Y' ); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a> </p>
      <?php if ( cd_is_theme_credit() ): ?>
        <?php echo cd_theme_credit_text(); ?>
      <?php endif; ?>
    </div><!--/#copyright-->

  </div><!--/.container-->

  <a id="back-to-top" href="#"><span class="chevron-up"></span></a>

</footer>


<?php wp_footer(); ?>
</body></html>
