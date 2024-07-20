<?php
/**
 * Navigation Module: Navigation class
 *
 * Module for handling navigations with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Navigations;

/**
 * Navigation Module class.
 */
class Navigation {

	/**
	 * Navigation location.
	 *
	 * @see $location
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menu/#parameters
	 *
	 * @since 1.0.0
	 * @var string Navigation location.
	 */
	private string $location;

	/**
	 * Navigation description.
	 *
	 * @see $description
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menu/#parameters
	 *
	 * @since 1.0.0
	 * @var string Navigation description.
	 */
	private string $description;

	/**
	 * Whether to register the navigation menu.
	 *
	 * @since 1.0.0
	 * @var bool Whether to register the navigation menu.
	 */
	private bool $register_menu;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_nav_menu method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the Navigation object by setting the location, description, and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $location     Navigation location.
	 * @param string     $description  Navigation description.
	 * @param ActionHook $action_hook  Optional. ActionHook instance. Default 'init'.
	 * @param bool       $register_menu Optional. Whether to register the navigation menu. Default true.
	 */
	public function __construct( string $location, string $description, ActionHook $action_hook = null, bool $register_menu = true ) {
		$this->location      = $location;
		$this->description   = $description;
		$this->action_hook   = $action_hook ?? new ActionHook( 'init', array( $this, 'register_nav_menu' ) );
		$this->register_menu = $register_menu;
		$this->initialize();
	}

	/**
	 * Registers the navigation with WordPress.
	 *
	 * Uses the `register_nav_menu()` function to register the navigation.
	 *
	 * @see register_nav_menu()
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menu/
	 *
	 * @since 1.0.0
	 */
	public function register_nav_menu() {
		register_nav_menu( $this->location, $this->description );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the navigation as a JSON string.
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
	 * Initializes the navigation.
	 *
	 * Hooks the action to register the navigation and adds the navigation to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		if ( $this->register_menu ) {
			$this->action_hook->add_action();
		}

		Navigations::add( $this );
	}
}
