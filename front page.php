<?php
/*
Template Name: front-page
*/

get_header(); ?>

<?php if (have_posts()) :

    the_content();

    ?>
<?php endif; ?>

<?php
get_footer();

