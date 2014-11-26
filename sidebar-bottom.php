<?php
/**
 * @package WordPress
 * @subpackage alice
 */
?>	

<div id="tertiary" class="threecol sidebar">


<?php if ( is_single() || is_home() || is_archive() ) { //only show the second widget area if we're on a blog-related page ?>

	<div class="widget-area">
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<h2 class="widget-title"><?php _e( 'Blog', 'alice' ); ?></h2>
			<aside id="archives" class="widget" role="complementary">
				
				<label for="archive-dropdown">Archives</label><br />
				<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
				  <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
				  <?php wp_get_archives( 'type=monthly&format=option&show_post_count=1' ); ?>
				</select>
			</aside>

			<aside id="search" class="widget widget_search" role="complementary">
				<?php get_search_form(); ?>
			</aside>
			
		<?php endif; // end sidebar widget area ?>
	</div><!-- .widget-area -->

<?php } //end the second widget section ?>

		
	<nav class="page-nav">
			<ul class="xoxo">
			<?php if ( ! dynamic_sidebar( 'nav-menus' ) ) : // begin primary sidebar widgets ?>
				<h2 class="widget-title"><?php _e( 'Pages', 'alice' ); ?></h2>
				<li id="pages">
					<ul>
					<?php wp_list_pages('title_li=&sort_column=menu_order' ) ?>
					</ul>
				</li>

			<?php endif; // end primary sidebar widgets  ?>
			</ul>

	</nav><!-- .page-nav -->


</div><!-- #tertiary-->			