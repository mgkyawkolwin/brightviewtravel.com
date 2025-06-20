<?php
add_action( 'tgmpa_register', 'dt_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function dt_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name'     				=> 'LayerSlider Responsive WordPress Slider Plugin', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/LayerSlider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Revolution Slider Plugin',
			'slug'     				=> 'revslider',
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		array(
			'name'     				=> 'DesignThemes Core Features Plugin',
			'slug'     				=> 'designthemes-core-features',
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/designthemes-core-features.zip',
			'required' 				=> true,
			'version' 				=> '1.0',
			'force_activation' 		=> true,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		array(
			'name'     				=> 'Envato WordPress Toolkit',
			'slug'     				=> 'envato-wordpress-toolkit-master',
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/envato-wordpress-toolkit-master.zip',
			'required' 				=> true,
			'version' 				=> '1.5',
			'force_activation' 		=> true,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		array(
			'name'     				=> 'WooCommerce',
			'slug'     				=> 'woocommerce',
			'required' 				=> false,
			'version' 				=> '2.2.7',
			'force_activation' 		=> false,
		),
		
		array(
			'name'     				=> 'YITH WooCommerce Wishlist',
			'slug'     				=> 'yith-woocommerce-wishlist',
			'required' 				=> false,
			'version' 				=> '1.1.6',
			'force_activation' 		=> false,
		),

		array(
			'name'     				=> 'YITH WooCommerce Zoom Magnifier',
			'slug'     				=> 'yith-woocommerce-zoom-magnifier',
			'required' 				=> false,
			'version' 				=> '1.1.4',
			'force_activation' 		=> false,
		),
		
		array(
			'name'     				=> 'Responsive Styled Google Maps Generator',
			'slug'     				=> 'responsive-maps-plugin',
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/responsive-maps-plugin.zip',
			'required' 				=> false,
			'version' 				=> '2.22',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		array(
			'name' 					=> 'Contact Form 7',
			'slug' 					=> 'contact-form-7',
			'required' 				=> false,
			'version' 				=> '4.0.1',
			'force_activation' 		=> false,
		),

		array(
			'name' 					=> 'BBPress',
			'slug' 					=> 'bbpress',
			'required' 				=> false,
			'version' 				=> '2.5.4',
			'force_activation' 		=> false,
		),
		
		array(
			'name' 					=> 'BuddyPress',
			'slug' 					=> 'buddypress',
			'required' 				=> false,
			'version' 				=> '2.1.1',
			'force_activation' 		=> false,
		),
		
		array(
			'name' 					=> 'Like This',
			'slug' 					=> 'roses-like-this',
			'required'			 	=> false,
			'force_activation' 		=> false,
		),
		
		array(
			'name' 					=> 'The Events Calendar',
			'slug' 					=> 'the-events-calendar',
			'required' 				=> false,
			'version' 				=> '3.8.1',
			'force_activation' 		=> false,
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'iamd_text_domain',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'iamd_text_domain'),
			'menu_title'                       			=> __( 'Install Plugins', 'iamd_text_domain'),
			'installing'                       			=> __( 'Installing Plugin: %s', 'iamd_text_domain'), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'iamd_text_domain'),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'iamd_text_domain'),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'iamd_text_domain'),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'iamd_text_domain'), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}?>