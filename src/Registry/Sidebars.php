<?php
/**
 * Sidebar Registry: Sidebars class
 *
 * Manages a registry for Sidebar instances, ensuring organized access and manipulation
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
 * Sidebars Registry class.
 *
 * Abstract class for managing Sidebar instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Sidebar for the Sidebar class.
 * @since 1.0.0
 */
abstract class Sidebars implements RegistryInterface {
	use RegistryTrait;
}
