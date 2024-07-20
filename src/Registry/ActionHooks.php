<?php
/**
 * Action Hook Registry: ActionHook class
 *
 * Manages a registry for ActionHook instances, ensuring organized access and manipulation
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
 * ActionHooks Registry class.
 *
 * Abstract class for managing ActionHook instances in a centralized registry.
 * Supports adding, retrieving, and removing instances.
 *
 * @see \WPBlueprint\Core\Modules\ActionHook for the ActionHook class.
 * @since 1.0.0
 */
abstract class ActionHooks implements RegistryInterface {
	use RegistryTrait;
}
