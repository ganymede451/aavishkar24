<?php
/**
 * Library
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse;

/**
 * Class Style Generator
 *
 * @package gutenverse
 */
class Library {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'gutenverse_plugin_upgrade', array( $this, 'upgrade_like' ), 20 );
	}

	/**
	 * Upgrade like
	 */
	public function upgrade_like() {
		if ( ! apply_filters( 'gutenverse_server_mode', false ) ) {
			$flag = Meta_Option::instance()->get_option( 'converted-library', false );

			if ( ! $flag ) {
				// Force to update library.
				Api::instance()->update_library_data();
				$data = Api::instance()->library_data();

				$this->upgrade_like_layout( $data['theme-data'] );
				$this->upgrade_like_section( $data['section-data'] );
				Meta_Option::instance()->set_option( 'converted-library', true );
			}
		}
	}

	/**
	 * Upgrade like layout data.
	 *
	 * @param array $data Layout Data.
	 */
	public function upgrade_like_layout( $data ) {
		$layouts = Meta_Option::instance()->get_option( 'liked_layout' );

		/** Replace Layouts */
		$liked_layouts  = array();
		$liked_sections = array();
		foreach ( $layouts as $layout ) {
			foreach ( $data as $item ) {
				if ( $item['id'] === $layout ) {
					// Replace id to slug.
					$liked_layouts[] = $item['data']['slug'];
				}
			}
		}

		Meta_Option::instance()->set_option( 'liked_layout', $liked_layouts );
	}

	/**
	 * Upgrade like section data.
	 *
	 * @param array $data Section Data.
	 */
	public function upgrade_like_section( $data ) {
		$sections = Meta_Option::instance()->get_option( 'liked_section' );

		/** Replace Layouts */
		$liked_sections = array();
		foreach ( $sections as $section ) {
			foreach ( $data as $item ) {
				if ( $item['id'] === $section ) {
					// Replace id to slug.
					$liked_sections[] = $item['data']['slug'];
				}
			}
		}

		Meta_Option::instance()->set_option( 'liked_section', $liked_sections );
	}

}
