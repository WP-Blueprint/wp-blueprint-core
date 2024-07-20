<?php
/**
 * Block Type Registry: BlockTypes class
 *
 * Manages a registry for BlockType instances, ensuring organized access and manipulation
 * across the system. Utilizes RegistryTrait for common registry functions.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Registry
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registry;

use WPBlueprint\Core\Registry;

/**
 * BlockTypes Registry class.
 *
 * Abstract class for managing BlockType instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\BlockType for the BlockType class.
 * @since 1.0.0
 */
abstract class BlockTypes implements RegistryInterface {
	use RegistryTrait;
}
