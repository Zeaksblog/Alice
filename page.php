<?php
/**
 * @package WordPress
 * @subpackage alice
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary" class="eightcol last">
			<div id="content">

				<?php the_post(); ?>
				
					<?php if(has_post_thumbnail()) {?>
						<?php the_post_thumbnail('large');?>
					<?php } ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'alice' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'alice' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php //comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>