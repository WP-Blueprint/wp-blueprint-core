<?php
/**
 * Taxonomy Module: Taxonomy class
 *
 * Module for handling taxonomies with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Taxonomies;

/**
 * Taxonomy Module class.
 *
 * @since 1.0.0
 */
class Taxonomy {

	/**
	 * Taxonomy key.
	 *
	 * @see $taxonomy
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters
	 *
	 * @since 1.0.0
	 * @var string Taxonomy key. Must not exceed 32 characters and may only contain lowercase alphanumeric characters, dashes, and underscores. See sanitize_key() .
	 */
	private string $taxonomy;

	/**
	 * An array of object types this taxonomy is registered for.
	 *
	 * @see $object_type
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters
	 *
	 * @since 1.0.0
	 * @var string[] Object type or array of object types with which the taxonomy should be associated.
	 */
	private $object_type;

	/**
	 * Array of arguments to automatically use inside `wp_get_object_terms()` for this taxonomy.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters
	 *
	 * @since 1.0.0
	 * @var array|null Array or query string of arguments for registering a taxonomy.
	 */
	private $args;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_taxonomy method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the Taxonomy object by setting the taxonomy, object type, and arguments.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $taxonomy    Taxonomy key, must not exceed 32 characters.
	 * @param array|string $object_type Name of the object type for the taxonomy object.
	 * @param array|string $args        Optional. Array or query string of arguments for registering a taxonomy.
	 *                                  See register_taxonomy() for information on accepted arguments.
	 * @param ActionHook   $action_hook Optional. ActionHook object for the register_taxonomy method.
	 */
	public function __construct( string $taxonomy, $object_type, $args, ActionHook $action_hook = null ) {
		$this->taxonomy    = $taxonomy;
		$this->object_type = $object_type;
		$this->args        = $args;
		$this->action_hook = $action_hook ?? new ActionHook( 'init', array( $this, 'register_taxonomy' ) );
		$this->initialize();
	}

	/**
	 * Registers the taxonomy with WordPress.
	 *
	 * Uses the `register_taxonomy()` function to register the taxonomy.
	 *
	 * @see register_taxonomy()
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
	 *
	 * @since 1.0.0
	 */
	public function register_taxonomy(): void {
		register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the taxonomy as a JSON string.
	 *
	 * @since 1.0.0
	 *
	 * @return string JSON string.
	 */
	public function __toString(): string {
		$json = wp_json_encode( $this );
		return $json;
	}

	/**
	 * Initializes the taxonomy.
	 *
	 * Hooks the action to register the taxonomy and adds the taxonomy to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		Taxonomies::add( $this );
	}
}
