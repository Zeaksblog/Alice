<?php
/**
 * @package WordPress
 * @subpackage alice
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary" class="eightcol last">
			<div id="content">

				<?php get_template_part( 'loop', 'index' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>