<?php
/**
 * Post Type Registration: PostTypes class
 *
 * This class manages the structured registration of custom post type instances within WordPress,
 * facilitating the addition of new, specialized content types. Custom post types extend the WordPress
 * content management system, allowing for the creation of tailored content structures.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\PostType;

/**
 * PostTypes Registration class.
 *
 * Enables the batch registration of custom post types, simplifying the process of defining and managing
 * unique content types within a WordPress theme or plugin. Utilizes the PostType module for each post type's
 * registration, ensuring that each custom post type is registered according to WordPress standards and best practices.
 *
 * @see \WPBlueprint\Core\Modules\PostType for the PostType class.
 * @since 1.0.0
 */
abstract class PostTypes {

	/**
	 * Registers multiple custom post types in bulk.
	 *
	 * This method simplifies the registration of custom post types by accepting an array
	 * of post type definitions. Each definition specifies the post type's key, labels, supports array,
	 * and other arguments, allowing for comprehensive and flexible content type creation.
	 *
	 * Example usage:
	 * ```php
	 * PostTypes::set([
	 *     [
	 *         'key' => 'custom_post_type',
	 *         'args' => [
	 *             'label' => __('Custom Post Type', 'text-domain'),
	 *             'public' => true,
	 *             'supports' => ['title', 'editor', 'thumbnail'],
	 *             // Additional custom post type arguments.
	 *         ],
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $post_types An array of custom post type definitions. Each definition is an associative array
	 *                          that includes a 'key' for the post type identifier and 'args' for an array of
	 *                          arguments used to register the post type.
	 */
	public static function set( array $post_types = [] ): void {
		foreach ( $post_types as $post_type ) {
			$key  = isset( $post_type['key'] ) ? $post_type['key'] : ( $post_type[0] ?? null );
			$args = isset( $post_type['args'] ) ? $post_type['args'] : ( $post_type[1] ?? [] );
			new PostType( $key, $args );
		}
	}
}
