<?php
/**
 * @package WordPress
 * @subpackage alice
 */

get_header(); ?>
<?php get_sidebar(); ?>

		<div id="primary" class="eightcol last">
			<div id="content">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php
							printf( __( '<span class="sep">By </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span> &nbsp; | &nbsp; <span class="sep"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a></span>', 'alice' ),
								get_permalink(),
								get_the_date( 'c' ),
								get_the_date(),
								get_author_posts_url( get_the_author_meta( 'ID' ) ),
								sprintf( esc_attr__( 'View all posts by %s', 'alice' ), get_the_author() ),
								get_the_author()
							);
						?>
					</div><!-- .entry-meta -->
										</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'alice' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php
							$tag_list = get_the_tag_list( '', ', ' );
							if ( '' != $tag_list ) {
								$utility_text = __( '<span class="meta-title">Posted in:</span> %1$s<br /><span class="meta-title">Tagged:</span> %2$s', 'alice' );
							} else {
								$utility_text = __( '<span class="meta-title">Posted in:</span> %1$s', 'alice' );
							}
							printf(
								$utility_text,
								get_the_category_list( ', ' ),
								$tag_list,
								get_permalink(),
								the_title_attribute( 'echo=0' )
							);
						?>

						<?php edit_post_link( __( 'Edit', 'alice' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template( '', true ); ?>

<nav id="nav-below" role="article">
	<h1 class="section-heading"><?php _e( 'Post navigation', 'alice' ); ?></h1>
	<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'alice' ) . '</span> %title' ); ?></div>
	<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'alice' ) . '</span>' ); ?></div>
</nav><!-- #nav-below -->


			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>