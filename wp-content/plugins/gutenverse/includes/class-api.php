<?php
/**
 * REST APIs class
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse;

use Gutenverse\Block\Post_Block;
use Gutenverse\Block\Post_List;
use Gutenverse\Form;
use WP_Error;
use WP_Query;

/**
 * Class Api
 *
 * @package gutenverse
 */
class Api {
	/**
	 * Instance of Gutenverse.
	 *
	 * @var Api
	 */
	private static $instance;

	/**
	 * Endpoint Path
	 *
	 * @var string
	 */
	const ENDPOINT = 'gutenverse-client/v1';

	/**
	 * Singleton page for Gutenverse Class
	 *
	 * @return Api
	 */
	public static function instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Blocks constructor.
	 */
	private function __construct() {
		if ( did_action( 'rest_api_init' ) ) {
			$this->register_routes();
		}
	}

	/**
	 * Register Gutenverse APIs
	 */
	private function register_routes() {
		/**
		 * Backend routes.
		 */
		register_rest_route(
			self::ENDPOINT,
			'subscribed',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'subscribed' ),
				'permission_callback' => array( $this, 'permission_check_admin' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/create',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'create_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/edit',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'edit_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/(?P<id>\d+)',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/(?P<id>\d+)',
			array(
				'methods'             => 'DELETE',
				'callback'            => array( $this, 'delete_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/clone',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'clone_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/export/(?P<id>\d+)',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'export_form_action' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form-action/notice',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'form_action_notice' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'settings/modify',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'modify_settings' ),
				'permission_callback' => array( $this, 'permission_check_admin' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'globalvariable/modify',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'modify_global_variable' ),
				'permission_callback' => array( $this, 'permission_check_admin' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'themes/activate',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'activate_theme' ),
				'permission_callback' => array( $this, 'permission_check_admin' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'themes/install',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'install_theme' ),
				'permission_callback' => array( $this, 'permission_check_admin' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form/search',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'search_form' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'taxonomies',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_taxonomies' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'singles',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_singles' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		// Template Library.
		register_rest_route(
			self::ENDPOINT,
			'layout/like-list',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'liked_layout' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'section/like-list',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'liked_section' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'layout/set-like',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'site_like_layout' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'section/set-like',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'site_like_section' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'import/images',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'import_images' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'layout/like-state',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'layout_like_state' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'section/like-state',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'section_like_state' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'layout/categories',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'layout_categories' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'layout/search',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'layout_search' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'layout/single',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'single_layout' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'section/categories',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'section_categories' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'section/search',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'section_search' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'theme/search',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'search_theme' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'library/data',
			array(
				'method'              => 'GET',
				'callback'            => array( $this, 'fetch_library_data' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'data/update',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'update_library_data' ),
				'permission_callback' => array( $this, 'permission_check_author' ),
			)
		);

		/** ----------------------------------------------------------------
		 * Frontend/Global Routes
		 */
		register_rest_route(
			self::ENDPOINT,
			'menu',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'menu' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'menu/render',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'menu_render' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form/init',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'form_init' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'form/submit',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'submit_form' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'postblock/data',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'post_block_data' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::ENDPOINT,
			'postlist/data',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'post_list_data' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Check admin permissions.
	 *
	 * @return bool|WP_Error
	 */
	public function permission_check_admin() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'forbidden_permission',
				esc_html__( 'Forbidden Access', 'gutenverse' ),
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Check author permissions.
	 *
	 * @return bool|WP_Error
	 */
	public function permission_check_author() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'forbidden_permission',
				esc_html__( 'Forbidden Access', 'gutenverse' ),
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Fetch Data
	 *
	 * @return WP_Rest
	 */
	public function fetch_library_data() {
		$library_time = Meta_Option::instance()->get_option( 'fetch_library_time' );
		$now          = time();

		if ( null === $library_time || $library_time < $now ) {
			$next_fetch = $now + ( 24 * 60 * 60 );
			Meta_Option::instance()->set_option( 'fetch_library_time', $next_fetch );
			$this->update_library_data();
		}

		return $this->library_data();
	}

	/**
	 * Install Themes from Gutenverse.com repository.
	 *
	 * @param object $request .
	 */
	public function install_theme( $request ) {
		$theme = $this->esc_data( $request->get_param( 'slug' ), 'string' );
		$info  = $this->esc_data( $request->get_param( 'info' ), 'string' );
		$key   = $this->esc_data( $request->get_param( 'key' ), 'string' );

		if ( empty( $info ) ) {
			$info = GUTENVERSE_LIBRARY_URL . '/wp-json/gutenverse-server/v1/theme/information';
		}

		$request = wp_remote_post(
			$info,
			array(
				'headers' => array(
					'origin' => site_url(),
				),
				'body'    => array(
					'slug' => $theme,
					'key'  => $key,
				),
			)
		);

		$res = json_decode( wp_remote_retrieve_body( $request ), true );
		$api = (object) $res;

		require_once ABSPATH . 'wp-admin/includes/misc.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		/** Need to allow file locally hosted. */
		add_filter(
			'http_request_host_is_external',
			function() {
				return true;
			}
		);

		$upgrader = new \Theme_Upgrader( new \WP_Ajax_Upgrader_Skin() );
		$result   = $upgrader->install( $api->download_link );

		if ( $result ) {
			return $api;
		} else {
			return false;
		}
	}

	/**
	 * Library Data.
	 *
	 * @return array
	 */
	public function library_data() {
		$data = array(
			'layout-data'        => null,
			'layout-categories'  => null,
			'theme-data'         => null,
			'theme-categories'   => null,
			'section-data'       => null,
			'section-categories' => null,
		);

		foreach ( $data as $key => $value ) {
			$content = $this->get_json_data( $key );

			if ( 'layout-data' === $key ) {
				$content = $this->inject_layout_like( $content );
			}

			if ( 'section-data' === $key ) {
				$content = $this->inject_section_like( $content );
			}

			$data[ $key ] = $content;
		}

		return $data;
	}

	/**
	 * Inject Like To Theme.
	 *
	 * @param array $data Theme Data.
	 *
	 * @return array
	 */
	public function inject_layout_like( $data ) {
		$liked = Meta_Option::instance()->get_option( 'liked_layout' );

		foreach ( $data as $key => $item ) {
			$data[ $key ]['like'] = ! empty( $liked ) ? in_array( $item['data']['slug'], $liked, true ) : false;
		}

		return $data;
	}

	/**
	 * Inject Like To Section.
	 *
	 * @param array $data Theme Data.
	 *
	 * @return array
	 */
	public function inject_section_like( $data ) {
		$liked = Meta_Option::instance()->get_option( 'liked_section' );

		foreach ( $data as $key => $item ) {
			$data[ $key ]['like'] = ! empty( $liked ) ? in_array( $item['data']['slug'], $liked, true ) : false;
		}

		return $data;
	}

	/**
	 * Layout Like.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function search_theme( $request ) {
		$keyword = $this->esc_data( $request->get_param( 'keyword' ), 'string' );
		$paging  = $this->esc_data( $request->get_param( 'paging' ), 'integer' );
		$filter  = $this->esc_data( $request->get_param( 'filter' ), 'string' );

		$result = array();
		$themes = $this->filter_layout(
			array(
				'keyword' => $keyword,
				'host'    => $filter,
			)
		);

		foreach ( $themes as $theme ) {
			$result[] = array(
				'id'                 => $theme->id,
				'slug'               => $theme->data->slug,
				'name'               => $theme->data->name,
				'demo'               => $theme->data->demo,
				'host'               => $theme->data->host,
				'cover'              => $theme->data->cover[0],
				'compatible_version' => $theme->data->compatible_version,
			);
		}

		$content = $this->data_paging( $result, $paging, false );

		return array(
			'themes'  => $content['data'],
			'total'   => $content['total'],
			'current' => $paging,
		);
	}

	/**
	 * Like State.
	 *
	 * @param string $slug slug of single layout / theme.
	 * @param string $state like state.
	 * @param string $option Name of option.
	 *
	 * @return boolean
	 */
	public function like_state( $slug, $state, $option ) {
		$liked = Meta_Option::instance()->get_option( $option );

		if ( $state ) {
			if ( ! in_array( $slug, $liked, true ) ) {
				$liked[] = $slug;
			}
		} else {
			$search = array_search( $slug, $liked, true );
			if ( false !== $search ) {
				unset( $liked[ $search ] );
			}
		}

		return Meta_Option::instance()->set_option( $option, $liked );
	}

	/**
	 * Layout Like.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function section_like_state( $request ) {
		$slug  = $this->esc_data( $request->get_param( 'slug' ), 'string' );
		$state = $this->esc_data( $request->get_param( 'state' ), 'boolean' );

		return $this->like_state( $slug, $state, 'liked_section' );
	}

	/**
	 * Layout Like.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function layout_like_state( $request ) {
		$slug  = $this->esc_data( $request->get_param( 'slug' ), 'string' );
		$state = $this->esc_data( $request->get_param( 'state' ), 'boolean' );

		return $this->like_state( $slug, $state, 'liked_layout' );
	}

	/**
	 * Single Layout.
	 *
	 * @param int $id ID of single themes.
	 *
	 * @return object|null
	 */
	public function get_single_themes( $id ) {
		$themes = $this->get_json_data( 'theme-data' );

		foreach ( $themes as $theme ) {
			if ( $theme->id === $id ) {
				return $theme;
			}
		}
	}

	/**
	 * Single Layout.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function single_layout( $request ) {
		$liked = Meta_Option::instance()->get_option( 'liked_layout' );
		$id    = $request->get_param( 'id' );
		$theme = $this->get_single_themes( $id );

		if ( $theme ) {
			$title = $theme->name;
			$pages = array();

			foreach ( $theme->data->pages as $page ) {
				$pages[] = array(
					'id'         => $page->index,
					'title'      => $page->title,
					'coverImage' => $page->coverImage[0],
					'fullImage'  => $page->fullImage[0],
				);
			}

			return array(
				'id'                 => $id,
				'title'              => $title,
				'pages'              => $pages,
				'demo'               => $theme->data->demo,
				'isPro'              => (bool) $theme->data->pro,
				'slug'               => $theme->data->slug,
				'like'               => in_array( (int) $id, $liked, true ),
				'compatible_version' => $theme->data->compatible_version,
			);
		}

		return null;
	}

	/**
	 * Escape data
	 *
	 * @param mixed $value .
	 * @param mixed $type .
	 *
	 * @return mixed
	 */
	private function esc_data( $value, $type = 'string' ) {
		switch ( $type ) {
			case 'string':
				return esc_html( sanitize_text_field( wp_unslash( $value ) ) );
			case 'integer':
				return (int) $value;
			case 'boolean':
				return (bool) $value;
			default:
				return false;
		}
	}

	/**
	 * Update Data.
	 */
	public function update_library_data() {
		if ( ! apply_filters( 'gutenverse_server_mode', false ) ) {
			$endpoints = array(
				'layout/data',
				'layout/categories',
				'theme/data',
				'theme/categories',
				'section/data',
				'section/categories',
			);

			$apipath   = GUTENVERSE_LIBRARY_URL . 'wp-json/gutenverse-server/v3/';
			$basedir   = wp_upload_dir()['basedir'];
			$directory = $basedir . '/gutenverse/data/';
			wp_mkdir_p( $directory );

			foreach ( $endpoints as $endpoint ) {
				$filename = str_replace( '/', '-', $endpoint ) . '.json';
				$this->fetch_file( $apipath . $endpoint, $directory . $filename );
			}
		}
	}

	/**
	 * Get Json Data.
	 *
	 * @param string $name File File Path.
	 *
	 * @return mixed
	 *
	 * @todo : Fetch data untuk refresh data.
	 * @todo : Check folder data dulu. kalau ga ada fallback ke folder asli.
	 */
	public function get_json_data( $name ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		global $wp_filesystem;
		$directory = wp_upload_dir()['basedir'] . '/gutenverse/';
		$json      = array();

		if ( $wp_filesystem->exists( $directory . '/data/' . $name . '.json' ) ) {
			$file = $wp_filesystem->get_contents( $directory . '/data/' . $name . '.json' );
			$json = json_decode( $file, true );
		} elseif ( $wp_filesystem->exists( GUTENVERSE_DIR . '/data/' . $name . '.json' ) ) {
			$file = $wp_filesystem->get_contents( GUTENVERSE_DIR . '/data/' . $name . '.json' );
			$json = json_decode( $file, true );
		}

		$additional = apply_filters( 'gutenverse_json_data_' . $name, array() );
		return array_merge( $json, $additional );
	}

	/**
	 * Get theme count.
	 *
	 * @param array  $data array of themes.
	 * @param string $slug Theme Slug.
	 *
	 * @return integer
	 */
	public function get_data_count( $data, $slug ) {
		$count = 0;

		foreach ( $data as $item ) {
			foreach ( $item->categories as $category ) {
				if ( $category->slug === $slug ) {
					$count++;
				}
			}
		}

		return $count;
	}

	/**
	 * Soft Section.
	 *
	 * @param array $sections Array of section.
	 *
	 * @return array
	 */
	public function sort_section( $sections ) {
		usort(
			$sections,
			function( $a, $b ) {
				return $a->count < $b->count;
			}
		);
		return $sections;
	}

	/**
	 * Layout Categories.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function section_categories( $request ) {
		$categories = $this->get_json_data( 'section-categories' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );
		$favorite   = $this->esc_data( $request->get_param( 'favorite' ), 'boolean' );
		$filters    = array(
			'license' => $license,
		);

		if ( $favorite ) {
			$filters['include'] = Meta_Option::instance()->get_option( 'liked_section' );
		}

		$sections = $this->filter_section( $filters );

		foreach ( $categories as $index => $category ) {
			$count = $this->get_data_count( $sections, $category->slug );
			if ( $count ) {
				$categories[ $index ]->count = $count;
			} else {
				$categories[ $index ]->count = 0;
			}
		}

		return array_merge(
			array(
				array(
					'id'    => '',
					'name'  => esc_html__( 'All', 'gutenverse-server' ),
					'count' => count( $sections ),
				),
			),
			$this->sort_section( $categories )
		);
	}

	/**
	 * Filter Section.
	 *
	 * @param array $filters Filters.
	 *
	 * @return array
	 */
	public function filter_section( $filters ) {
		$data   = $this->get_json_data( 'section-data' );
		$result = array();

		foreach ( $data as $section ) {
			if ( isset( $filters['include'] ) ) {
				if ( ! in_array( (int) $section->id, $filters['include'], true ) ) {
					continue;
				}
			}

			if ( isset( $filters['category'] ) && $filters['category'] ) {
				$flag = true;
				foreach ( $section->categories as $category ) {
					if ( $category->id === $filters['category'] ) {
						$flag = $flag && false;
					}
				}
				if ( $flag ) {
					continue;
				}
			}

			if ( isset( $filters['license'] ) && $filters['license'] ) {
				$is_pro = ( 'pro' === $filters['license'] );

				if ( $is_pro !== (bool) $section->data->pro ) {
					continue;
				}
			}

			$result[] = $section;
		}

		return $result;
	}

	/**
	 * Paging Data.
	 *
	 * @param array $data Array of data.
	 * @param int   $paging Current Page.
	 * @param int   $per_page Default Per Page.
	 *
	 * @return array
	 */
	public function data_paging( $data, $paging, $per_page ) {
		if ( $per_page ) {
			$start_index = $per_page * ( $paging - 1 );
			$result      = array_slice( $data, $start_index, $per_page );
			$count       = count( $data );
			$total_page  = ceil( $count / $per_page );

			return array(
				'current' => $paging,
				'data'    => $result,
				'total'   => $total_page,
			);
		} else {
			return array(
				'current' => 1,
				'data'    => $data,
				'total'   => 1,
			);
		}
	}

	/**
	 * Section Search.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function section_search( $request ) {
		$liked      = Meta_Option::instance()->get_option( 'liked_section' );
		$categories = $this->esc_data( $request->get_param( 'categories' ), 'integer' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );
		$paging     = $this->esc_data( $request->get_param( 'paging' ), 'integer' );

		$result   = array();
		$sections = $this->filter_section(
			array(
				'category' => $categories,
				'license'  => $license,
			)
		);

		foreach ( $sections as $section ) {
			$result[] = array(
				'id'                 => $section->id,
				'pro'                => (bool) $section->data->pro,
				'cover'              => $section->data->cover,
				'like'               => in_array( (int) $section->id, $liked, true ),
				'compatible_version' => $section->data->compatible_version,
			);
		}

		return $this->data_paging( $result, $paging, 20 );
	}

	/**
	 * Layout Categories.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function layout_categories( $request ) {
		$categories = $this->get_json_data( 'theme-categories' );
		$keyword    = $this->esc_data( $request->get_param( 'keyword' ), 'string' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );
		$favorite   = $this->esc_data( $request->get_param( 'favorite' ), 'boolean' );

		$filters = array(
			'keyword' => $keyword,
			'license' => $license,
		);

		if ( $favorite ) {
			$filters['include'] = Meta_Option::instance()->get_option( 'liked_layout' );
		}

		$themes = $this->filter_layout( $filters );

		foreach ( $categories as $index => $category ) {
			$count = $this->get_data_count( $themes, $category->slug );
			if ( $count ) {
				$categories[ $index ]->count = $count;
			} else {
				$categories[ $index ]->count = 0;
			}
		}

		return array_merge(
			array(
				array(
					'id'    => '',
					'name'  => esc_html__( 'All', 'gutenverse-server' ),
					'count' => count( $themes ),
				),
			),
			$this->sort_section( $categories )
		);
	}

	/**
	 * Filter Layout.
	 *
	 * @param array $filters Filter Content.
	 *
	 * @return array
	 */
	public function filter_layout( $filters ) {
		$data   = $this->get_json_data( 'theme-data' );
		$result = array();

		foreach ( $data as $theme ) {
			if ( isset( $filters['include'] ) ) {
				if ( ! in_array( (int) $theme->id, $filters['include'], true ) ) {
					continue;
				}
			}

			if ( isset( $filters['category'] ) && $filters['category'] ) {
				$flag = true;
				foreach ( $theme->categories as $category ) {
					if ( $category->id === $filters['category'] ) {
						$flag = $flag && false;
					}
				}
				if ( $flag ) {
					continue;
				}
			}

			if ( isset( $filters['keyword'] ) && $filters['keyword'] ) {
				$flag = true;

				if ( ! gutenverse_str_contains( strtolower( $theme->data->name ), strtolower( $filters['keyword'] ) ) ) {
					continue;
				}
			}

			if ( isset( $filters['license'] ) && $filters['license'] ) {
				$is_pro = ( 'pro' === $filters['license'] );

				if ( $is_pro !== (bool) $theme->data->pro ) {
					continue;
				}
			}

			$result[] = $theme;
		}

		return $result;
	}

	/**
	 * Layout Search.
	 *
	 * @param object $request Request Object.
	 *
	 * @return WP_Rest
	 */
	public function layout_search( $request ) {
		$liked      = Meta_Option::instance()->get_option( 'liked_layout' );
		$categories = $this->esc_data( $request->get_param( 'categories' ), 'integer' );
		$keyword    = $this->esc_data( $request->get_param( 'keyword' ), 'string' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );
		$paging     = $this->esc_data( $request->get_param( 'paging' ), 'integer' );

		$result  = array();
		$layouts = $this->filter_layout(
			array(
				'category' => $categories,
				'keyword'  => $keyword,
				'license'  => $license,
			)
		);

		foreach ( $layouts as $layout ) {
			$result[] = array(
				'id'                 => $layout->id,
				'pro'                => (bool) $layout->data->pro,
				'slug'               => $layout->data->slug,
				'title'              => $layout->data->name,
				'cover'              => $layout->data->cover,
				'compatible_version' => $layout->data->compatible_version,
				'like'               => in_array( (int) $layout->id, $liked, true ),
			);
		}

		return $this->data_paging( $result, $paging, 9 );
	}

	/**
	 * Liked Layout
	 *
	 * @param object $request object.
	 *
	 * @return WP_Rest
	 */
	public function liked_layout( $request ) {
		$liked      = Meta_Option::instance()->get_option( 'liked_layout' );
		$categories = (int) $this->esc_data( $request->get_param( 'categories' ), 'integer' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );

		$result = array();
		$liked  = ! empty( $liked ) ? $liked : array();

		$layouts = $this->filter_layout(
			array(
				'category' => $categories,
				'license'  => $license,
				'include'  => $liked,
			)
		);

		foreach ( $layouts as $layout ) {
			$result[] = array(
				'id'    => $layout->id,
				'pro'   => (bool) $layout->data->pro,
				'slug'  => $layout->data->slug,
				'title' => $layout->data->name,
				'cover' => $layout->data->cover,
				'like'  => in_array( $layout->id, $liked, true ),
			);
		}

		return $this->data_paging( $result, 1, false );
	}

	/**
	 * Liked Layout
	 *
	 * @param object $request object.
	 *
	 * @return WP_Rest
	 */
	public function liked_section( $request ) {
		$liked      = Meta_Option::instance()->get_option( 'liked_section' );
		$categories = (int) $this->esc_data( $request->get_param( 'categories' ), 'integer' );
		$license    = $this->esc_data( $request->get_param( 'license' ), 'string' );

		$result = array();
		$liked  = ! empty( $liked ) ? $liked : array();

		$sections = $this->filter_section(
			array(
				'category' => $categories,
				'license'  => $license,
				'include'  => $liked,
			)
		);

		foreach ( $sections as $section ) {
			$result[] = array(
				'id'    => $section->id,
				'pro'   => (bool) $section->data->pro,
				'cover' => $section->data->cover,
				'like'  => in_array( $section->id, $liked, true ),
			);
		}

		return $this->data_paging( $result, 1, false );
	}

	/**
	 * Get Post Block Pagination Data
	 *
	 * @param object $request .
	 */
	public function post_block_data( $request ) {
		$attributes = $request['attributes'];
		$post_data  = new Post_Block();

		$post_data->set_attributes( $attributes );

		$render = $post_data->render_frontend();

		return array(
			'rendered' => $render,
		);
	}

	/**
	 * Get Post List Pagination Data
	 *
	 * @param object $request .
	 */
	public function post_list_data( $request ) {
		$attributes = $request['attributes'];
		$post_data  = new Post_List();

		$post_data->set_attributes( $attributes );

		$render = $post_data->render_frontend();

		return array(
			'rendered' => $render,
		);
	}

	/**
	 * Modify Settings
	 *
	 * @param object $request .
	 */
	public function modify_settings( $request ) {
		$data   = $request->get_param( 'setting' );
		$option = get_option( 'gutenverse-settings' );
		$value  = $option ? $option : array();

		foreach ( $data as $key => $setting ) {
			$value[ $key ] = $setting;
		}

		if ( ! isset( $option ) ) {
			add_option( 'gutenverse-settings', $value );
		} else {
			update_option( 'gutenverse-settings', $value );
		}

		return true;
	}

	/**
	 * Modify Global Variable.
	 *
	 * @param object $request .
	 */
	public function modify_global_variable( $request ) {
		Gutenverse::instance()->global_variable->set_global_variable(
			array(
				'googlefont' => $request->get_param( 'googlefont' ),
				'fonts'      => $request->get_param( 'fonts' ),
				'colors'     => $request->get_param( 'colors' ),
			)
		);

		return true;
	}

	/**
	 * Flag true if already subscribed.
	 *
	 * @param object $request .
	 */
	public function subscribed( $request ) {
		$this->save_meta( $request, 'subscribed', 'subscribed' );
		$this->save_meta( $request, 'email', 'subscribed-email' );

		return true;
	}

	/**
	 * Save / Update Meta
	 *
	 * @param object $request Request Object.
	 * @param object $param_name Request Parameter Name.
	 * @param object $option_name Option .
	 */
	public function save_meta( $request, $param_name, $option_name ) {
		$data = $request->get_param( $param_name );
		return Meta_Option::instance()->set_option( $option_name, $data );
	}

	/**
	 * Save / Update Option
	 *
	 * @param object $request Request Object.
	 * @param object $param_name Request Parameter Name.
	 * @param object $option_name Option .
	 */
	public function save_option( $request, $param_name, $option_name ) {
		$data    = $request->get_param( $param_name );
		$options = get_option( $option_name );

		if ( ! isset( $options ) ) {
			$result = add_option( $option_name, $data );
		} else {
			$result = update_option( $option_name, $data );
		}

		return $result;
	}

	/**
	 * Get Taxonomies
	 *
	 * @param object $request object.
	 */
	public function get_taxonomies( $request ) {
		$include  = $request->get_param( 'include' );
		$search   = $request->get_param( 'search' );
		$taxonomy = $request->get_param( 'taxonomy' );

		$taxonomies = get_terms(
			array(
				'name__like' => $search,
				'include'    => $include,
				'taxonomy'   => $taxonomy,
			)
		);

		$result = array();

		foreach ( $taxonomies as $key => $term ) {
			$taxonomy = get_taxonomy( $term->taxonomy );
			$result[] = array(
				'id'   => $term->term_id,
				'name' => $term->name . ' - ' . $taxonomy->label,
			);
		}

		return $result;
	}

	/**
	 * Get Singles
	 *
	 * @param object $request object.
	 */
	public function get_singles( $request ) {
		$include   = $request->get_param( 'include' );
		$search    = $request->get_param( 'search' );
		$post_type = $request->get_param( 'post_type' );
		$post_type = ! empty( $post_type ) && 'all_types' !== $post_type ? $post_type : array( 'page', 'post' );

		$args  = array(
			's'         => $search,
			'include'   => $include,
			'post_type' => $post_type,
		);
		$posts = get_posts( $args );

		$result = array();

		foreach ( $posts as $key => $post ) {
			$result[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $result;
	}

	/**
	 * Liked Layout
	 *
	 * @param object $request object.
	 */
	public function template_notification( $request ) {
		$user_id   = $request->get_param( 'id' );
		$templates = $request->get_param( 'templates' );

		return update_user_meta( $user_id, 'gutense_templates_viewed', $templates );
	}

	/**
	 * Like Layout
	 *
	 * @param object $request object.
	 */
	public function site_like_section( $request ) {
		return $this->save_meta( $request, 'likes', 'liked_section' );
	}

	/**
	 * Import Images
	 *
	 * @param object $request images.
	 */
	public function import_images( $request ) {
		$images   = $request->get_param( 'images' );
		$contents = $request->get_param( 'contents' );
		$array    = array();

		/**
		 * Temporarily increase time limit for import.
		 * Default 30s is not enough for importing long content.
		 */
		set_time_limit( 300 );

		foreach ( $images as $image ) {
			$data = $this->check_image_exist( $image );
			if ( ! $data ) {
				$data = $this->handle_file( $image );
			}
			$array[] = $data;
		}

		return array(
			'images'   => $array,
			'contents' => $contents,
		);
	}

	/**
	 * Return image
	 *
	 * @param string $url Image attachment url.
	 *
	 * @return array|null
	 */
	public function check_image_exist( $url ) {
		$attachments = new WP_Query(
			array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'meta_query'  => array( //phpcs:ignore
					array(
						'key'     => '_import_source',
						'value'   => $url,
						'compare' => 'LIKE',
					),
				),
			)
		);

		foreach ( $attachments->posts as $post ) {
			$attachment_url = wp_get_attachment_url( $post->ID );
			return array(
				'id'  => $post->ID,
				'url' => $attachment_url,
			);
		}

		return $attachments->posts;
	}

	/**
	 * Handle Import file, and return File ID when process complete
	 *
	 * @param string $url URL of file.
	 *
	 * @return int|null
	 */
	public function handle_file( $url ) {
		$file_name = basename( $url );
		$upload    = wp_upload_bits( $file_name, null, '' );
		$this->fetch_file( $url, $upload['file'] );

		if ( $upload['file'] ) {
			$file_loc  = $upload['file'];
			$file_name = basename( $upload['file'] );
			$file_type = wp_check_filetype( $file_name );

			$attachment = array(
				'post_mime_type' => $file_type['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
				'post_content'   => '',
				'post_status'    => 'inherit',
			);

			include_once ABSPATH . 'wp-admin/includes/image.php';
			$attach_id = wp_insert_attachment( $attachment, $file_loc );
			update_post_meta( $attach_id, '_import_source', $url );

			try {
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file_loc );
				wp_update_attachment_metadata( $attach_id, $attach_data );
			} catch ( \Exception $e ) {
				$this->handle_exception( $e );
			} catch ( \Throwable $t ) {
				$this->handle_exception( $e );
			}

			return array(
				'id'  => $attach_id,
				'url' => $upload['url'],
			);
		} else {
			return null;
		}
	}

	/**
	 * Handle Exception.
	 *
	 * @param \Exception $e Exception.
	 */
	public function handle_exception( $e ) {
		// Empty Exception.
	}

	/**
	 * Download file and save to file system
	 *
	 * @param string $url File URL.
	 * @param string $file_path file path.
	 *
	 * @return array|bool
	 */
	public function fetch_file( $url, $file_path ) {
		$http     = new \WP_Http();
		$response = $http->get(
			add_query_arg(
				array(
					'plugin_version' => GUTENVERSE_VERSION,
				),
				$url
			)
		);

		if ( is_wp_error( $response ) ) {
			return false;
		}

		$headers             = wp_remote_retrieve_headers( $response );
		$headers['response'] = wp_remote_retrieve_response_code( $response );

		if ( false === $file_path ) {
			return $headers;
		}

		// GET request - write it to the supplied filename.
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		global $wp_filesystem;
		$wp_filesystem->put_contents( $file_path, wp_remote_retrieve_body( $response ), FS_CHMOD_FILE );

		return $headers;
	}

	/**
	 * Like Layout
	 *
	 * @param object $request object.
	 */
	public function site_like_layout( $request ) {
		return $this->save_meta( $request, 'likes', 'liked_layout' );
	}

	/**
	 * Export Form Action
	 *
	 * @param object $request object.
	 */
	public function export_form_action( $request ) {
		$form_id    = $request->get_param( 'id' );
		$file_title = get_the_title( $form_id ) . '-' . time();
		$posts      = get_posts(
			array(
				'post_type'  => Entries::POST_TYPE,
				'meta_query' => array( //phpcs:ignore
					array(
						'key'     => 'form-id',
						'value'   => $form_id,
						'compare' => '===',
					),
				),
			)
		);

		header( 'Content-type: text/csv' );
		header( 'Content-Disposition: attachment; filename=' . $file_title . '.csv' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		foreach ( $posts as $id => $post ) {
			$form = get_post_meta( $post->ID, 'entry-data', true );
			if ( 0 === $id ) {
				foreach ( $form as $id => $data ) {
					echo esc_html( $data['id'] );

					if ( count( $form ) > ( $id + 1 ) ) {
						echo ',';
					}
				}
				echo "\n";
			}

			foreach ( $form as $id => $data ) {
				if ( is_array( $data['value'] ) ) {
					echo '"';
					echo esc_html( implode( ',', $data['value'] ) );
					echo '"';
				} else {
					echo esc_html( $data['value'] );
				}

				if ( count( $form ) > ( $id + 1 ) ) {
					echo ',';
				}
			}
			echo "\n";
		}

		exit;
	}

	/**
	 * Get Form Action
	 *
	 * @param object $request object.
	 *
	 * @return boolean
	 */
	public function get_form_action( $request ) {
		$id = $request->get_param( 'id' );
		return Form::get_form_action_data( $id );
	}

	/**
	 * Close Form Action Notice
	 *
	 * @return boolean
	 */
	public function form_action_notice() {
		update_option( 'gutenverse_form_action_notice', true );
		return false;
	}

	/**
	 * Delete Form Action
	 *
	 * @param object $request object.
	 *
	 * @return boolean
	 */
	public function delete_form_action( $request ) {
		$id          = $request->get_param( 'id' );
		$form_action = Form::delete_form_action( $id );
		return rest_ensure_response( $form_action );
	}

	/**
	 * Clone form action.
	 *
	 * @param object $request object.
	 *
	 * @return boolean
	 */
	public function clone_form_action( $request ) {
		$id          = $request->get_param( 'id' );
		$form_action = Form::clone_form_action( $id );
		return rest_ensure_response( $form_action );
	}

	/**
	 * Create Form Action
	 *
	 * @param object $request object.
	 *
	 * @return boolean
	 */
	public function edit_form_action( $request ) {
		$form = $request->get_param( 'form' );

		$params = wp_parse_args(
			$form,
			array(
				'id'            => '',
				'title'         => '',
				'require_login' => '',
				'user_browser'  => '',
			)
		);

		$form_action = Form::edit_form_action( $params );
		return rest_ensure_response( $form_action );
	}

	/**
	 * Create Form Action
	 *
	 * @param object $request object.
	 *
	 * @return boolean
	 */
	public function create_form_action( $request ) {
		$form = $request->get_param( 'form' );

		$params = wp_parse_args(
			$form,
			array(
				'title'                          => '',
				'require_login'                  => '',
				'user_browser'                   => '',
				'user_confirm'                   => '',
				'user_confirm'                   => '',
				'auto_select_email'              => '',
				'email_input_name'               => '',
				'user_email_subject'             => '',
				'user_email_form'                => '',
				'user_email_reply_to'            => '',
				'user_email_body'                => '',
				'admin_confirm'                  => '',
				'admin_email_subject'            => '',
				'admin_email_to'                 => '',
				'admin_email_from'               => '',
				'admin_email_reply_to'           => '',
				'admin_note'                     => '',
				'overwrite_default_confirmation' => '',
				'overwrite_default_notification' => '',
			)
		);

		$form_action = Form::create_form_action( $params );
		return rest_ensure_response( $form_action );
	}

	/**
	 * Get User IP Address
	 *
	 * @param array $data .
	 *
	 * @return array|false
	 */
	public function get_browser_data( $data ) {
		if ( empty( $data['user_browser'] ) ) {
			return false;
		}

		$ip = 'unknown';

		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
		} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}

		$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : 'unknown';

		return array(
			'ip'         => $ip,
			'user_agent' => $user_agent,
		);
	}

	/**
	 * Filter Form Params
	 *
	 * @param array $entry_data .
	 *
	 * @return array|null
	 */
	private function filter_form_params( $entry_data ) {
		$filtered_data = array();
		$entry_data    = rest_sanitize_array( $entry_data );

		if ( isset( $entry_data ) ) {
			foreach ( $entry_data as $data ) {
				if ( ! isset( $data['type'] ) ) {
					return null;
				}

				switch ( $data['type'] ) {
					case 'text':
					case 'select':
					case 'telp':
					case 'radio':
					case 'date':
					case 'image-radio':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => sanitize_text_field( $data['value'] ),
						);
						break;
					case 'email':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => sanitize_email( $data['value'] ),
						);
						break;
					case 'textarea':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => sanitize_textarea_field( $data['value'] ),
						);
						break;
					case 'number':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => floatval( $data['value'] ),
						);
						break;
					case 'switch':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => rest_sanitize_boolean( $data['value'] ),
						);
						break;
					case 'multiselect':
					case 'checkbox':
						$filtered_data[] = array(
							'id'    => sanitize_key( $data['id'] ),
							'value' => rest_sanitize_array( $data['value'] ),
						);
						break;
					default:
						break;
				}
			}
		}

		return $filtered_data;
	}

	/**
	 * Submit Form
	 *
	 * @param object $request .
	 *
	 * @return WP_Response
	 */
	public function submit_form( $request ) {
		$form_entry = $request['form-entry'];
		$form_data  = $this->filter_form_params( $form_entry['data'] );

		if ( isset( $form_data ) ) {
			$form_id    = (int) $form_entry['formId'];
			$post_id    = (int) $form_entry['postId'];
			$form_entry = array(
				'form-id'      => $form_id,
				'post-id'      => $post_id,
				'entry-data'   => $form_data,
				'browser-data' => $this->get_browser_data( $form_entry ),
			);

			$params = wp_parse_args(
				$form_entry,
				array(
					'form-id'      => 0,
					'post-id'      => 0,
					'entry-data'   => array(),
					'browser-data' => array(),
				)
			);

			$result = array( 'entry_id' => Entries::submit_form_data( $params ) );

			if ( (int) $result['entry_id'] > 0 ) {
				$settings_data = get_option( 'gutenverse-settings', array() );
				$form_data     = get_post_meta( $form_id, 'form-data', true );
				$entry_id      = $result['entry_id'];

				if ( isset( $settings_data['form'] ) ) {
					if ( isset( $settings['form']['confirmation'] ) && true !== $form_data['overwrite_default_confirmation'] ) {
						$form_data = array_merge( $form_data, $settings['form']['confirmation'] );
					}

					if ( isset( $settings['form']['notification'] ) && true !== $form_data['overwrite_default_notification'] ) {
						$form_data = array_merge( $form_data, $settings['form']['notification'] );
					}
				}

				$mail_list = $this->mail_list( $form_entry['entry-data'], $form_data );

				if ( ! empty( $mail_list ) ) {
					$result = ( new Mail() )->send_user_email( $form_id, $form_data, $entry_id, $form_entry, $mail_list );
				}

				if ( ! empty( $form_data['admin_confirm'] ) ) {
					$result = ( new Mail() )->send_admin_email( $form_id, $form_data, $entry_id, $form_entry );
				}
			}
		}

		return rest_ensure_response( $result );
	}

	/**
	 * Check mail list
	 *
	 * @param array $entry_data .
	 * @param array $form_data .
	 *
	 * @return array.
	 */
	private function mail_list( $entry_data, $form_data ) {
		if ( empty( $form_data['user_confirm'] ) ) {
			return false;
		}

		$mail_rgx   = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
		$input_name = false;
		$mail_list  = array();

		if ( ! $form_data['auto_select_email'] && isset( $form_data['email_input_name'] ) ) {
			$input_name = $form_data['email_input_name'];
		}

		foreach ( $entry_data as $data ) {
			if ( $input_name ) {
				if ( $input_name === $data['id'] && preg_match( $mail_rgx, $data['value'] ) ) {
					$mail_list[] = $data['value'];
				}
			} elseif ( preg_match( $mail_rgx, $data['value'] ) ) {
				$mail_list[] = $data['value'];
			}
		}

		return $mail_list;
	}

	/**
	 * Search Form
	 *
	 * @param object $request .
	 *
	 * @return WP_Rest.
	 */
	public function search_form( $request ) {
		$search = $request->get_param( 'search' );

		$args = array(
			'post_type' => Form::POST_TYPE,
			's'         => $search,
		);

		$query  = new \WP_Query( $args );
		$result = array();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$result[] = array(
					'label' => get_the_title(),
					'value' => get_the_ID(),
				);
			}
		}

