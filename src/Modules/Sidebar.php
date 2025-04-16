<?php
/**
 * Sidebar Module: Sidebar class
 *
 * Module for handling sidebars with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Sidebars;

/**
 * Sidebar Module class.
 */
class Sidebar {

	/**
	 * Array of arguments for registering a sidebar.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/register_sidebar/#parameters
	 *
	 * @since 1.0.0
	 * @var array|string Array or query string of arguments for registering a sidebar.
	 */
	private $args;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_sidebar method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the Sidebar object by setting the arguments and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param array      $args        Array of arguments for registering a sidebar.
	 * @param ActionHook $action_hook Optional. ActionHook instance. Default 'widgets_init'.
	 */
	public function __construct( $args, ?ActionHook $action_hook = null ) {
		$this->args        = $args;
		$this->action_hook = $action_hook ?? new ActionHook( 'widgets_init', array( $this, 'register_sidebar' ) );
		$this->initialize();
	}

	/**
	 * Registers the sidebar with WordPress.
	 *
	 * Uses the `register_sidebar()` function to register the sidebar.
	 *
	 * @see register_sidebar()
	 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
	 *
	 * @since 1.0.0
	 */
	public function register_sidebar(): void {
		register_sidebar( $this->args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the sidebar as a JSON string.
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
	 * Initializes the sidebar.
	 *
	 * Hooks the action to register the sidebar and adds the sidebar to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		Sidebars::add( $this );
	}
}
