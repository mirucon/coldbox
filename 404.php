<?php get_header(); ?>

<main id="main">

  <section class="main-inner">

    <?php get_template_part('parts/title-box') ?>

    <div class="container-outer">
      <div class="container">

        <div class="content">

          <div class="content-inner">

            <div class="error-messages">

              <p>That page couldn't be found. Please try the search.</p>
              <?php get_search_form(); ?>

            </div>

          </div><!--/.content-->

        </div>

        <?php get_sidebar(); ?>

      </div><!--/.container-->
    </div><!--/.container-outer-->

  </section>

</main>

<?php get_footer(); ?>
