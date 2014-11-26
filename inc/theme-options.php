<?php

//via themeshaper.com/2010/06/03/sample-theme-options/

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

//color picker
wp_register_script( 'color-picker', get_bloginfo('template_url') . '/inc/color-picker/jquery.miniColors.min.js', false, '0.1', true ); 
wp_enqueue_script( 'color-picker' );

wp_register_style( 'color-picker', get_bloginfo('template_url') . '/inc/color-picker/jquery.miniColors.css', false, '0.1', 'screen' ); 
wp_enqueue_style( 'color-picker' );


/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'alice_options', 'alice_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'alicetheme' ), __( 'Theme Options', 'alicetheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$font_style_options = array(
	'sans-serif' => array(
		'value' =>	'sans-serif',
		'label' => __( 'sans-serif', 'alicetheme' )
	),
	'serif' => array(
		'value' =>	'serif',
		'label' => __( 'serif', 'alicetheme' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $font_style_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'alicetheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'alicetheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'alice_options' ); ?>
			<?php $options = get_option( 'alice_theme_options' ); ?>

			<table class="form-table">
				
			<tr valign="top"><th scope="row"><?php _e( 'Google Analytics tracking ID', 'alicetheme' ); ?></th>
				<td>
					<input id="alice_theme_options[analytics]" class="regular-text" type="text" name="alice_theme_options[analytics]" value="<?php esc_attr_e( $options['analytics'] ); ?>" />
					<label class="description" for="alice_theme_options[sometext]"><?php _e( 'e.g.: UA-XXXXXXXX-X', 'alicetheme' ); ?></label>
				</td>
			</tr>
			
			
			<tr valign="top"><th scope="row"><?php _e( 'Font style', 'alicetheme' ); ?></th>
				<td>
					<select name="alice_theme_options[font_style]">
						<?php
							$selected = $options['font_style'];
							$p = '';
							$r = '';
			
							foreach ( $font_style_options as $option ) {
								$label = $option['label'];
								if ( $selected == $option['value'] ) // Make default first in list
									$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								else
									$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
							}
							echo $p . $r;
						?>
					</select>
				</td>
			</tr>
												
			<tr valign="top"><th scope="row"><?php _e( 'Header color', 'alicetheme' ); ?></th>
				<td>
					<input class="color-picker" id="alice_theme_options[header_color]" class="regular-text" type="text" name="alice_theme_options[header_color]" value="<?php esc_attr_e( $options['header_color'] ); ?>" />
				</td>
			</tr>

			<tr valign="top"><th scope="row"><?php _e( 'Remove header background color', 'alicetheme' ); ?></th>
				<td>
					<input id="alice_theme_options[remove_header_bg]" name="alice_theme_options[remove_header_bg]" type="checkbox" value="1" <?php checked( '1', $options['remove_header_bg'] ); ?> />
				</td>
			</tr>
			
							
			<tr valign="top"><th scope="row"><?php _e( 'Custom CSS', 'alicetheme' ); ?></th>
					<td>
						<textarea id="alice_theme_options[custom_css]" class="medium-text" cols="50" rows="10" name="alice_theme_options[custom_css]"><?php echo stripslashes( esc_textarea( $options['custom_css'] ) ); ?></textarea>
						<br /><label class="description" for="alice_theme_options[custom_css]"><?php _e( 'It is recommended that you make CSS changes here and do not edit the main style.css file.', 'alicetheme' ); ?></label>
					</td>
			</tr>
		
			<tr valign="top"><th scope="row"><?php _e( 'Email address', 'alicetheme' ); ?></th>
				<td>
					<input id="alice_theme_options[license]" class="regular-text" type="text" name="alice_theme_options[license]" value="<?php esc_attr_e( $options['license'] ); ?>" />
					<label class="description" for="alice_theme_options[license]"><br /><?php _e( 'You must enter your email address to activate the theme license and receive free udpates.', 'alicetheme' ); ?></label>				</td>
			</tr>
									
			
				<?php //hold on to these for a little while in case we need them
				/**
				 * A alice checkbox option
				 */
				 /*	
				<tr valign="top"><th scope="row"><?php _e( 'A checkbox', 'alicetheme' ); ?></th>
					<td>
						<input id="alice_theme_options[option1]" name="alice_theme_options[option1]" type="checkbox" value="1" <?php checked( '1', $options['option1'] ); ?> />
						<label class="description" for="alice_theme_options[option1]"><?php _e( 'alice checkbox', 'alicetheme' ); ?></label>
					</td>
				</tr>

				
				/**
				 * A alice text input option
				
				
				<tr valign="top"><th scope="row"><?php _e( 'Some text', 'alicetheme' ); ?></th>
					<td>
						<input id="alice_theme_options[sometext]" class="regular-text" type="text" name="alice_theme_options[sometext]" value="<?php esc_attr_e( $options['sometext'] ); ?>" />
						<label class="description" for="alice_theme_options[sometext]"><?php _e( 'alice text input', 'alicetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A alice select input option
				
				<tr valign="top"><th scope="row"><?php _e( 'Select input', 'alicetheme' ); ?></th>
					<td>
						<select name="alice_theme_options[font_style]">
							<?php
								$selected = $options['font_style'];
								$p = '';
								$r = '';

								foreach ( $font_style_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="alice_theme_options[font_style]"><?php _e( 'alice select input', 'alicetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A alice of radio buttons
				
				<tr valign="top"><th scope="row"><?php _e( 'Radio buttons', 'alicetheme' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'alicetheme' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $radio_options as $option ) {
								$radio_setting = $options['radioinput'];

								if ( '' != $radio_setting ) {
									if ( $options['radioinput'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="alice_theme_options[radioinput]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * A alice textarea option
			
				<tr valign="top"><th scope="row"><?php _e( 'A textbox', 'alicetheme' ); ?></th>
					<td>
						<textarea id="alice_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="alice_theme_options[sometextarea]"><?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="alice_theme_options[sometextarea]"><?php _e( 'alice text box', 'alicetheme' ); ?></label>
					</td>
				</tr>

			*/ ?>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'alicetheme' ); ?>" />
			</p>
		</form>

		<a href="http://madebyraygun.com"><img style="margin-top:30px;" src="<?php echo bloginfo ('stylesheet_directory');?>/images/logo.png" width="225" height="70" alt="Made by Raygun" /></a>
		<p style="width:600px">You're using Alice theme for WordPress, v. <?php echo $options['version'];?>, made by <a href="http://madebyraygun.com">Raygun</a>. Check out our <a href="http://madebyraygun.com/wordpress/" target="_blank">other themes and plugins</a>, and if you have any problems, stop by our <a href="http://madebyraygun.com/support/forum/" target="_blank">support forum</a>!</p>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	
	// Say our textarea option must be safe text with the allowed tags for posts
	$input['custom_css'] = wp_filter_post_kses( $input['custom_css'] );
	$input['custom_footer'] = wp_filter_post_kses( $input['custom_footer'] );
	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/