<?php
/**
 * @package WordPress
 * @subpackage alice
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary" class="eightcol last">
		<div id="content">

			<article id="post-0" class="post error404 not-found" role="article">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'That page was not found.', 'alice' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching will help.', 'alice' ); ?></p>

					<?php get_search_form(); ?>

					

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>