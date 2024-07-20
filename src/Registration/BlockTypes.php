<?php
/**
 * Block Type Registration: BlockTypes class
 *
 * This class manages the structured registration of custom block type instances within WordPress,
 * facilitating the addition of new block types to the block editor. Custom block types enhance
 * the Gutenberg editor by providing additional content blocks beyond the default set provided by WordPress.
 *
 * @link [URL to relevant documentation or source code]
 *
 * @package WPBlueprint\Core
 * @subpackage Registration
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registration;

use WPBlueprint\Core\Modules\BlockType;

/**
 * BlockTypes Registration class.
 *
 * Enables the batch registration of custom block types, making it simpler for developers to extend
 * the WordPress block editor with custom content blocks. Utilizes the BlockType module for each block type's
 * registration, ensuring that each block type is registered in accordance with WordPress standards.
 *
 * @see \WPBlueprint\Core\Modules\BlockType for the BlockType class.
 * @since 1.0.0
 */
abstract class BlockTypes {

	/**
	 * Registers multiple block types in bulk.
	 *
	 * This method simplifies the process of registering custom block types by accepting an array
	 * of block type definitions. Each definition specifies the block type's properties, settings,
	 * and the block type's render callback function, allowing for comprehensive and flexible block type creation.
	 *
	 * Example usage:
	 * ```php
	 * BlockTypes::set([
	 *     [
	 *         'name' => 'custom-block',
	 *         'args' => [
	 *             'editor_script' => 'script-handle',
	 *             'editor_style'  => 'style-handle',
	 *             'render_callback' => 'render_callback_function_name',
	 *             // Additional block type arguments.
	 *         ],
	 *     ],
	 *     ...
	 * ]);
	 * ```
	 *
	 * @since 1.0.0
	 *
	 * @param array $block_types An array of block type definitions. Each definition is an associative array
	 *                           that includes 'name' and 'args', where 'args' is an array of arguments
	 *                           for registering the block type (such as 'editor_script', 'editor_style',
	 *                           'render_callback', etc.).
	 */
	public static function set( array $block_types = [] ): void {
		foreach ( $block_types as $block_type ) {
			$name = isset( $block_type['name'] ) ? $block_type['name'] : ( $block_type[0] ?? null );
			$args = isset( $block_type['args'] ) ? $block_type['args'] : ( $block_type[1] ?? [] );
			new BlockType( $name, $args );
		}
	}
}
