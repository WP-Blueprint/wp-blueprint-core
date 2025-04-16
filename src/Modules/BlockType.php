<?php
/**
 * Block Type Module: BlockType class
 *
 * Module for handling block types with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\BlockTypes;

/**
 * BlockType Module class.
 */
class BlockType {

	/**
	 * Block type key.
	 *
	 * @see $block_type
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/#parameters
	 *
	 * @since 1.0.0
	 * @var string Block type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores. See sanitize_key() .
	 */
	private string $block_type;

	/**
	 * An array of arguments for registering a block type.
	 *
	 * @see $args
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/#parameters
	 *
	 * @since 1.0.0
	 * @var array|null Array or query string of arguments for registering a block type.
	 */
	private $args;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_block_type method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the BlockType object by setting the block type key, arguments, and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string       $block_type  Block type key. Must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores. See sanitize_key() .
	 * @param array|string $args        Optional. Array or query string of arguments for registering a block type.
	 *                                  See register_block_type() for information on accepted arguments.
	 * @param ActionHook   $action_hook Optional. ActionHook object for the register_block_type method. Default 'init'.
	 */
	public function __construct( string $block_type, $args, ?ActionHook $action_hook = null ) {
		$this->block_type  = $block_type;
		$this->args        = $args;
		$this->action_hook = $action_hook ?? new ActionHook( 'init', array( $this, 'register_block_type' ) );
		$this->initialize();
	}

	/**
	 * Registers the block type with WordPress.
	 *
	 * Uses the `register_block_type()` function to register the block type.
	 *
	 * @see register_block_type()
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 *
	 * @since 1.0.0
	 */
	public function register_block_type(): void {
		register_block_type( $this->block_type, $this->args );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the block type as a JSON string.
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
	 * Initializes the block type.
	 *
	 * Hooks the action to register the block type and adds the block type to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		BlockTypes::add( $this );
	}
}
