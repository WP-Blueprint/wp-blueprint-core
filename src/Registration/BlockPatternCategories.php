<?php
/**
 * Block Pattern Category Registration: BlockPatternCategories class
 *
 * This class manages the structured registration of block pattern categories within WordPress,
 * simplifying the process of adding new categories to the block editor. These categories
 * can then be used to organize custom block patterns, enhancing the user experience by
 * grouping similar patterns together.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\BlockPatternCategory;

/**
 * BlockPatternCategories Registration class.
 *
 * Facilitates the batch registration of block pattern categories by providing a simple and
 * efficient method to define and register multiple categories at once. This class leverages the
 * BlockPatternCategory module for each category's registration, ensuring that the process aligns
 * with WordPress standards and practices.
 *
 * @see \WPBlueprint\Core\Modules\BlockPatternCategory for the BlockPatternCategory class.
 * @since 1.0.0
 */
abstract class BlockPatternCategories {

	/**
	 * Registers multiple block pattern categories in bulk.
	 *
	 * This method streamlines the registration of block pattern categories by accepting an array
	 * of category definitions. Each definition specifies the category's properties and attributes,
	 * allowing for a comprehensive setup with minimal code.
	 *
	 * Example usage:
	 * ```php
	 * BlockPatternCategories::set([
	 *     [
	 *         'category_name' => 'custom-category',
	 *         'category_properties' => [
	 *             'label' => __('Custom Category', 'text-domain'),
	 *         ],
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $block_pattern_categories An array of block pattern category definitions.
	 *                                        Each definition is an associative array that must include
	 *                                        'category_name' and may include 'category_properties' which
	 *                                        is an array of properties for the category (e.g., label).
	 */
	public static function set( array $block_pattern_categories = array() ): void {
		foreach ( $block_pattern_categories as $block_pattern_category ) {
			// Check if using associative array or indexed array.
			if ( isset( $block_pattern_category['category_name'] ) ) {
				// Associative array detected.
				$category_name       = $block_pattern_category['category_name'];
				$category_properties = $block_pattern_category['category_properties'] ?? array();
			} else {
				// Assuming indexed array with a specific order.
				// 0 => category_name, 1 => category_properties.
				$category_name       = $block_pattern_category[0] ?? null;
				$category_properties = $block_pattern_category[1] ?? array();
			}

			new BlockPatternCategory( $category_name, $category_properties );
		}
	}
}
