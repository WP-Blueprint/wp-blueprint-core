<?php
/**
 * Meta Box Module: MetaBox class
 *
 * Module for handling meta boxes with WordPress.
 *
 * @link URL
 *
 * @package WPBlueprint\Core
 * @subpackage Module
 * @since 1.0.0
 */

namespace WPBlueprint\Core\Modules;

use WPBlueprint\Core\Registry\MetaBoxes;

/**
 * MetaBox Module class.
 */
class MetaBox {

	/**
	 * Meta box ID.
	 *
	 * @see $id
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var string Meta box ID. Must be unique.
	 */
	private string $id;

	/**
	 * Meta box title.
	 *
	 * @see $title
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var string Meta box title.
	 */
	private string $title;

	/**
	 * Meta box callback.
	 *
	 * @see $callback
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var callable Meta box callback. Defaults to internal rendering method if not provided.
	 */
	private $callback;

	/**
	 * Meta box screen.
	 *
	 * @see $screen
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var string Meta box screen.
	 */
	private $screen;

	/**
	 * Meta box context.
	 *
	 * @see $context
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var string Meta box context.
	 */
	private string $context;

	/**
	 * Meta box priority.
	 *
	 * @see $priority
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var string Meta box priority.
	 */
	private string $priority;

	/**
	 * Meta box callback arguments.
	 *
	 * @see $callback_args
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/#parameters
	 *
	 * @since 1.0.0
	 * @var array Meta box callback arguments.
	 */
	private $callback_args;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the add_meta_box method.
	 */
	private ActionHook $action_hook_add;

	/**
	 * ActionHook instance.
	 *
	 * @since 1.0.0
	 * @var ActionHook ActionHook object for the save_post method.
	 */
	private ActionHook $action_hook_save;

	/**
	 * Constructor.
	 *
	 * Initializes a MetaBox object with specified properties. If no callback is provided,
	 * defaults to using the `render_post_meta_box` method.
	 *
	 * @param string        $id             Meta box ID. Must be unique.
	 * @param string        $title          Meta box title.
	 * @param callable|null $callback       Optional. Meta box callback. Defaults to internal render method.
	 * @param string|null   $screen         Optional. Meta box screen. Default null.
	 * @param string        $context        Optional. Meta box context. Default 'advanced'.
	 * @param string        $priority       Optional. Meta box priority. Default 'default'.
	 * @param array|null    $callback_args  Optional. Meta box callback arguments. Default null.
	 * @param ActionHook    $action_hook_add Optional. ActionHook instance for the add_meta_box method. Default 'add_meta_boxes'.
	 * @param ActionHook    $action_hook_save Optional. ActionHook instance for the save_post method. Default 'save_post'.
	 */
	public function __construct( string $id, string $title, $callback = null, $screen = null, string $context = 'advanced', string $priority = 'default', $callback_args = null, ?ActionHook $action_hook_add = null, ?ActionHook $action_hook_save = null ) {
		$this->id               = $id;
		$this->title            = $title;
		$this->callback         = $callback ?? [ $this, 'render_post_meta_box' ];
		$this->screen           = $screen;
		$this->context          = $context;
		$this->priority         = $priority;
		$this->callback_args    = $callback_args;
		$this->action_hook_add  = $action_hook_add ?? new ActionHook( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		$this->action_hook_save = $action_hook_save ?? new ActionHook( 'save_post', [ $this, 'update_post_meta' ] );
		$this->initialize();
	}

	/**
	 * Adds the meta box to WordPress.
	 *
	 * Uses the `add_meta_box()` function to add the meta box to WordPress.
	 *
	 * @see add_meta_box()
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
	 *
	 * @since 1.0.0
	 */
	public function add_meta_box() {
			add_meta_box(
				$this->id,
				$this->title,
				$this->callback,
				$this->screen,
				$this->context,
				$this->priority,
				$this->callback_args
			);
	}

	/**
	 * Default callback for rendering the meta box content.
	 *
	 * Displays the meta box using custom fields defined in the callback arguments.
	 *
	 * @param \WP_Post $post Post object.
	 * @param array    $args Additional arguments including 'id' and 'field_type'.
	 */
	public function render_post_meta_box( $post, $args ) {
		$field_id    = $args['id'];
		$field_value = get_post_meta( $post->ID, $field_id, true );
		$field_type  = $args['field_type'] ?? 'text';

		// Add the nonce field to the form.
		wp_nonce_field( 'custom_post_meta_nonce_action', 'custom_post_meta_nonce' );

		switch ( $field_type ) {
			case 'text':
				echo '<input type="text" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '">';
				break;
			case 'textarea':
				echo '<textarea id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</textarea>';
				break;
			case 'url':
				echo '<input type="url" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '">';
				break;
			// Add more field types as needed.
		}
	}

	/**
	 * Updates the post meta.
	 *
	 * Updates the post meta with the specified field ID and field value.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post ID.
	 */
	public function update_post_meta( $post_id ) {
		// Verify the nonce. Assuming the nonce field is named 'custom_post_meta_nonce' as shown in render_post_meta_box method.
		if ( ! isset( $_POST['custom_post_meta_nonce'] ) || ! wp_verify_nonce( $_POST['custom_post_meta_nonce'], 'custom_post_meta_nonce_action' ) ) {
			return;
		}

		// Check user permission.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Assuming $_POST[$this->id] is where our meta value is stored. This key should match your form field's name attribute.
		$field_value = isset( $_POST[ $this->id ] ) ? sanitize_text_field( $_POST[ $this->id ] ) : '';

		// Update the post meta.
		update_post_meta( $post_id, $this->id, $field_value );
	}

	/**
	 * Custom toString magic method.
	 *
	 * Returns the meta box as a JSON string.
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
	 * Initializes the meta box.
	 *
	 * Hooks the action to register the meta box and adds the meta box to the registry.
	 *
	 * @since 1.0.0
	 */
	private function initialize(): void {
		$this->action_hook_add->add_action();
		$this->action_hook_save->add_action();
		MetaBoxes::add( $this );
	}
}
