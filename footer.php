<footer id="footer">
  <div class="container">

    <div id="copyright">

      <?php function current_year() { return esc_html( date( 'Y' ) ); } ?>  
      <p>&copy;<?php current_year(); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a> </p>

      <?php if ( cd_is_theme_credit() ) : ?>
        <?php echo wp_kses( cd_theme_credit_text(), array( 'a' => array( 'href' => array (), 'onclick' => array (), 'target' => array() ), 'p' => array( 'style' => array (), 'align' => array (), 'target' => array() ), 'br' => array(), 'strong' => array(), 'b' => array(), ) ); ?>
      <?php endif; ?>

    </div><!--/#copyright-->

  </div><!--/.container-->

  <a id="back-to-top" href="#"><span class="chevron-up"></span></a>

</footer>


<?php wp_footer(); ?>
</body></html>
