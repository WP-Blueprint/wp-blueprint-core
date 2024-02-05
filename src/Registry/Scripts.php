<?php
/**
 * Script Registry: Scripts class
 *
 * Manages a registry for Script asset instances, ensuring organized access and manipulation
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
 * Scripts Registry class.
 *
 * Abstract class for Script asset instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Script for the Script class.
 * @since 1.0.0
 */
abstract class Scripts implements RegistryInterface {
	use RegistryTrait;
}
