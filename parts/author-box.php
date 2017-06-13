<div class="author-box">
  <div class="author-thumbnail">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 74 ); ?>
  </div>
  <div class="author-content">
    <p class="author-name"><?php the_author_meta( 'display_name' ); ?></p>
    <p class="author-description"><?php the_author_meta( 'description' ); ?></p>
  </div>
</div>
