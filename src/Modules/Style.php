<?php
/**
 * Style Module: Style class
 *
 * Module for handling style assets with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Styles;

/**
 * Style Module class extends Asset class.
 */
class Style extends Asset {

	/**
	 * The media for which this stylesheet has been defined.
	 *
	 * @see $media
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/#parameters
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/#parameters
	 *
	 * @since 1.0.0
	 * @var string Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like ‘(orientation: portrait)’ and ‘(max-width: 640px)’. Default:'all'
	 */
	private string $media;

	/**
	 * Constructor.
	 *
	 * Constructs the Style object by setting the handle, source, dependencies, version, media, and register_only.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $handle               Name of the stylesheet. Should be unique.
	 * @param string       $src                  Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
	 * @param array|string $deps                 Optional. An array of registered stylesheet handles this stylesheet depends on. Default empty array.
	 * @param string|bool  $ver                  Optional. String specifying the stylesheet version number. If set to false, WordPress version will be used. Default false.
	 * @param string       $media                Optional. The media for which this stylesheet has been defined. Default 'all'.
	 * @param bool         $register_only         Optional. Whether to only register the stylesheet and not enqueue. Default false.
	 * @param ActionHook   $action_hook_enqueue  Optional. ActionHook object for the wp_enqueue_scripts method. Default 'wp_enqueue_scripts'.
	 * @param ActionHook   $action_hook_register Optional. ActionHook object for the wp_register_style method. Default 'wp_enqueue_scripts'.
	 */
	public function __construct( string $handle, string $src, $deps = array(), $ver = false, string $media = 'all', bool $register_only = false, ?ActionHook $action_hook_enqueue = null, ?ActionHook $action_hook_register = null ) {
		$this->handle               = $handle;
		$this->src                  = $src;
		$this->deps                 = $deps;
		$this->ver                  = $ver;
		$this->media                = $media;
		$this->register_only        = $register_only;
		$this->action_hook_enqueue  = $action_hook_enqueue ?? new ActionHook( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		$this->action_hook_register = $action_hook_register ?? new ActionHook( 'wp_enqueue_scripts', array( $this, 'register_style' ) );
		$this->initialize();
	}

	/**
	 * Enqueues the style asset to WordPress.
	 *
	 * Uses the `wp_enqueue_style()` function to enqueue the style asset.
	 *
	 * @see wp_enqueue_style()
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *
	 * @since 1.0.0
	 */
	public function enqueue_style(): void {
		wp_enqueue_style( $this->handle, $this->src, $this->deps, $this->ver, $this->media );
	}

	/**
	 * Registers the style asset to WordPress.
	 *
	 * Uses the `wp_register_style()` function to register the style asset.
	 *
	 * @see wp_register_style()
	 * @link https://developer.wordpress.org/reference/functions/wp_register_style/
	 *
	 * @since 1.0.0
	 */
	public function register_style(): void {
		wp_register_style( $this->handle, $this->src, $this->deps, $this->ver, $this->media );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the style and asset as a JSON string.
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
	 * Initializes the style asset.
	 *
	 * Calls the parent initialize method and adds the style asset to the registry.
	 *
	 * @since 1.0.0
	 */
	protected function initialize(): void {
		parent::initialize();
		Styles::add( $this );
	}
}
