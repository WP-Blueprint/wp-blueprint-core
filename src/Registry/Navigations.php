<?php
/**
 * Navigation Registry: Navigations class
 *
 * Manages a registry for Navigation instances, ensuring organized access and manipulation
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
 * Navigations Registry class.
 *
 * Abstract class for managing Navigation instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Navigation for the Navigation class.
 * @since 1.0.0
 */
abstract class Navigations implements RegistryInterface {
	use RegistryTrait;
}
