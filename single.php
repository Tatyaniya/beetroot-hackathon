<?php
get_header();

$main_id = get_option( 'page_on_front' );

?>

  <section class="main-blog">
      <div class="container">
        <h1 class="title">
          <?php the_title(); ?>
        </h1>
      </div>
  </section>

<?php
get_footer();
?>

