<?php
/**
 * Taxonomy Registration: Taxonomies class
 *
 * Manages the structured registration of custom taxonomy instances within WordPress.
 * Taxonomies provide a way to group posts and custom post types together, enhancing the
 * site's content architecture and navigation.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\Taxonomy;

/**
 * Taxonomies Registration class.
 *
 * Facilitates the batch registration of custom taxonomies, streamlining their setup and
 * association with post types. Utilizes the Taxonomy module for each taxonomy's registration,
 * ensuring that taxonomies are added in accordance with WordPress standards and best practices.
 *
 * @see \WPBlueprint\Core\Modules\Taxonomy for the Taxonomy class.
 * @since 1.0.0
 */
abstract class Taxonomies {

	/**
	 * Registers multiple custom taxonomies in bulk.
	 *
	 * This method simplifies the process of registering custom taxonomies by accepting an array
	 * of taxonomy definitions. Each definition specifies the taxonomy's key, the object types it is
	 * associated with, and an array of arguments for customizing the taxonomy.
	 *
	 * Example usage:
	 * ```php
	 * Taxonomies::set([
	 *     [
	 *         'taxonomy' => 'genre',
	 *         'object_type' => ['post'],
	 *         'args' => [
	 *             'hierarchical' => true,
	 *             'labels' => [
	 *                 'name' => __('Genres', 'text-domain'),
	 *                 'singular_name' => __('Genre', 'text-domain'),
	 *                 // Additional labels...
	 *             ],
	 *             'show_ui' => true,
	 *             // Additional taxonomy arguments...
	 *         ],
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @param array $taxonomies An array of custom taxonomy definitions. Each definition is an associative array
	 *                          that includes 'taxonomy', 'object_type' (array of post types), and 'args' for
	 *                          the taxonomy arguments.
	 *
	 * @since 1.0.0
	 */
	public static function set( array $taxonomies = array() ): void {
		foreach ( $taxonomies as $taxonomy ) {
			$key         = isset( $taxonomy['taxonomy'] ) ? $taxonomy['taxonomy'] : ( $taxonomy[0] ?? null );
			$object_type = isset( $taxonomy['object_type'] ) ? $taxonomy['object_type'] : ( $taxonomy[1] ?? null );
			$args        = isset( $taxonomy['args'] ) ? $taxonomy['args'] : ( $taxonomy[2] ?? array() );
			new Taxonomy( $key, $object_type, $args );
		}
	}
}
