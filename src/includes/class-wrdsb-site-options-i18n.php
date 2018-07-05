<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    Wrdsb_Site_Options
 * @subpackage Wrdsb_Site_Options/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wrdsb_Site_Options
 * @subpackage Wrdsb_Site_Options/includes
 * @author     WRDSB <website@wrdsb.ca>
 */
class Wrdsb_Site_Options_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wrdsb-site-options',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
