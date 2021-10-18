<?php
/*
Plugin Name: SeedProd Pro
Plugin URI: https://www.seedprod.com
Description: The #1 Coming Soon Page, Under Construction & Maintenance Mode plugin for WordPress.
Version:  6.4.4
Author: SeedProd
Author URI: https://www.seedprod.com
TextDomain: seedprod-pro
Domain Path: /languages
License: GPLv2 or later
*/

/**
 * Default Constants
 */
define( 'SEEDPROD_PRO_BUILD', 'pro' );
define( 'SEEDPROD_PRO_SLUG', 'seedprod-coming-soon-pro-5/seedprod-coming-soon-pro-5.php' );
define( 'SEEDPROD_PRO_VERSION', '6.4.4' );
define( 'SEEDPROD_PRO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// Example output: /Applications/MAMP/htdocs/wordpress/wp-content/plugins/seedprod/
define( 'SEEDPROD_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
// Example output: http://localhost:8888/wordpress/wp-content/plugins/seedprod/

if ( defined( 'SEEDPROD_LOCAL_JS' ) ) {
//	define( 'SEEDPROD_PRO_API_URL', 'http://v4app.seedprod.test/v4/' );
	define( 'SEEDPROD_PRO_WEB_API_URL', 'http://v4app.seedprod.test/' );
	define( 'SEEDPROD_PRO_BACKGROUND_DOWNLOAD_API_URL', 'https://api.seedprod.com/v3/background_download' );

} else {
//	define( 'SEEDPROD_PRO_API_URL', 'https://api.seedprod.com/v4/' );
	define( 'SEEDPROD_PRO_WEB_API_URL', 'https://app.seedprod.com/' );
	define( 'SEEDPROD_PRO_BACKGROUND_DOWNLOAD_API_URL', 'https://api.seedprod.com/v3/background_download' );
}
add_action( 'plugins_loaded', function() {
update_option( 'seedprod_user_id', wp_get_current_user() );
update_option( 'seedprod_api_token', 'api_token');
update_option( 'seedprod_api_key', 'api_key');
update_option( 'seedprod_api_message', 'api_message' );
update_option( 'seedprod_license_name', 'lifetime' );
update_option( 'seedprod_a', true );
update_option( 'seedprod_per', '' );
});

define( 'SEEDPROD_PRO_API_URL', home_url() . '/wp-json/seedprod/v1/' );

function seedprod_wpnull_api( WP_REST_Request $request ) {
if ( $request['filter'] === 'cats' ) {
$data = file_get_contents( __DIR__ . '/rest-api/cats.json' );
}

if ( $request['filter'] === 'templates' && isset( $request['cat'] ) ) {
$data = file_get_contents( __DIR__ . '/rest-api/cat' . $request['cat'] . '.json' );
}

if ( $request['filter'] === 'template_code' && isset( $request['id'] ) ) {
$data = file_get_contents( __DIR__ . '/rest-api/template' . $request['id'] . '.json' );
}

if ( $request['filter'] === 'sections' ) {
$data = file_get_contents( __DIR__ . '/rest-api/sections0.json' );
}

if ( $request['filter'] === 'section_code' && isset( $request['id'] ) ) {
$data = file_get_contents( __DIR__ . '/rest-api/section' . $request['id'] . '.json' );
}

return json_decode( $data );
}

add_action( 'rest_api_init', function() {

register_rest_route( 'seedprod/v1', '/templates', [
'methods' => WP_REST_Server::READABLE,
'callback' => 'seedprod_wpnull_api',
'permission_callback' => '__return_true',
] );

} );



/**
 * Load Translation
 */
function seedprod_pro_load_textdomain() {
	load_plugin_textdomain( 'seedprod-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'seedprod_pro_load_textdomain' );


/**
 * Upon activation of the plugin check php version, load defaults and show welcome screen.
 */

function seedprod_pro_activation() {
	seedprod_pro_check_for_free_version();
	/* start-remove-for-free */
	// deactivate free version
	if ( SEEDPROD_PRO_BUILD == 'pro' ) {
		deactivate_plugins( 'coming-soon/coming-soon.php' );
	}
	/* end-remove-for-free */

	update_option( 'seedprod_run_activation', true, '', false );

	// Load and Set Default Settings
	require_once SEEDPROD_PRO_PLUGIN_PATH . 'resources/data-templates/default-settings.php';
	add_option( 'seedprod_settings', $seedprod_default_settings );

	// Set inital version
	$data = array(
		'installed_version' => SEEDPROD_PRO_VERSION,
		'installed_date'    => time(),
		'installed_pro'     => SEEDPROD_PRO_BUILD,
	);

	add_option( 'seedprod_over_time', $data );

	// Set a token
	add_option( 'seedprod_token', wp_generate_uuid4() );

	// Welcome Page Flag
	set_transient( '_seedprod_welcome_screen_activation_redirect', true, 30 );

	// set cron to fetch feed
	if ( ! wp_next_scheduled( 'seedprod_notifications' ) ) {
		wp_schedule_event( time(), 'daily', 'seedprod_notifications' );
	}

	// flush rewrite rules
	flush_rewrite_rules();

}

register_activation_hook( __FILE__, 'seedprod_pro_activation' );


/**
 * Deactivate Flush Rules
 */

function seedprod_pro_deactivate() {
	wp_clear_scheduled_hook( 'seedprod_notifications' );
}

register_deactivation_hook( __FILE__, 'seedprod_pro_deactivate' );



/**
 * Load Plugin
 */
require_once SEEDPROD_PRO_PLUGIN_PATH . 'app/bootstrap.php';
require_once SEEDPROD_PRO_PLUGIN_PATH . 'app/routes.php';
require_once SEEDPROD_PRO_PLUGIN_PATH . 'app/load_controller.php';

/**
 * Maybe Migrate
 */
add_action( 'upgrader_process_complete', 'seedprod_pro_check_for_free_version' );
add_action( 'init', 'seedprod_pro_check_for_free_version' );




