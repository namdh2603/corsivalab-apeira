<?php
/**
 * Class to manage redeeming rules
 *
 * @class   YITH_WC_Points_Rewards_Editor_Redeeming_Rules
 * @since   2.2.0
 * @author  YITH
 * @package YITH WooCommerce Points and Rewards
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'YITH_WC_Points_Rewards_Editor', false ) ) {
	include_once YITH_YWPAR_INC . '/admin/cpt/abstract-class-yith-wc-points-rewards-editor.php';
}

if ( ! class_exists( 'YITH_WC_Points_Rewards_Editor_Redeeming_Rules' ) ) {

	/**
	 * Class YITH_WC_Points_Rewards_Editor_Redeeming_Rules
	 */
	class YITH_WC_Points_Rewards_Editor_Redeeming_Rules extends YITH_WC_Points_Rewards_Editor {

		/**
		 * Single instance of the class
		 *
		 * @var YITH_WC_Points_Rewards_Editor_Redeeming_Rules
		 */
		protected static $instance;

		/**
		 *  Post type name
		 *
		 * @var string
		 */
		public $post_type = '';

		/**
		 * Returns single instance of the class
		 *
		 * @return YITH_WC_Points_Rewards_Editor_Redeeming_Rules
		 * @since  1.0.0
		 */
		public static function get_instance() {
			return ! is_null( self::$instance ) ? self::$instance : self::$instance = new self();

		}

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$this->post_type = YITH_WC_Points_Rewards_Post_Types::$redeeming_rule;
			$this->options   = include_once YITH_YWPAR_DIR . 'plugin-options/metaboxes/points-redeeming-rules-options.php';

			add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
			add_action( 'save_post', array( $this, 'save_post' ), 1, 2 );

			parent::__construct();
			add_action( 'admin_menu', array( $this, 'remove_publish_box' ) );
			add_filter( 'views_edit-' . $this->post_type, array( $this, 'add_description' ) );
		}

		/**
		 * Change the post message
		 *
		 * @param array $messages List of messages.
		 *
		 * @return array
		 */
		public function change_post_update_message( $messages ) {
			global $post;
			if ( $post && $this->post_type === $post->post_type ) {
				$messages['post'][1] = _x( 'Rule updated', 'Message that appears when a post is updated', 'yith-woocommerce-points-and-rewards' );
				$messages['post'][6] = _x( 'Rule published', 'Message that appears when a post is published', 'yith-woocommerce-points-and-rewards' );
			}
			return $messages;
		}

		/**
		 * Change the bulk post message
		 *
		 * @param array $messages List of messages.
		 * @param array $bulk_counts List of bulk counts.
		 *
		 * @return array
		 */
		public function change_bulk_post_updated_messages( $messages, $bulk_counts ) {
			global $post;

			if ( $post && $this->post_type === $post->post_type ) {
				$messages['post']['deleted'] = _n( '%s rule permanently deleted.', '%s rules permanently deleted.', $bulk_counts['deleted'], 'yith-woocommerce-points-and-rewards' );
			}
			return $messages;
		}

		/**
		 * Add a description under the title of wp list
		 *
		 * @param array $views Views.
		 *
		 * @return array;
		 */
		public function add_description( $views ) {

			if ( ! $this->is_empty_list() ) {
				// translators:Description of Points Rules. Placeholder are tag html.
				$description = sprintf( _x( 'Please note: rules applied to products have a higher priority by default. %1$sRead the documentation to better understand how rules work >%2$s', 'Description of Points Rules. Placeholder are tag html.', 'yith-woocommerce-points-and-rewards' ), '<a href="https://docs.yithemes.com/yith-woocommerce-points-and-rewards/premium-version-settings/redeem-options/redeem-rules/">', '</a>' );

				printf( '<p class="post-type-description">%s</p>', wp_kses_post( $description ) );
			}

			return $views;
		}


		/**
		 * Set custom columns
		 *
		 * @param array $columns Existing columns.
		 * @return  array
		 * @since   2.2.0
		 * @author  Armando Liccardo <armando.liccardo@yithemes.com>
		 */
		public function set_custom_columns( $columns ) {

			$columns = array(
				'cb'     => '<input type="checkbox" />',
				'title'  => esc_html__( 'Rule name', 'yith-woocommerce-points-and-rewards' ),
				'status' => esc_html__( 'Active', 'yith-woocommerce-points-and-rewards' ),
				'action' => '',
			);

			return $columns;

		}

		/**
		 * Return the all action row
		 *
		 * @param int $post_id Post id.
		 * @return array
		 */
		public function get_all_actions( $post_id ) {
			$duplicate_link  = add_query_arg(
				array(
					'action'            => 'yith_ywpar_duplicate_redeeming_rule',
					'redeeming_rule_id' => $post_id,
					'duplicate_nonce'   => wp_create_nonce( 'yith_ywpar_duplicate_redeeming_rule' ),
				),
				admin_url()
			);
			$actions         = array();
			$default_actions = yith_plugin_fw_get_default_post_actions( $post_id );
			foreach ( $default_actions as $key => $action ) {
				$actions[ $key ] = $action;
				if ( 'edit' === $key ) {
					$actions['clone'] = array(
						'type'   => 'action-button',
						'action' => 'duplicate',
						'title'  => esc_html__( 'Duplicate', 'yith-woocommerce-points-and-rewards' ),
						'icon'   => 'clone',
						'url'    => $duplicate_link,
					);
					$actions['drag']  = array(
						'type'   => 'action-button',
						'action' => 'drag',
						'title'  => esc_html__( 'Move', 'yith-woocommerce-points-and-rewards' ),
						'icon'   => 'drag',
						'url'    => '#',
					);
				}
			}
			unset( $actions['trash'] );
			if ( current_user_can( 'delete_post', $post_id ) ) {
				$title             = _draft_or_post_title( $post_id );
				$actions['delete'] = array(
					'type'         => 'action-button',
					'title'        => _x( 'Delete', 'Post action', 'yith-woocommerce-points-and-rewards' ),
					'action'       => 'delete',
					'icon'         => 'trash',
					'url'          => get_delete_post_link( $post_id, '', true ),
					'confirm_data' => array(
						'title'               => __( 'Confirm delete', 'yith-woocommerce-points-and-rewards' ),
						// translators: %s is the title of the post object.
						'message'             => sprintf( __( 'Are you sure you want to delete "%s"?', 'yith-woocommerce-points-and-rewards' ), '<strong>' . $title . '</strong>' ) . '<br /><br />' . __( 'This action cannot be undone and you will not be able to recover this data.', 'yith-woocommerce-points-and-rewards' ),
						'cancel-button'       => __( 'No', 'yith-woocommerce-points-and-rewards' ),
						'confirm-button'      => _x( 'Yes, delete', 'Delete confirmation action', 'yith-woocommerce-points-and-rewards' ),
						'confirm-button-type' => 'delete',
					),
				);
			}
			return $actions;
		}


		/**
		 * Manage custom columns
		 *
		 * @param string $column Current column.
		 * @param int    $post_id Post ID.
		 *
		 * @since   2.2.0
		 * @author  Armando Liccardo <armando.liccardo@yithemes.com>
		 */
		public function render_custom_columns( $column, $post_id ) {

			$rule = ywpar_get_redeeming_rule( $post_id );
			if ( 'action' === $column ) {
				return yith_plugin_fw_get_action_buttons( $this->get_all_actions( $post_id ), true );
			}

			/* status column */
			if ( 'status' === $column ) {
				echo '<div class="yith-plugin-ui" data-id="' . esc_attr( $post_id ) . '" data-nonce="' . esc_attr( wp_create_nonce( 'ywpar-redeeming-rule-status' ) ) . '">';
				$field = array(
					'id'    => 'ywpar_rule_status',
					'name'  => 'status',
					'class' => 'ywpar-rule-redeeming-status',
					'type'  => 'onoff',
					'title' => '',
					'value' => 'on' === $rule->get_status() ? 'yes' : 'no',
				);
				yith_plugin_fw_get_field( $field, true );
				echo '</div>';
			}
		}

		/**
		 * Return the back to list button label.
		 *
		 * @return string
		 */
		protected function get_back_button_list_label() {
			return esc_html__( 'back to rule list', 'yith-woocommerce-points-and-rewards' );
		}


		/**
		 * The function to be called to output the meta box in redeeming Rule detail/edit page.
		 *
		 * @param WP_Post $post The Post object.
		 *
		 * @return  void
		 * @since   2.2.0
		 * @author  Armando Liccardo <armando.liccardo@yithemes.com>
		 */
		public function option_metabox( $post ) {

			wp_nonce_field( 'ywpar_redeeming_rule_save_data', 'ywpar_redeeming_rule_meta_nonce' );

			$values = array();

			/* getting previous saved settings */
			if ( 'auto-draft' !== $post->post_status ) {
				$obj      = ywpar_get_redeeming_rule( $post->ID );
				$obj_data = $obj->get_data();
			}

			$options = $this->options; ?>
			<div class="ywpar-metabox-wrapper">
				<div class="yith-plugin-ui yith-plugin-fw">
					<table class="form-table">
						<?php
						foreach ( $options as $field ) :
							if ( ! isset( $field['value'] ) ) {
								$field['value'] = isset( $obj_data[ $field['name'] ] ) ? $obj_data[ $field['name'] ] : $field['std'];
							}

							$custom_attributes = ywpar_get_custom_attributes_of_custom_field( $field );
							?>
							<tr valign="top"
								class="yith-plugin-fw-panel-wc-row <?php echo esc_attr( $field['type'] ); ?> <?php echo esc_attr( $field['id'] ); ?>" <?php echo wp_kses_post( $custom_attributes ); ?>>
								<th scope="row" class="titledesc">
									<label
										for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo esc_attr( $field['title'] ); ?></label>
								</th>
								<td class="forminp forminp-<?php echo esc_attr( $field['type'] ); ?>">
									<?php yith_plugin_fw_get_field( $field, true ); ?>
									<?php if ( isset( $field['desc'] ) ) : ?>
										<span class="description"><?php echo wp_kses_post( $field['desc'] ); ?></span>
									<?php endif; ?>
								</td>
							</tr>

						<?php endforeach; ?>
					</table>
					<div id="submitpost" class="yith-plugin-ui">
						<?php

						$getted = $_GET; //phpcs:ignore WordPress.Security.NonceVerification.Recommended

						if ( 'auto-draft' !== $post->post_status ) {
							$name   = 'save';
							$label  = esc_html__( 'Update', 'yith-woocommerce-points-and-rewards' );
							$delete = sprintf( ' <a href="%s" class="button-secondary button-xl">%s</a>', get_delete_post_link( $getted['post'] ), esc_html__( 'Delete', 'yith-woocommerce-points-and-rewards' ) );
						} else {
							$name   = 'publish';
							$label  = esc_html__( 'Save Rule', 'yith-woocommerce-points-and-rewards' );
							$delete = '';
						}

						echo sprintf( '<input name="%s" type="submit" class="button button-primary button-xl" id="publish" value="%s" />', $name, $label ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $delete; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Save meta box process
		 *
		 * @param integer $post_id The Post ID.
		 * @param WP_Post $post The Post object.
		 *
		 * @return  void
		 * @since   2.2.0
		 * @author  Armando Liccardo <armando.liccardo@yithemes.com>
		 */
		public function save_post( $post_id, $post ) {

			// $post_id and $post are required.
			if ( empty( $post_id ) || empty( $post ) || $this->saved_meta_box ) {
				return;
			}

			// Check the nonce.
			if ( empty( $_POST['ywpar_redeeming_rule_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ywpar_redeeming_rule_meta_nonce'] ) ), 'ywpar_redeeming_rule_save_data' ) ) {
				return;
			}

			$posted = $_POST;

			// Don't save meta boxes for revisions or autosaves.
			if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
				return;
			}

			// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
			if ( empty( $posted['post_ID'] ) || (int)$posted['post_ID'] !== $post_id ) {
				return;
			}

			// Check user has permission to edit.
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			$this->saved_meta_box = true;
			$obj                  = ywpar_get_redeeming_rule( $post_id );
			$obj_data             = $obj->get_data();
			$changes              = array();
			foreach ( $obj_data as $key => $value ) {
				if ( 'name' === $key && isset( $posted[ $key ] ) ) {
					wp_update_post(
						array(
							'ID'         => $post_id,
							'post_title' => $posted[ $key ],
						)
					);
				}

				if ( isset( $posted[ $key ] ) ) {
					$changes[ $key ] = $posted[ $key ];
				} elseif ( 'id' !== $key && 'yes' === $obj_data[ $key ] ) {
					$changes[ $key ] = 'no';
				}

				if ( ! isset( $posted['user_roles_list'] ) ) {
					$changes['user_roles_list'] = array();
				}
				
				if ( ! isset( $posted['user_type'] ) ) {
					$changes['user_type'] = array();
				}
			}

			$obj->set_props( $changes );
			$obj->save();
		}

		/**
		 * Retrieve an array of parameters for blank state.
		 *
		 * @return array
		 */
		protected function get_blank_state_params() {
			return array(
				'type'     => 'list-table-blank-state',
				'icon_url' => YITH_YWPAR_ASSETS_URL . '/images/empty-redeem.svg',
				// translators: placeholder is an html tag.
				'message'  => sprintf( esc_html_x( 'You have no redeeming rules created yet.%1$sCreate now your first one!', 'placeholder is an html tag', 'yith-woocommerce-points-and-rewards' ), '<br>' ),
				'cta'      => array(
					'title' => esc_html__( 'Create rule', 'yith-woocommerce-points-and-rewards' ),
					'icon'  => '',
					'url'   => admin_url( 'post-new.php?post_type=' . $this->post_type ),
				),
			);
		}
	}
}
