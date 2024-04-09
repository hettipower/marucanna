<?php

namespace Gravity_Forms\Gravity_Forms\Assets;

class GF_Asset_Processor {

	/**
	 * @var array $map - The Hash Map generated by our node scripts.
	 */
	private $map;

	/**
	 * @var string $asset_path - The path to the js dist directory.
	 */
	private $asset_path;

	/**
	 * Constructor
	 *
	 * @since 2.6
	 *
	 * @param array $map
	 * @param string $asset_path
	 *
	 * @return void
	 */
	public function __construct( $map, $asset_path ) {
		$this->map = $map;
		$this->asset_path = $asset_path;
	}

	/**
	 * Perform processing actions on assets.
	 *
	 * @since 2.6
	 *
	 * @return void
	 */
	public function process_assets() {
		$this->process_versions();
	}

	/**
	 * Process the ver values for all of the registered scripts in order to append a
	 * file hash (if it exists) or the filemtime (if required).
	 *
	 * @since 2.6
	 *
	 * @return void
	 */
	private function process_versions() {
		global $wp_scripts;

		$registered = $wp_scripts->registered;

		foreach( $registered as &$asset ) {

			// Bail if not one of our assets.
			if ( $asset->src && strpos( $asset->src, 'gravityforms/assets/js/dist' ) === false ) {
				continue;
			}

			$basename = basename( $asset->src );
			$path     = sprintf( '%s/%s', $this->asset_path, $basename );

			// Asset doesn't exist in hash_map, skip.
			if ( ! array_key_exists( $basename, $this->map ) ) {
				continue;
			}

			// The hash is either the value from our map, or the filemtime for dev.
			$hash = defined( 'GF_DEV_TIME_AS_VER' ) && GF_DEV_TIME_AS_VER ?
					filemtime( $path ) :
					$this->map[ $basename ]['version'];

			$asset->ver = $hash;
		}

		$wp_scripts->registered = $registered;

		return;
	}

}