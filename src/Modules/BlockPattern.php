<?php
/**
 * Block Pattern Module: BlockPattern class
 *
 * Module for handling block patterns with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\BlockPatterns;

/**
 * BlockPattern Module class.
 */
class BlockPattern {

	/**
	 * Block pattern name.
	 *
	 * @see $pattern_name
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern/#parameters
	 *
	 * @since 1.0.0
	 * @var string Block pattern name including namespace.
	 */
	private string $pattern_name;

	/**
	 * Block pattern properties.
	 *
	 * @see $pattern_properties
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern/#parameters
	 *
	 * @since 1.0.0
	 * @var array List of properties for the block pattern.
	 */
	private $pattern_properties;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_block_pattern method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the BlockPattern object by setting the pattern name, pattern properties, and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $pattern_name       Block pattern name including namespace.
	 * @param array      $pattern_properties List of properties for the block pattern.
	 * @param ActionHook $action_hook        Optional. ActionHook instance. Default 'init'.
	 */
	public function __construct( string $pattern_name, $pattern_properties, ActionHook $action_hook = null ) {
		$this->pattern_name       = $pattern_name;
		$this->pattern_properties = $pattern_properties;
		$this->action_hook        = $action_hook ?? new ActionHook( 'init', array( $this, 'register_block_pattern' ) );
		$this->initialize();
	}

	/**
	 * Registers the block pattern with WordPress.
	 *
	 * Uses the `register_block_pattern()` function to register the block pattern.
	 *
	 * @see register_block_pattern()
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern/
	 *
	 * @since 1.0.0
	 */
	public function register_block_pattern(): void {
		register_block_pattern( $this->pattern_name, $this->pattern_properties );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the block pattern as a JSON string.
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
	 * Initializes the block pattern.
	 *
	 * Hooks the action to register the block pattern and adds the block pattern to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		BlockPatterns::add( $this );
	}
}
