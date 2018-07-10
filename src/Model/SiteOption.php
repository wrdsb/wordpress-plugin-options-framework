<?php
namespace WRDSB\OptionsFramework\Model;

/**
 * Define the "SiteOption" class
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Options_Framework
 */

class SiteOption implements \JsonSerializable {
	const OPTIONS_NAMESPACE = 'wrdsb_';

	private $key;
	private $value;

	public function __construct( $key, $value = '' ) {
		$this->key   = $key;
		$this->value = $value;

		$this->namespace_key();
	}

	public function get_key() {
		$this->namespace_key();
		return $this->key;
	}

	public function set_key( $key ) {
		$this->key = $key;
		$this->namespace_key();
	}

	public function get_value() {
		return $this->value;
	}

	public function set_value( $value ) {
		$this->value = $value;
	}

	public function save() {
		$key   = $this->get_key();
		$value = $this->get_value();
		return update_option( $key, $value );
	}

	public function delete() {
		$key = $this->get_key();
		return delete_option( $key );
	}

	public function to_array() {
		$array = [
			'key'   => $this->get_key(),
			'value' => $this->get_value(),
		];

		return $array;
	}

	public function jsonSerialize() {
		return $this->to_array();
	}

	public function __toString() {
		return json_encode( $this );
	}

	private function namespace_key() {
		$namespace = self::OPTIONS_NAMESPACE;
		$key       = $this->key;

		if ( self::is_namespaced_key( $key ) === false ) {
			$key       = $namespace . $key;
			$this->key = $key;
		}
	}

	public static function is_namespaced_key( $key ) {
		$namespace = self::OPTIONS_NAMESPACE;
		return substr( $key, 0, strlen( $namespace ) ) === $namespace ? true : false;
	}

	public static function get_all() {
		$all_options        = wp_load_alloptions();
		$namespaced_options = array();

		foreach ( $all_options as $key => $value ) {
			if ( self::is_namespaced_key( $key ) ) {
				$option = new SiteOption( $key, $value );
				$namespaced_options[ $key ] = $option;
			}
		}

		return $namespaced_options;
	}

	public static function find_by_key( $key ) {
		$value = get_option( $key );
		return new SiteOption( $key, $value );
	}
}
