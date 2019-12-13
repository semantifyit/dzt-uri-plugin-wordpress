<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://semantify.it
 * @since             1.0.0
 * @package           Semantifyit_Dzt_Uri
 *
 * @wordpress-plugin
 * Plugin Name:       Semantify-DZT-URI
 * Plugin URI:        https://semantify.it
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Semantify
 * Author URI:        https://semantify.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       semantifyit-dzt-uri
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEMANTIFYIT_DZT_URI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-semantifyit-dzt-uri-activator.php
 */
function activate_semantifyit_dzt_uri() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-semantifyit-dzt-uri-activator.php';
	Semantifyit_Dzt_Uri_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-semantifyit-dzt-uri-deactivator.php
 */
function deactivate_semantifyit_dzt_uri() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-semantifyit-dzt-uri-deactivator.php';
	Semantifyit_Dzt_Uri_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_semantifyit_dzt_uri' );
register_deactivation_hook( __FILE__, 'deactivate_semantifyit_dzt_uri' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-semantifyit-dzt-uri.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_semantifyit_dzt_uri() {

	$plugin = new Semantifyit_Dzt_Uri();
	$plugin->run();

}
run_semantifyit_dzt_uri();
