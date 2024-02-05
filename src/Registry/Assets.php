<?php
/**
 * Asset Registry: Assets class
 *
 * Manages a registry for Asset instances, ensuring organized access and manipulation
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
 * Assets Registry class.
 *
 * Abstract class for managing Asset instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Asset for the Asset class.
 * @since 1.0.0
 */
abstract class Assets implements RegistryInterface {
	use RegistryTrait;
}
