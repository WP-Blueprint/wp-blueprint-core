<?php
/**
 * Shortcode Module: Shortcode class
 *
 * Module for handling shortcodes with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\Shortcodes;

/**
 * Shortcode Module class.
 */
class Shortcode {

	/**
	 * Shortcode tag.
	 *
	 * @see $tag
	 * @link https://developer.wordpress.org/reference/functions/add_shortcode/#parameters
	 *
	 * @since 1.0.0
	 * @var string Shortcode tag to be searched in post content.
	 */
	private string $tag;

	/**
	 * Callback function.
	 *
	 * @see $callback
	 * @link https://developer.wordpress.org/reference/functions/add_shortcode/#parameters
	 *
	 * @since 1.0.0
	 * @var callable Callback function to run when the shortcode is found.
	 */
	private $callback;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the add_shortcode method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the Shortcode object by setting the tag, callback, and action_hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $tag         Shortcode tag to be searched in post content.
	 * @param callable   $callback    Callback function to run when the shortcode is found.
	 * @param ActionHook $action_hook Optional. ActionHook instance. Default 'init'.
	 */
	public function __construct( string $tag, $callback, ?ActionHook $action_hook = null ) {
		$this->tag         = $tag;
		$this->callback    = $callback;
		$this->action_hook = $action_hook ?? new ActionHook( 'init', array( $this, 'add_shortcode' ) );
		$this->initialize();
	}

	/**
	 * Adds the shortcode to WordPress.
	 *
	 * Uses the `add_shortcode()` function to add the shortcode to WordPress.
	 *
	 * @see add_shortcode()
	 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
	 *
	 * @since 1.0.0
	 */
	public function add_shortcode(): void {
		add_shortcode( $this->tag, $this->callback );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the shortcode as a JSON string.
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
	 * Initializes the shortcode.
	 *
	 * Hooks the action to register the shortcode and adds the shortcode to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		Shortcodes::add( $this );
	}
}
