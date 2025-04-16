<?php
/**
 * Block Pattern Category Module: BlockPatternCategory class
 *
 * Module for handling block pattern categories with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\BlockPatternCategories;

/**
 * BlockPatternCategory Module class.
 */
class BlockPatternCategory {

	/**
	 * Block pattern category name.
	 *
	 * @see $category_name
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/#parameters
	 *
	 * @since 1.0.0
	 * @var string Block pattern category name.
	 */
	private string $category_name;

	/**
	 * Block pattern category properties.
	 *
	 * @see $category_properties
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/#parameters
	 *
	 * @since 1.0.0
	 * @var array Block pattern category properties.
	 */
	private $category_properties;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the register_block_pattern_category method.
	 */
	private ActionHook $action_hook;

	/**
	 * Constructor.
	 *
	 * Constructs the BlockPatternCategory object by setting the category name, category properties, and action hook.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $category_name       Block pattern category name.
	 * @param array      $category_properties Block pattern category properties.
	 * @param ActionHook $action_hook         Optional. ActionHook instance. Default 'init'.
	 */
	public function __construct( string $category_name, $category_properties, ?ActionHook $action_hook = null ) {
		$this->category_name       = $category_name;
		$this->category_properties = $category_properties;
		$this->action_hook         = $action_hook ?? new ActionHook( 'init', array( $this, 'register_block_pattern_category' ) );
		$this->initialize();
	}

	/**
	 * Registers the block pattern category with WordPress.
	 *
	 * Uses the `register_block_pattern_category()` function to register the block pattern category.
	 *
	 * @see register_block_pattern_category()
	 * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 *
	 * @since 1.0.0
	 */
	public function register_block_pattern_category(): void {
		register_block_pattern_category( $this->category_name, $this->category_properties );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the block pattern category as a JSON string.
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
	 * Initializes the block pattern category.
	 *
	 * Hooks the action to register the block pattern category and adds the block pattern category to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook->add_action();
		BlockPatternCategories::add( $this );
	}
}
