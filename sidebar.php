<?php
/**
 * @package WordPress
 * @subpackage alice
 */
?>	

<div id="secondary" class="threecol sidebar">

	<header id="branding" role="banner">
					<?php if ( is_front_page() ) { echo '<h1 id="site-title">'; } else { echo '<p id="site-title">';}?>

					<?php if ( get_header_image() != '') { // if the header image exists ?>
						<?php $header_img = get_header_image();  ?>
						<a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" /></a>
					<?php }  else { ?>
						<span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<?php } ?>

					<?php if ( is_front_page() ) { echo '</h1>'; } else { echo '</p>';}?>

					<?php //alice_tagline();?>

		</header><!-- #branding -->
		
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

</div><!-- #secondary-->
<div class="onecol"></div>