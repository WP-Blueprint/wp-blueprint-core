<?php
/**
 * Asset Module: Asset class
 *
 * Module for handling assets with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Assets;

/**
 * Asset Module class.
 */
class Asset {

	/**
	 * Asset handle.
	 *
	 * @see $handle
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var string Name of the script. Should be unique.
	 */
	protected string $handle;

	/**
	 * Asset source.
	 *
	 * @see $src
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var string Full URL of the script, or path of the script relative to the WordPress root directory.
	 */
	protected string $src;

	/**
	 * Asset dependencies.
	 *
	 * @see $deps
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var string[] An array of registered script handles this script depends on.
	 */
	protected $deps;

	/**
	 * Asset version.
	 *
	 * @see $ver
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var string|bool String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
	 */
	protected $ver;

	/**
	 * Asset arguments.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var array|null Array or query string of arguments for registering a script.
	 */
	protected $register_only;

	/**
	 * ActionHook instance for the enqueue action.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook instance for the enqueue action.
	 */
	protected ActionHook $action_hook_enqueue;

	/**
	 * ActionHook instance for the register action.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook instance for the register action.
	 */
	protected ActionHook $action_hook_register;

	/**
	 * Custom toString magic method.
	 *
	 * Returns the asset as a JSON string.
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
	 * Initializes the asset.
	 *
	 * Sets the action hooks and adds the asset to the registry.
	 *
	 * @since 1.0.0
	 */
	protected function initialize(): void {
		$this->register_only ? $this->action_hook_register->add_action() : ( $this->action_hook_enqueue->add_action() && $this->action_hook_register->add_action() );
		Assets::add( $this );
	}
}