		wp_reset_postdata();

		return $result;
	}

	/**
	 * Fetch Menu API
	 */
	public function menu() {
		$menus = wp_get_nav_menus();
		$data  = array();

		foreach ( $menus as $menu ) {
			$data[] = array(
				'label' => $menu->name,
				'value' => $menu->term_id,
			);
		}

		return $data;
	}

	/**
	 * Render WP Menu
	 *
	 * @param object $request object.
	 *
	 * @return void|string|false
	 */
	public function menu_render( $request ) {
		$menu_id = $request->get_param( 'menu' );

		return gutenverse_get_menu( $menu_id );
	}

	/**
	 * Search Meta
	 *
	 * @param object $request .
	 *
	 * @return WP_Rest.
	 */
	public function form_init( $request ) {
		$form_id   = $request->get_param( 'form_id' );
		$post_type = get_post_type( (int) $form_id );
		$result    = array(
			'require_login' => false,
			'logged_in'     => is_user_logged_in(),
		);

		if ( Form::POST_TYPE === $post_type ) {
			$data                          = get_post_meta( (int) $form_id, 'form-data', true );
			$result['require_login']       = $data['require_login'];
			$result['form_success_notice'] = $data['form_success_notice'];
			$result['form_error_notice']   = $data['form_error_notice'];
		}

		return $result;
	}

	/**
	 * Activate Theme
	 *
	 * @param object $request .
	 *
	 * @return WP_Rest.
	 */
	public function activate_theme( $request ) {
		$stylesheet = strtolower( $request->get_param( 'stylesheet' ) );

		$check_theme = wp_get_theme( $stylesheet );

		if ( $check_theme->exists() ) {
			switch_theme( $stylesheet );

			return array(
				'status' => 200,
			);
		}

		return null;
	}
}
