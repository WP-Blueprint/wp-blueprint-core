<?php
/**
 * Action Hook Module: ActionHook class
 *
 * Module for handling action hooks with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\ActionHooks;

/**
 * ActionHook Module class.
 */
class ActionHook {

	/**
	 * Action hook name.
	 *
	 * @see $hook_name
	 * @link https://developer.wordpress.org/reference/functions/add_action/#parameters
	 *
	 * @since 1.0.0
	 * @var string Action hook name.
	 */
	private string $hook_name;

	/**
	 * Callback function to be executed when the action hook is run.
	 *
	 * @see $callback
	 * @link https://developer.wordpress.org/reference/functions/add_action/#parameters
	 *
	 * @since 1.0.0
	 * @var callable Callback function to be executed when the action hook is run.
	 */
	private $callback;

	/**
	 * Priority of the action hook.
	 *
	 * @see $priority
	 * @link https://developer.wordpress.org/reference/functions/add_action/#parameters
	 *
	 * @since 1.0.0
	 * @var int Priority of the action hook.
	 */
	private int $priority;

	/**
	 * Number of arguments the callback accepts.
	 *
	 * @see $accepted_args
	 * @link https://developer.wordpress.org/reference/functions/add_action/#parameters
	 *
	 * @since 1.0.0
	 * @var int Number of arguments the callback accepts.
	 */
	private int $accepted_args;

	/**
	 * Constructor.
	 *
	 * Constructs the ActionHook object by setting the hook name, callback, priority, and accepted arguments.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $hook_name       Action hook name.
	 * @param callable $callback        Callback function to be executed when the action hook is run.
	 * @param int      $priority        Priority of the action hook.
	 * @param int      $accepted_args   Number of arguments the callback accepts.
	 */
	public function __construct( string $hook_name, $callback, int $priority = 10, int $accepted_args = 1 ) {
		$this->hook_name     = $hook_name;
		$this->callback      = $callback;
		$this->priority      = $priority;
		$this->accepted_args = $accepted_args;
		$this->initialize();
	}

	/**
	 * Adds the action hook to WordPress.
	 *
	 * Adds the action hook to WordPress using the add_action function.
	 *
	 * @see add_action()
	 * @link https://developer.wordpress.org/reference/functions/add_action/
	 *
	 * @since 1.0.0
	 */
	public function add_action(): void {
		add_action( $this->hook_name, $this->callback, $this->priority, $this->accepted_args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the action hook as a JSON string.
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
	 * Initializes the action hook.
	 *
	 * Adds the action hook to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		ActionHooks::add( $this );
	}
}
