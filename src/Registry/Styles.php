<?php
/**
 * Style Registry: Styles class
 *
 * Manages a registry for Style instances, ensuring organized access and manipulation
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
 * Styles Registry class.
 *
 * Abstract class for managing Style instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Style for the Style class.
 * @since 1.0.0
 */
abstract class Styles implements RegistryInterface {
	use RegistryTrait;
}
