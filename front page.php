<?php
/*
Template Name: front-page
*/
get_header();

$main_id = get_option( 'page_on_front' );
?>
  <section class="section" >
    <div class="container">
      <h1 class='title'>
        <?php the_title(); ?>
      </h1>
      <?php the_content($main_id) ?>
    </div>
  </section>

<?php
get_footer();
