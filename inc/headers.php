<?php

add_filter( 'gettext', 'my_translations', 10, 3 );

function my_translations( $translation, $text, $domain ) {

	$translations = &get_translations_for_domain( $domain );

	if ( 'Images of exactly <strong>%1$d &times; %2$d pixels</strong> will be used as-is.' == $text ) {
		$translation = $translations->translate( '<p>Images of exactly <strong>%1$d &times; %2$d pixels</strong> will be used as-is. You can customize these dimensions by using the <strong>Resize Header</strong> tool.</p>  ' );
	 }


	return $translation;
}

if ( !get_option( 'resize_header_options' ) ) {

	$resize_header_options = array( 'width'	=> HEADER_IMAGE_WIDTH, 'height' => HEADER_IMAGE_HEIGHT );
	add_option( 'resize_header_options', $resize_header_options );

}

function resize_header_height( $size ) {
	$options = get_option( 'resize_header_options' );
   	return $options['height'];
}
function resize_header_width( $size ) {
  $options = get_option( 'resize_header_options' );
   	return $options[ 'width' ];
}

add_filter('alice_header_image_height','resize_header_height');
add_filter('alice_header_image_width','resize_header_width');

// create the admin menu
add_action( 'admin_menu', 'add_resize_header_option_page' );

function add_resize_header_option_page() {
	add_theme_page('Resize Header', 'Resize Header', 'edit_theme_options', __FILE__, 'resize_header_options_page');
}

function resize_header_options_page() { 	// Output the options page
	$options = get_option( 'resize_header_options' );
?>
	<div class="wrap">
		<form method="post" action="options.php">

		<?php wp_nonce_field('update-options'); ?>

		<h2>Resize theme header image size</h2>
		<p>For best results, your header width should be 200px.</p>

		<table class="form-table">

		<tr valign="top">
			<th scope="row">Width</th><br />
			<td><input type="text" name="resize_header_options[width]" value="<?php echo $options['width']; ?>"/>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">Height</th><br />
			<td><input type="text" name="resize_header_options[height]" value="<?php echo $options['height']; ?>"/>
			</td>
		</tr>

		</table>

		<input type="hidden" name="page_options" value="resize_header_options" />
		<input type="hidden" name="action" value="update" />	
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</form>

	</div><!--//wrap div-->
<?php } ?>