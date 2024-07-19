<?php
/**
 * Meta Box Registration: MetaBoxes class
 *
 * This class manages the structured registration of meta box instances within WordPress,
 * facilitating the addition of custom meta boxes to various screens in the admin area.
 * Meta boxes provide a flexible way to add custom data inputs and UI elements to posts,
 * pages, and custom post types.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\MetaBox;

/**
 * MetaBoxes Registration class.
 *
 * Enables the batch registration of meta boxes, simplifying the process of adding custom data fields
 * and interfaces to the WordPress admin. Utilizes the MetaBox module for each meta box's registration,
 * ensuring that each meta box is added in accordance with WordPress best practices and standards.
 *
 * @see \WPBlueprint\Core\Modules\MetaBox for the MetaBox class.
 * @since 1.0.0
 */
abstract class MetaBoxes {

	/**
	 * Registers multiple meta boxes in bulk.
	 *
	 * This method simplifies the registration of custom meta boxes by accepting an array
	 * of meta box definitions. Each definition specifies the meta box's ID, title, callback,
	 * context, priority, and optional callback arguments, allowing for comprehensive and
	 * flexible meta box creation.
	 *
	 * Example usage:
	 * ```php
	 * MetaBoxes::set([
	 *     [
	 *         'id' => 'custom-meta-box',
	 *         'title' => __('Custom Meta Box', 'text-domain'),
	 *         'callback' => 'custom_meta_box_callback_function',
	 *         'screen' => 'post',
	 *         'context' => 'normal',
	 *         'priority' => 'high',
	 *         'callback_args' => null, // Optional
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $meta_boxes An array of meta box definitions. Each definition is an associative array
	 *                          that includes 'id', 'title', 'callback', 'screen', 'context', 'priority',
	 *                          and optionally 'callback_args'.
	 */
	public static function set( array $meta_boxes = array() ): void {
		foreach ( $meta_boxes as $meta_box ) {
			$id            = isset( $meta_box['id'] ) ? $meta_box['id'] : ( $meta_box[0] ?? null );
			$title         = isset( $meta_box['title'] ) ? $meta_box['title'] : ( $meta_box[1] ?? null );
			$callback      = isset( $meta_box['callback'] ) ? $meta_box['callback'] : ( $meta_box[2] ?? null );
			$screen        = isset( $meta_box['screen'] ) ? $meta_box['screen'] : ( $meta_box[3] ?? null );
			$context       = isset( $meta_box['context'] ) ? $meta_box['context'] : ( $meta_box[4] ?? 'advanced' );
			$priority      = isset( $meta_box['priority'] ) ? $meta_box['priority'] : ( $meta_box[5] ?? 'default' );
			$callback_args = isset( $meta_box['callback_args'] ) ? $meta_box['callback_args'] : ( $meta_box[6] ?? null );
			new MetaBox( $id, $title, $callback, $screen, $context, $priority, $callback_args );
		}
	}
}
