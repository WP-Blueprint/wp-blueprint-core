<?php
/**
 * Registry Interface: RegistryInterface
 *
 * This interface outlines the standard operations for the registry, including the ability to add,
 * retrieve, remove, and list all items within the registry. Implementations of this interface
 * should provide the necessary logic to manage a collection of the modules.
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Registry;

use WPBlueprint\Core\Registry;

trait RegistryTrait {
	/**
	 * A static array holding the registered components, keyed by their unique hash ID.
	 *
	 * @var array
	 */
	protected static $components = array();

	/**
	 * Adds a component to the registry and returns its unique hash ID.
	 *
	 * This method ensures that the component is stored in the registry and that a unique
	 * hash ID is generated for it. The hash ID is returned to the caller for easy access.
	 *
	 * @param mixed $component The component to add to the registry. Can be any data type.
	 * @return string The unique hash ID generated for the component.
	 */
	public static function add( $component ) {
		$id                      = md5( $component );
		self::$components[ $id ] = $component;
		return $id;
	}

	/**
	 * Retrieves a component from the registry by its unique hash ID.
	 *
	 * If the component is found, it is returned; otherwise, null is returned. This method
	 * allows for easy access to components stored in the registry.
	 *
	 * @param string $key The unique hash ID of the component to retrieve.
	 * @return mixed|null The component associated with the hash ID, or null if not found.
	 */
	public static function get( $key ) {
		return static::$components[ $key ] ?? null;
	}

	/**
	 * Removes a component from the registry by its unique hash ID.
	 *
	 * This method ensures that the component is no longer available in the registry.
	 * It is useful for cleanup operations or when a component is no longer needed.
	 *
	 * @param string $key The unique hash ID of the component to remove.
	 */
	public static function remove( $key ) {
		unset( static::$components[ $key ] );
	}

	/**
	 * Returns all components currently stored in the registry.
	 *
	 * This method provides a way to access all registered components at once, returning
	 * them as an associative array keyed by their unique hash IDs.
	 *
	 * @return array An associative array of all components in the registry.
	 */
	public static function get_all() {
		return static::$components;
	}
}
