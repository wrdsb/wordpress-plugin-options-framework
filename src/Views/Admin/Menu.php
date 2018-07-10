<?php
namespace WRDSB\OptionsFramework\Views\Admin;

class Menu {

	/**
	 * Menu slug
	 *
	 * @var string
	 */
	protected $slug = 'wrdsb-options';

	/**
	 * URL for assets
	 *
	 * @var string
	 */
	protected $assets_url;

	/**
	 * Menu constructor
	 *
	 * @param string $assets_url URL for assets
	 */
	public function __construct() {
		//$this->assets_url = $assets_url;
		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
		//add_action( 'admin_enqueue_scripts', array( $this, 'register_assets' ) );
	}

	public function add_admin_page() {
		//if ( empty ( $GLOBALS['admin_page_hooks']['my_unique_slug'] ) )
		add_menu_page(
			'Site Options and Settings',
			'Site Options',
			'manage_options',
			$this->slug,
			array( $this, 'render_admin' )
		);
	}

	/**
	 * Register CSS and JS for page
	 *
	 * @uses "admin_enqueue_scripts" action
	 */
	public function register_assets() {
		wp_register_script( $this->slug, $this->assets_url . '/js/admin.js', array( 'jquery' ) );
		wp_register_style( $this->slug, $this->assets_url . '/css/admin.css' );
		wp_localize_script( $this->slug, 'APEX', array(
			'strings' => array(
				'saved' => __( 'Settings Saved', 'text-domain' ),
				'error' => __( 'Error', 'text-domain' )
			),
			'api'     => array(
				'url'   => esc_url_raw( rest_url( 'apex-api/v1/settings' ) ),
				'nonce' => wp_create_nonce( 'wp_rest' )
			)
		) );
	}

	/**
	 * Enqueue CSS and JS for page
	 */
	public function enqueue_assets(){
		if( ! wp_script_is( $this->slug, 'registered' ) ){
			$this->register_assets();
		}
		wp_enqueue_script( $this->slug );
		wp_enqueue_style( $this->slug );
	}

	/**
	 * Render plugin admin page
	 */
	public function render_admin(){
		$this->enqueue_assets();
		echo 'Put your form here!';
	}
}