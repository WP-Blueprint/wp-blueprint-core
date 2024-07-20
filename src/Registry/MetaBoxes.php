<?php
/**
 * Meta Box Registry: MetaBoxes class
 *
 * Manages a registry for MetaBox instances, ensuring organized access and manipulation
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
 * MetaBoxes Registry class.
 *
 * Abstract class for MetaBox instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\MetaBox for the MetaBox class.
 * @since 1.0.0
 */
abstract class MetaBoxes implements RegistryInterface {
	use RegistryTrait;
}
