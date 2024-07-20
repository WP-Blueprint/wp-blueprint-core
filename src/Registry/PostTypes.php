<?php
/**
 * Post Type Registry: PostTypes class
 *
 * Manages a registry for PostType instances, ensuring organized access and manipulation
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
 * PostTypes Registry class.
 *
 * Abstract class for managing PostType instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\PostType for the PostType class.
 * @since 1.0.0
 */
abstract class PostTypes implements RegistryInterface {
	use RegistryTrait;
}
