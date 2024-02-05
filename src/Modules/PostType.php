<?php
/**
 * Post Type Module: PostType class
 *
 * Module for handling post types with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\PostTypes;

/**
 * PostType Module class.
 */
class PostType {

	/**
	 * Post type key.
	 *
	 * @see $post_type
	 * @link https://developer.wordpress.org/reference/functions/register_post_type/#parameters
	 *
	 * @since 1.0.0
	 * @var string Post type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores. See sanitize_key() .
	 */
	private string $post_type;

	/**
	 * An array of arguments for registering a post type.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/register_post_type/#parameters
	 *
	 * @since 1.0.0
	 * @var array|null Array or query string of arguments for registering a post type.
	 */
	private $args;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_post_type method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the PostType object by setting the post type key, arguments, and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $post_type   Post type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores. See sanitize_key() .
	 * @param array      $args        Array or query string of arguments for registering a post type.
	 * @param ActionHook $action_hook Optional. ActionHook instance. Default 'init'.
	 */
	public function __construct( string $post_type, $args, ActionHook $action_hook = null ) {
		$this->post_type   = $post_type;
		$this->args        = $args;
		$this->action_hook = $action_hook ?? new ActionHook( 'init', array( $this, 'register_post_type' ) );
		$this->initialize();
	}

	/**
	 * Registers the post type with WordPress.
	 *
	 * Uses the `register_post_type()` function to register the post type.
	 *
	 * @see register_post_type()
	 * @link https://developer.wordpress.org/reference/functions/register_post_type/
	 *
	 * @since 1.0.0
	 */
	public function register_post_type(): void {
		register_post_type( $this->post_type, $this->args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the post type as a JSON string.
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
	 * Initializes the post type.
	 *
	 * Hooks the action to register the post type and adds the post type to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		PostTypes::add( $this );
	}
}
