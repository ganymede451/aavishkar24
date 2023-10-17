<?php
/**
 * Meta Option.
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse;

/**
 * Class Plugin Meta.
 *
 * @package gutenverse
 */
class Meta_Option {
	/**
	 * Option Name.
	 *
	 * @var string
	 */
	private $option_name = 'gutenverse-meta-option';

	/**
	 * Instance of Gutenverse.
	 *
	 * @var Meta_Option
	 */
	private static $instance;

	/**
	 * Singleton page for Meta_Option Class
	 *
	 * @return Meta_Option
	 */
	public static function instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'init_meta_option' ) );
		add_action( 'gutenverse_plugin_upgrade', array( $this, 'upgrade_plugin' ), null, 2 );
	}

	/**
	 * Upgrade Plugin Hook.
	 *
	 * @param string $old_version Old Version.
	 * @param string $new_version New Version.
	 */
	public function upgrade_plugin( $old_version, $new_version ) {
		$versions   = $this->get_option( 'version_history' );
		$versions[] = $old_version;

		$this->set_option( 'current_version', $new_version );
		$this->set_option( 'upgrade_time', time() );
		$this->set_option( 'version_history', $versions );
	}

	/**
	 * Initial Option.
	 */
	public function initial_option() {
		$options = apply_filters(
			'gutenverse_initial_meta_option',
			array(
				'install_time'     => time(),
				'current_version'  => '0.0.0',
				'version_history'  => array(),
				'upgrade_time'     => null,
				'liked_layout'     => get_option( 'gutenverse-liked-layout', array() ),
				'liked_section'    => get_option( 'gutenverse-liked-section', array() ),
				'subscribed'       => get_option( 'gutenverse-subscribed', false ),
				'subscribed_email' => get_option( 'gutenverse-subscribed-email', '' ),
			)
		);

		$this->set_options( $options );
	}

	/**
	 * Check if plugin has been upgraded.
	 */
	public function check_upgrade() {
		$version = $this->get_option( 'current_version' );

		if ( version_compare( $version, GUTENVERSE_VERSION, '<' ) ) {
			do_action( 'gutenverse_plugin_upgrade', $version, GUTENVERSE_VERSION );
		}
	}

	/**
	 * Upgrade Process.
	 */
	public function init_meta_option() {
		$option = $this->get_option();

		if ( false === $option ) {
			$this->initial_option();
		}

		$this->check_upgrade();
	}

	/**
	 * Load Meta Data.
	 *
	 * @param string|null $name Name of setting.
	 * @param \mixed      $default Default Option Value.
	 *
	 * @return \mixed
	 */
	public function get_option( $name = null, $default = null ) {
		$options = get_option( $this->option_name );

		if ( $name ) {
			if ( isset( $options[ $name ] ) ) {
				return $options[ $name ];
			} else {
				return $default;
			}
		}

		return $options;
	}

	/**
	 * Set Option
	 *
	 * @param object $value Value of settings.
	 */
	public function set_options( $value ) {
		$option = $this->get_option();

		if ( $option ) {
			return update_option( $this->option_name, $value );
		} else {
			return add_option( $this->option_name, $value );
		}
	}


	/**
	 * Set Option Name.
	 *
	 * @param string $name Name of setting.
	 * @param mixed  $value Value of settings.
	 */
	public function set_option( $name, $value ) {
		$option          = $this->get_option();
		$option[ $name ] = $value;

		return $this->set_options( $option );
	}

	/**
	 * Delete Option.
	 *
	 * @param string $name Name of setting.
	 */
	public function delete_option( $name ) {
		$option = $this->get_option();
		unset( $option[ $name ] );

		return $this->set_options( $option );
	}
}
