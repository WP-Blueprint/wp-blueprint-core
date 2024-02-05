<?php
/**
 * Sidebar Registration: Sidebars class
 *
 * Manages the structured registration of Sidebar instances within WordPress.
 * Sidebars provide a dynamic way to add widgets and customize theme layout.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\Sidebar;

/**
 * Sidebars Registration class.
 *
 * Enables the batch registration of sidebars, simplifying the process of adding multiple dynamic widget areas
 * within a WordPress theme. Utilizes the Sidebar module for each sidebar's registration, ensuring that sidebars
 * are registered in accordance with WordPress standards and best practices.
 *
 * @see \WPBlueprint\Core\Modules\Sidebar for the Sidebar class.
 * @since 1.0.0
 */
abstract class Sidebars {

	/**
	 * Registers multiple sidebars in bulk.
	 *
	 * This method simplifies the registration of custom sidebars by accepting an array
	 * of sidebar definitions. Each definition specifies the sidebar's properties, such as ID,
	 * name, description, and widget wrappers, allowing for comprehensive and flexible sidebar creation.
	 *
	 * Example usage:
	 * ```php
	 * Sidebars::set([
	 *     [
	 *         'id'            => 'header-widget',
	 *         'name'          => __('Header Widget Area', 'text-domain'),
	 *         'description'   => __('A widget area for the site header.', 'text-domain'),
	 *         'before_widget' => '<div id="%1$s" class="widget %2$s">',
	 *         'after_widget'  => '</div>',
	 *         'before_title'  => '<h3 class="widget-title">',
	 *         'after_title'   => '</h3>',
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $sidebars An array of sidebar definitions. Each definition is an associative array
	 *                        that includes the sidebar's properties, such as 'id', 'name', 'description',
	 *                        'before_widget', 'after_widget', 'before_title', and 'after_title'.
	 */
	public static function set( array $sidebars = [] ): void {
		foreach ( $sidebars as $sidebar ) {
			new Sidebar( $sidebar );
		}
	}
}
