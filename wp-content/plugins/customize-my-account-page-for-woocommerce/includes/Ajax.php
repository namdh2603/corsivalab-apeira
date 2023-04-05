<?php
/**
 * Settings page.
 *
 * @package ThemeGrill\WoocommerceCustomizer
 * @since 0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer;

defined( 'ABSPATH' ) || exit;

class Ajax {

	/**
	 * Ajax actions.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	private $actions;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialization.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	private function init() {
		$this->actions = apply_filters(
			'tgwc_ajax_actions',
			array(
				'tgwc_icon_list'        => array(
					'priv'   => array( $this, 'get_icon_list' ),
					'nopriv' => array( $this, 'get_icon_list' ),
				),
				'tgwc_avatar_upload'    => array(
					'priv'   => array( $this, 'handle_avatar_upload' ),
					'nopriv' => array( $this, 'handle_avatar_upload' ),
				),
				'tgwc_endpoints'        => array(
					'priv'   => array( $this, 'endpoints' ),
					'nopriv' => array( $this, 'endpoints' ),
				),
				'tgwc_customizer_reset' => array(
					'priv' => array( $this, 'reset' ),
				),
			)
		);

		$this->init_hooks();

		do_action( 'tgwc_ajax_unhook', $this );
	}

	/**
	 * Initialization hooks.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	private function init_hooks() {
		foreach ( $this->actions as $action => $callbacks ) {
			if ( isset( $callbacks['priv'] ) ) {
				add_action( "wp_ajax_{$action}", $callbacks['priv'] );
			}
			if ( isset( $callbacks['nopriv'] ) ) {
				add_action( "wp_ajax_nopriv_{$action}", $callbacks['nopriv'] );
			}
		}
	}

	/**
	 * Return icon list.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function get_icon_list() {
		wp_send_json( tgwc_get_icon_list(), 200 );
		die;
	}

	/**
	 * Handle upload avatar.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function handle_avatar_upload() {
		if ( ! is_user_logged_in() ) {
			wp_send_json_error(
				esc_html__( 'User is not logged in', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		if ( ! isset( $_POST['tgwc_avatar_upload_nonce'] ) ) {
			wp_send_json_error(
				esc_html__( 'Nonce is required', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		$avatar_upload_nonce = sanitize_text_field( $_POST['tgwc_avatar_upload_nonce'] );
		if ( ! wp_verify_nonce( $avatar_upload_nonce, 'tgwc_avatar_upload' ) ) {
			wp_send_json_error(
				esc_html__( 'Invalid nonce', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		// Get WordPress upload directory.
		$upload_dir = wp_upload_dir();

		// Remove the previous image.
		if ( isset( $_POST['previous_attach_id'] ) ) {
			$previous_attach_id = sanitize_text_field( $_POST['previous_attach_id'] );
			wp_delete_attachment( $previous_attach_id, true );
			update_user_meta( get_current_user_id(), 'tgwc_avatar_image', false );

			// Send the success message on deletion if only the the operation is deletion only.
			if ( empty( $_FILES ) ) {
				wp_send_json_success(
					esc_html__( 'File deleted successfully', 'customize-my-account-page-for-woocommerce' )
				);
			}
		}

		if ( ! isset( $_FILES['file']['name'] ) ) {
			wp_send_json_error(
				esc_html__( 'File is required', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Use only single file.
		if ( is_array( $_FILES['file']['name'] ) ) {
			$filenames = array_map( 'sanitize_file_name', $_FILES['file']['name'] );
			foreach ( $filenames as $index => $name ) {
				$_FILES['file'] = array(
					'name'     => isset( $_FILES['file']['name'][ $index ] ) ? sanitize_file_name( $_FILES['file']['name'][ $index ] ) : '',
					'type'     => isset( $_FILES['file']['type'][ $index ] ) ? sanitize_text_field( $_FILES['file']['type'][ $index ] ) : '',
					'tmp_name' => isset( $_FILES['file']['tmp_name'][ $index ] ) ? sanitize_file_name( $_FILES['file']['tmp_name'][ $index ] ) : '',
					'error'    => isset( $_FILES['file']['error'][ $index ] ) ? absint( $_FILES['file']['error'][ $index ] ) : '',
					'size'     => isset( $_FILES['file']['size'][ $index ] ) ? absint( $_FILES['file']['size'][ $index ] ) : 0,
				);
				break;
			}
		}

		// Return error message if the upload is not successfull.
		$error_message = \tgwc_get_upload_error_messages( absint( $_FILES['file']['error'] ) );
		if ( UPLOAD_ERR_OK !== $error_message ) {
			wp_send_json_error( $error_message, 400 );
		}

		// Return error message if the file size is bigger than the specified file size.
		$max_file_size = \tgwc_get_avatar_upload_size();
		if ( absint( $_FILES['file']['size'] ) > $max_file_size ) {
			wp_send_json_error( \tgwc_get_upload_error_messages( UPLOAD_ERR_INI_SIZE ), 400 );
		}

		// Handle the media upload.
		$move_file = wp_handle_upload(
			$_FILES['file'],
			array(
				'action' => 'tgwc_avatar_upload',
			)
		);

		// Bail early if the image is not saved successfully
		if ( ! isset( $move_file['file'] ) ) {
			wp_send_json_error(
				esc_html__( 'Something went wrong, try again', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		$filename         = $move_file['file'];
		$image_mime_types = apply_filters(
			'tgwc_image_upload_mime_types',
			array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'png'          => 'image/png',
			)
		);
		$filetype         = wp_check_filetype( basename( $filename ), $image_mime_types );

		// Bail early if the file is not a jpg or png image.
		if ( false === $filetype['ext'] || false === $filetype['type'] ) {
			wp_delete_file( $filename );
			wp_send_json_error(
				esc_html__( 'Invalid image mime type.', 'customize-my-account-page-for-woocommerce' ),
				400
			);
		}

		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $move_file['url'],
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		// Insert the attachment.
		$attach_id = wp_insert_attachment( $attachment, $filename );

		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once ABSPATH . 'wp-admin/includes/image.php';

		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// Update the user meta.
		update_user_meta( get_current_user_id(), 'tgwc_avatar_image', $attach_id );
		wp_send_json_success(
			array(
				'message'   => esc_html__( 'Uploaded successfully', 'customize-my-account-page-for-woocommerce' ),
				'attach_id' => $attach_id,
			)
		);
		die;
	}

	/**
	 * Return endpoints.
	 *
	 * @return void
	 */
	public function endpoints() {
		$endpoints = \tgwc_get_endpoints_by_type( 'endpoint' );
		$field     = isset( $_GET['field'] ) ? sanitize_text_field( $_GET['field'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( 'slug' === $field ) {
			$endpoints = array_keys( $endpoints );
		}

		if ( ! empty( $field ) ) {
			$endpoints = wp_list_pluck( $endpoints, $field );
		}

		wp_send_json_success( $endpoints );
	}

	/**
	 * Reset customize options.
	 *
	 * @return void
	 */
	public function reset() {
		check_ajax_referer( '_tgwc_customizer_reset', 'security' );

		$my_account_file = tgwc_get_my_account_file();
		$font_dir        = tgwc_get_font_directory();
		$font_files      = list_files( $font_dir );

		( file_exists( $font_dir ) && false !== $font_files ) && array_map( 'unlink', $font_files );
		file_exists( $my_account_file ) && unlink( $my_account_file );
		delete_option( 'tgwc_customize' );
		wp_send_json_success();
	}
}
