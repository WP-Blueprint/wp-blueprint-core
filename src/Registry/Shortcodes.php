<?php
/**
 * Shortcode Registry: Shortcodes class
 *
 * Manages a registry for Shortcode instances, ensuring organized access and manipulation
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
 * Shortcodes Registry class.
 *
 * Abstract class for managing Shortcode instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Shortcode for the Shortcode class.
 * @since 1.0.0
 */
abstract class Shortcodes implements RegistryInterface {
	use RegistryTrait;
}
