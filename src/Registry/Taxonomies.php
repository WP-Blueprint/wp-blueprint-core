<?php
/**
 * Taxonomy Registry: Taxonomies class
 *
 * Manages a registry for Taxonomy instances, ensuring organized access and manipulation
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
 * Taxonomies Registry class.
 *
 * Abstract class for managing Taxonomy instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\Taxonomy for the Taxonomy class.
 * @since 1.0.0
 */
abstract class Taxonomies implements RegistryInterface {
	use RegistryTrait;
}
