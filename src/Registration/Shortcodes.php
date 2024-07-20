<?php
/**
 * Shortcode Registration: Shortcodes class
 *
 * Manages the structured registration of Shortcode instances within WordPress.
 * Shortcodes provide a simple way to add dynamic content to posts, pages, and widgets.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\Shortcode;

/**
 * Shortcodes Registration class.
 *
 * Enables the batch registration of shortcodes, simplifying the process of defining and managing
 * custom shortcodes within a WordPress theme or plugin. Utilizes the Shortcode module for each
 * shortcode's registration, ensuring that shortcodes are added in accordance with WordPress
 * standards and best practices.
 *
 * @see \WPBlueprint\Core\Modules\Shortcode for the Shortcode class.
 * @since 1.0.0
 */
abstract class Shortcodes {

	/**
	 * Registers multiple shortcodes in bulk.
	 *
	 * This method simplifies the registration of custom shortcodes by accepting an array
	 * of shortcode definitions. Each definition specifies the shortcode's tag and the function
	 * that handles the shortcode's output, allowing for comprehensive and flexible shortcode creation.
	 *
	 * Example usage:
	 * ```php
	 * Shortcodes::set([
	 *     [
	 *         'tag' => 'custom_shortcode',
	 *         'callback' => 'custom_shortcode_handler_function',
	 *         // Optionally, you can specify an action hook for advanced shortcode initialization.
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $shortcodes An array of shortcode definitions. Each definition is an associative array
	 *                          that includes a 'tag' for the shortcode and a 'callback' for the function
	 *                          that generates the shortcode's output.
	 */
	public static function set( array $shortcodes = [] ): void {
		foreach ( $shortcodes as $shortcode ) {
			$tag      = isset( $shortcode['tag'] ) ? $shortcode['tag'] : ( $shortcode[0] ?? null );
			$callback = isset( $shortcode['callback'] ) ? $shortcode['callback'] : ( $shortcode[1] ?? null );
			new Shortcode( $tag, $callback );
		}
	}
}
