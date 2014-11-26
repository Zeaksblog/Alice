<?php 

if ( ! $alice_theme_options ) { //initialize the options array if it's never been set before 

	$alice_theme_options = array(
		'font_style' => 'sans-serif',
		'custom_css' => '',
		'header_color' => '',
		'remove_header_bg' => '',
		'license' => '',
		'version' => ALICE_THEME_VERSION
		); 

	update_option( 'alice_theme_options', $alice_theme_options );

} else { //otherwise we're going add any new options & update the version number
		
	$alice_theme_options['version'] = ALICE_THEME_VERSION;
		
	update_option( 'alice_theme_options', $alice_theme_options );  
}

?>