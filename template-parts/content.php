<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Lahavmedia
 */

if ( get_the_content() ) :?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content(); ?>

	</article><!-- #post-## -->
<?php
endif;
