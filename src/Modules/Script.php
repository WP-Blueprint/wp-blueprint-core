<?php
/**
 * Script Module: Script class
 *
 * Module for handling script assets with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Scripts;

/**
 * Script Module class expanding the Asset class.
 */
class Script extends Asset {

	/**
	 * An array of additional script loading strategies.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/#parameters
	 *
	 * @since 1.0.0
	 * @var string Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like ‘(orientation: portrait)’ and ‘(max-width: 640px)’. Default:'all'
	 */
	private $args;

	/**
	 * Constructor.
	 *
	 * Constructs the Script object by setting the handle, source, dependencies, version, args, and register_only.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $handle               Name of the script. Should be unique.
	 * @param string       $src                  Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @param array|string $deps                 Optional. An array of registered script handles this script depends on. Default empty array.
	 * @param string|bool  $ver                  Optional. String specifying the script version number. If set to false, WordPress version will be used. Default false.
	 * @param array        $args                 Optional. An array of additional script loading strategies. Default empty array.
	 * @param bool         $register_only        Optional. Whether to only register the script and not enqueue. Default false.
	 * @param ActionHook   $action_hook_enqueue  Optional. ActionHook object for the wp_enqueue_scripts method. Default 'wp_enqueue_scripts'.
	 * @param ActionHook   $action_hook_register Optional. ActionHook object for the wp_register_script method. Default 'wp_enqueue_scripts'.
	 */
	public function __construct( string $handle, string $src, $deps = array(), $ver = false, $args = array(), bool $register_only = false, ActionHook $action_hook_enqueue = null, ActionHook $action_hook_register = null ) {
		$this->handle               = $handle;
		$this->src                  = $src;
		$this->deps                 = $deps;
		$this->ver                  = $ver;
		$this->args                 = $args;
		$this->action_hook_enqueue  = $action_hook_enqueue ?? new ActionHook( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ) );
		$this->action_hook_register = $action_hook_register ?? new ActionHook( 'wp_enqueue_scripts', array( $this, 'register_script' ) );
		$this->initialize();
	}

	/**
	 * Enqueues the script asset to WordPress.
	 *
	 * Uses the `wp_enqueue_script()` function to enqueue the script asset.
	 *
	 * @see wp_enqueue_script()
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 *
	 * @since 1.0.0
	 */
	public function enqueue_script(): void {
		wp_enqueue_script( $this->handle, $this->src, $this->deps, $this->ver, $this->args );
	}

	/**
	 * Enqueues the script asset to WordPress.
	 *
	 * Uses the `wp_register_script()` function to register the script asset.
	 *
	 * @see wp_register_script()
	 * @link https://developer.wordpress.org/reference/functions/wp_register_script/
	 *
	 * @since 1.0.0
	 */
	public function register_script(): void {
		wp_register_script( $this->handle, $this->src, $this->deps, $this->ver, $this->args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the script asset as a JSON string.
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
	 * Initializes the script asset.
	 *
	 * Calls the parent initialize method and adds the script asset to the registry.
	 *
	 * @since 1.0.0
	 */
	protected function initialize(): void {
		parent::initialize();
		Scripts::add( $this );
	}
}
