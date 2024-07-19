<?php
/**
 * Assets Registration: Assets class
 *
 * This class is responsible for the structured registration and management of assets
 * within a WordPress theme or plugin. It allows for the organized declaration of stylesheets
 * and JavaScript files, leveraging a streamlined approach to enqueue or register them
 * with WordPress.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\Style;
use WPBlueprint\Core\Modules\Script;

/**
 * Assets Registration class.
 *
 * Provides a method for the batch registration of assets using a declarative array structure.
 * This abstract class serves as a foundation for managing asset dependencies, versions,
 * and inclusion conditions across different parts of a WordPress site.
 *
 * @since 1.0.0
 */
abstract class Assets {

	/**
	 * Registers multiple assets in bulk.
	 *
	 * This method allows for the efficient registration of multiple assets by accepting
	 * an array of asset definitions. Each asset definition is an associative array that specifies
	 * the properties of the asset, such as its handle, source URL, dependencies, version, and other
	 * relevant attributes for stylesheets and scripts.
	 *
	 * Example usage:
	 * ```php
	 * Assets::set([
	 *     [
	 *         'handle'  => 'main-style',
	 *         'src'     => mix('css/style.css'), // Assumes `mix` is a function that resolves asset paths.
	 *         'deps'    => [],
	 *         'version' => '1.0.0',
	 *         'media'   => 'all', // For stylesheets only.
	 *         'hook'    => 'wp_enqueue_scripts',
	 *     ],
	 *     [
	 *         'handle'    => 'main-script',
	 *         'src'       => mix('js/app.js'),
	 *         'deps'      => [],
	 *         'version'   => '1.0.0',
	 *         'in_footer' => true, // For scripts only. Determines where the script is loaded.
	 *         'hook'      => 'wp_enqueue_scripts',
	 *     ],
	 * ]);
	 * ```
	 *
	 * @link [URL to more detailed documentation or examples]
	 *
	 * @since 1.0.0
	 *
	 * @param array $assets An array of asset definitions. Each definition is an associative array that
	 *                      includes 'handle', 'src', 'deps', 'version', and optionally 'media' for styles,
	 *                      and 'in_footer' for scripts, among others.
	 */
	public static function set( array $assets = array() ): void {
		foreach ( $assets as $asset ) {
			// Check if using associative array or indexed array.
			if ( isset( $asset['handle'] ) && isset( $asset['src'] ) ) {
				// Associative array detected.
				$handle        = $asset['handle'];
				$src           = $asset['src'];
				$deps          = $asset['deps'] ?? array();
				$ver           = $asset['version'] ?? false;
				$register_only = $asset['register_only'] ?? false;
				$media         = $asset['media'] ?? 'all'; // Default for styles.
				$in_footer     = $asset['in_footer'] ?? false; // Default for scripts.
			} else {
				// Assuming indexed array with a specific order.
				// 0 => handle, 1 => src, 2 => deps, 3 => version, 4 => media/in_footer, 5 => register_only.
				$handle = $asset[0] ?? null;
				$src    = $asset[1] ?? null;
				$deps   = $asset[2] ?? array();
				$ver    = $asset[3] ?? false;
				// Use a conditional based on the asset type to determine if the next index is 'media' or 'in_footer'.
				$media_or_in_footer = $asset[4] ?? null;
				$register_only      = $asset[5] ?? false;
				// Determine if dealing with a stylesheet or script based on the file extension in $src.
				if ( preg_match( '/\.css$/', $src ) ) {
					$media     = $media_or_in_footer; // For styles, the 4th index is 'media'.
					$in_footer = false; // Default, not applicable for styles.
				} else {
					$media     = 'all'; // Default, not applicable for scripts.
					$in_footer = $media_or_in_footer; // For scripts, the 4th index is 'in_footer'.
				}
			}

			// Distinguish between styles and scripts by file extension to register or enqueue.
			if ( preg_match( '/\.css$/', $src ) ) {
				new Style( $handle, $src, $deps, $ver, $media, $register_only );
			} elseif ( preg_match( '/\.js$/', $src ) ) {
				new Script( $handle, $src, $deps, $ver, $in_footer, $register_only );
			} else {
				// Unsupported asset type, skip registration.
				continue;
			}
		}
	}
}
