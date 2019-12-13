<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://semantify.it
 * @since      1.0.0
 *
 * @package    Semantifyit_Dzt_Uri
 * @subpackage Semantifyit_Dzt_Uri/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Semantifyit_Dzt_Uri
 * @subpackage Semantifyit_Dzt_Uri/includes
 * @author     Semantify <dev@semantify.it>
 */
class Semantifyit_Dzt_Uri_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'semantifyit-dzt-uri',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
