<?php
require_once get_template_directory() . '/app/init.php';
unload_ThemeInit::unload_singleton()->init();

require_once( get_template_directory() . '/envato_setup/envato_setup.php' );
add_filter('unload_theme_setup_wizard_username', 'unload_set_theme_setup_wizard_username', 10);
if( ! function_exists('unload_set_theme_setup_wizard_username') ){
	function unload_set_theme_setup_wizard_username($username){
		return 'webinane';
	}
}

add_filter('unload_theme_setup_wizard_oauth_script', 'unload_set_theme_setup_wizard_oauth_script', 10);
if( ! function_exists('unload_set_theme_setup_wizard_oauth_script') ){
	function unload_set_theme_setup_wizard_oauth_script($oauth_url){
		return 'http://api.webinane.com/envato/api/server-script.php';
	}
}

if ( function_exists( 'vc_map' ) ) {
	function unload_vc_disable_update() {
		if ( function_exists( 'vc_license' ) && function_exists( 'vc_updater' )
		     && ! vc_license()->isActivated()
		) {

			remove_filter( 'upgrader_pre_download',
				[ vc_updater(), 'preUpgradeFilter' ], 10 );
			remove_filter( 'pre_set_site_transient_update_plugins', [
				vc_updater()->updateManager(),
				'check_update'
			] );

		}
	}

	add_action( 'admin_init', 'unload_vc_disable_update', 9 );
}
