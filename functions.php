<?php
/**
 * @package WordPress
 * @subpackage alice
 */

define( "ALICE_THEME_VERSION", "1.0.3" );

global $alice_theme_options;
$alice_theme_options = get_option('alice_theme_options');

if ( $alice_theme_options['version'] < ALICE_THEME_VERSION ) { 
 require_once ( 'inc/upgrader.php' );
}

if ( is_admin() ) {
  // Load the theme options page
	require_once ( 'inc/theme-options.php' );

  // automatic theme updater http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes

  global $alice_theme_options;
  if ( $alice_theme_options['license']  && PHP_VERSION > 5 ) {
   require 'inc/theme-update-checker.php';
   $license = $alice_theme_options['license'];
      
    $alice_update_checker = new ThemeUpdateChecker(
      "alice", "http://madebyraygun.com/plugin-support/om0urOxipuz8/alice.php?secret=$license"
    );   
    
  }
} // end if ( is_admin() )

/* Custom Headers */
// The height and width of your custom header. You can hook into the theme's own filters to change these values.
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'alice_header_image_width', 200 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'alice_header_image_height', 80 ) );

// Don't support text inside the header image.
define( 'NO_HEADER_TEXT', true );
add_custom_image_header( '', 'alice_admin_header_style' );

if ( ! function_exists( 'alice_admin_header_style' ) ) :
  function alice_admin_header_style() {
?>
<style type="text/css"> #headimg {border-bottom: 1px solid #000; border-top: 4px solid #000;}</style>
<?php } endif;

/* End Custom Headers */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'alice_theme', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;

/**
 * Remove code from the <head>
 */
remove_action('wp_head', 'rsd_link'); // Might be necessary if you or other people on this site use remote editors.
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'index_rel_link'); // Displays relations link for site index
remove_action('wp_head', 'wlwmanifest_link'); // Might be necessary if you or other people on this site use Windows Live Writer.
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Display relational links for the posts adjacent to the current post.
function alice_remove_version() {return '';}
add_filter('the_generator', 'alice_remove_version');

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/** 
 * Give me some widgets
 */

register_sidebar(array(
  'name' => 'Navigation menus',
  'id'	=>	'nav-menus',
  'description' => 'Put as many custom menus as you want here, or any other widgets that you want to show on every page.',
  'before_title' => '<h2 class="widget-title">',
  'after_title' => '</h2>'
));

register_sidebar(array(
  'name' => 'Blog Widgets',
  'id'	=>	'sidebar',
  'description' => 'Only shown on blog-related pages..',
  'before_title' => '<h2 class="widget-title">',
  'after_title' => '</h2>'
));

function alice_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
      	<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> &nbsp;|&nbsp;<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(),  get_comment_time()) ?></a>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <?php comment_text() ?>
	
      <!--<div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>-->
       <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      
     </div>
<?php
}
        

function alice_google_analytics() {
  global $alice_theme_options;
  if ( $alice_theme_options['analytics'] ) { ?>
     
 <!-- Google Analytics added by Alice theme -->    
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $alice_theme_options['analytics'];?>']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- end Analytics -->
<?php } 
}

if ( ! is_admin() ) {

	wp_deregister_script( 'jquery' ); 
	wp_register_script( 'jquery', ( "https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" ), false, '1.6.1', false ); 
	wp_enqueue_script( 'jquery' );

  wp_register_script( 'alice',get_stylesheet_directory_uri() . '/js/global.js', false, '2.0', true ); 
  wp_enqueue_script( 'alice' );
}

function alice_header_styles() {
  global $alice_theme_options;
  
  $custom_alice_styles = '';
 
  if ( $alice_theme_options['custom_css'] ) {
    $custom_alice_styles .= $alice_theme_options['custom_css'];
  } 
    
    if ( $alice_theme_options['header_color'] ) {
      $custom_alice_styles .= '
      #site-title { background-color: ' . $alice_theme_options['header_color'] . ' }';
    } 
  
  
  if ( ! empty( $custom_alice_styles ) ) { echo '
    <!-- Custom styles added by Alice theme --> 
    <style>
    ' . stripslashes( $custom_alice_styles ) . '
    </style>
    <!-- End Alice theme custom styles-->';
  } 
}


function alice_font_styles() {
  global $alice_theme_options;
 
  if ( $alice_theme_options['font_style'] == 'serif' ) {
		echo "<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>";   
  } else {
		echo "<link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>";
	}
}


// Add specific CSS class by filter
add_filter('body_class','alice_class_names');

function alice_class_names($classes) {
	global $alice_theme_options;
	
	if ( $alice_theme_options['font_style'] == 'serif' ) {
	$classes[] = 'serif';		
	}  

	if ( $alice_theme_options['remove_header_bg'] || get_header_image() != '' ) {
	$classes[] = 'no-header';		
	}  	
		
	// return the $classes array
	return $classes;
}


function alice_tagline() {
  global $alice_theme_options;

  if ( $alice_theme_options['show_tagline'] ) { ?>
  <p id="site-description"><?php bloginfo( 'description' ); ?></p>
  <?php } 
   
}

?>