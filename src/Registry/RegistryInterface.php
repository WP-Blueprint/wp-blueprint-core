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

interface RegistryInterface {

	/**
	 * Adds an item to the registry.
	 *
	 * @param mixed $module The item to be added to the registry. This could be an instance of a class, an array of settings, or any type that represents a module or component.
	 * @return mixed A unique identifier for the added item, which can be used for retrieval or removal.
	 */
	public static function add( $module);

	/**
	 * Retrieves an item from the registry by its unique identifier.
	 *
	 * @param string $key The unique identifier of the item to retrieve.
	 * @return mixed The item associated with the provided identifier if found; null otherwise.
	 */
	public static function get( $key);

	/**
	 * Removes an item from the registry.
	 *
	 * @param string $key The unique identifier of the item to be removed.
	 */
	public static function remove( $key);

	/**
	 * Returns all items currently stored in the registry.
	 *
	 * @return array An associative array of all items in the registry, keyed by their unique identifiers.
	 */
	public static function get_all();
}
