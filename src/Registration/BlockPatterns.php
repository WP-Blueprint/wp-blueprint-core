<?php
/**
 * Block Pattern Registration: BlockPatterns class
 *
 * This class manages the structured registration of block pattern instances within WordPress,
 * streamlining the process of adding new block patterns to the editor. Block patterns allow users
 * to quickly insert pre-configured layouts into their posts and pages, enhancing the content creation
 * experience.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\BlockPattern;

/**
 * BlockPatterns Registration class.
 *
 * Facilitates the batch registration of block patterns, making it easier for theme and plugin developers
 * to add custom block patterns to the WordPress block editor. This class leverages the BlockPattern module
 * for each pattern's registration, ensuring a consistent and straightforward process.
 *
 * @see \WPBlueprint\Core\Modules\BlockPattern for the BlockPattern class.
 * @since 1.0.0
 */
abstract class BlockPatterns {

	/**
	 * Registers multiple block patterns in bulk.
	 *
	 * This method streamlines the registration of custom block patterns by accepting an array
	 * of pattern definitions. Each definition specifies the pattern's properties and content,
	 * allowing for a quick and organized setup.
	 *
	 * Example usage:
	 * ```php
	 * BlockPatterns::set([
	 *     [
	 *         'name' => 'custom-pattern',
	 *         'properties' => [
	 *             'title' => __('Custom Pattern', 'text-domain'),
	 *             'content' => '<!-- wp:paragraph --><p>Hello World</p><!-- /wp:paragraph -->',
	 *             'categories' => ['custom-category'],
	 *             'keywords' => ['example'],
	 *         ],
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $block_patterns An array of block pattern definitions. Each definition is an associative array
	 *                              that includes 'name' and 'properties', where 'properties' is an array that
	 *                              can include 'title', 'content', 'categories', 'keywords', and other block pattern attributes.
	 */
	public static function set( array $block_patterns = [] ): void {
		foreach ( $block_patterns as $block_pattern ) {
			$pattern_name       = isset( $block_pattern['name'] ) ? $block_pattern['name'] : ( $block_pattern[0] ?? null );
			$pattern_properties = isset( $block_pattern['properties'] ) ? $block_pattern['properties'] : ( $block_pattern[1] ?? [] );
			new BlockPattern( $pattern_name, $pattern_properties );
		}
	}
}
