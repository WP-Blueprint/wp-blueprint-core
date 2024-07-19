<?php
/**
 * Navigation Registration: Navigations class
 *
 * Manages the structured registration of Navigation menu instances.
 *
 * Navigation menus in WordPress provide a flexible way to add menus to your WordPress theme,
 * allowing users to create and manage menus via the WordPress admin.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\Navigation;

/**
 * Navigations Registration class.
 *
 * Enables the batch registration of navigation menus, simplifying the process of adding and managing
 * multiple navigations throughout a WordPress theme. Utilizes the Navigation module for each menu's
 * registration, ensuring that menus are registered in accordance with WordPress standards and practices.
 *
 * @see \WPBlueprint\Core\Modules\Navigation for the Navigation class.
 * @since 1.0.0
 */
abstract class Navigations {

	/**
	 * Registers multiple navigation menus in bulk.
	 *
	 * This method simplifies the process of registering custom navigation menus by accepting an associative
	 * array of menu locations and descriptions. This allows for a quick and organized setup of multiple menus.
	 *
	 * Example usage:
	 * ```php
	 * Navigations::set([
	 *     'primary' => 'Primary Menu',
	 *     'footer' => 'Footer Menu',
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $navigations An associative array of navigation menu locations and their descriptions.
	 *                           The array keys represent the menu location identifiers, while the values
	 *                           are the descriptions for these locations.
	 */
	public static function set( array $navigations = array() ): void {
		foreach ( $navigations as $location => $description ) {
			new Navigation( $location, $description );
		}
	}
}
