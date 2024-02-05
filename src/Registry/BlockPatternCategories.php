<?php
/**
 * Block Pattern Category Registry: BlockPatternCategories class
 *
 * Manages a registry for BlockPatternCategory instances, ensuring organized access and manipulation
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
 * BlockPatternCategories Registry class.
 *
 * Abstract class for managing BlockPatternCategory instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\BlockPatternCategory for the BlockPatternCategory class.
 * @since 1.0.0
 */
abstract class BlockPatternCategories extends Registry {
	use RegistryTrait;
}
