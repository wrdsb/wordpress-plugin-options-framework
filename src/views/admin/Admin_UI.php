<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/wrdsb
 * @since      1.0.0
 *
 * @package    Wrdsb_Site_Options
 * @subpackage Wrdsb_Site_Options/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wrdsb_Site_Options
 * @subpackage Wrdsb_Site_Options/admin
 * @author     WRDSB <website@wrdsb.ca>
 */
class Wrdsb_Site_Options_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wrdsb_Site_Options_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wrdsb_Site_Options_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wrdsb-site-options-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wrdsb_Site_Options_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wrdsb_Site_Options_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wrdsb-site-options-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_admin_pages() {
		add_menu_page( 'WRDSB Options and Settings', 'WRDSB', 'manage_options', 'wrdsb-settings', array( $this, 'settings_page' ) );
		add_submenu_page( 'wrdsb-settings', 'WRDSB Options and Settings', 'WRDSB', 'manage_options', 'wrdsb-settings', array( $this, 'settings_page' ) );
		//add_submenu_page( 'wrdsb-settings', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'wrdsb-subslug' );
	}

	public function settings_page() {
		echo '<h1>WRDSB Options and Settings</h1>';
		echo '<table>';
		$options = WRDSB_Site_Option::get_all();
		foreach ( $options as $option ) {
			echo '<tr>';
			echo '<td>' . $option->get_key() . '</td>';
			echo '<td>' . $option->get_value() . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}

}
