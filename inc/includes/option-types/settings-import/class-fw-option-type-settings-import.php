<?php

class FW_Option_Type_Settings_Import extends FW_Option_Type {
	private $option_type = 'settings-import';

	public function get_type() {
		return $this->option_type;
	}

	/**
	 * @internal
	 */
	protected function _enqueue_static( $id, $option, $data ) {

		$uri = get_template_directory_uri() .'/inc/includes/option-types/'. $this->get_type() .'/static';

		wp_enqueue_style(
			'fw-option-' . $this->get_type(),
			$uri . '/css/styles.css'
		);

		wp_enqueue_script(
			'fw-option-' . $this->get_type(),
			$uri . '/js/scripts.js',
			array( 'fw' ),
			'',
			true
		);

		wp_add_inline_script(
		  'fw-option-' . $this->get_type(),
		  'var fwAjaxUrl = ' . json_encode(admin_url('admin-ajax.php', 'relative')),
		  'before'
		);

		wp_add_inline_script(
			'fw-option-' . $this->get_type(),
			'var fw_import_id = "' . $id . '"',
			'before'
		);

	}

	/**
	 * @param string $id
	 * @param array $option
	 * @param array $data
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {

		return fw_render_view( dirname(__FILE__) . '/view.php', array(
			'import' 		=> $this,
			'id'            => $id,
			'option'        => $option,
			'data'          => $data,
			'defaults'      => $this->get_defaults()
		) );

	}

	/**
	 * @param array $option
	 * @param array|null|string $input_value
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {
		return (string) ( is_null( $input_value ) ? $option['value'] : $input_value );
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {
		return array(
			'value' => ''
		);
	}

	/**
	 * @internal
	 */
	public static function _action_ajax_options_import(){

		if ( empty( $_POST['type'] ) || empty ( $_POST['data'] ) ) {
			wp_send_json_error( 
				array(
					'message' => 'Invalid input data for import options'
				)
			);
			exit;
		}

		$data = $_POST['data'];

		if ( $_POST['type'] == 'url' ) {

			$args = array(
			    'timeout'     => 5,
			    'redirection' => 5,
			    'httpversion' => '1.0',
			    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
			    'blocking'    => true,
			    'headers'     => array(),
			    'cookies'     => array(),
			    'body'        => null,
			    'compress'    => false,
			    'decompress'  => true,
			    'sslverify'   => true,
			    'stream'      => false,
			    'filename'    => null
			);

			$data = wp_remote_get( $data, $args );

			$data = wp_remote_retrieve_body( $data );

		}

		try {

			if ( base64_decode( $data, true ) != false ) {

				$data = base64_decode( $data );

				$data = json_decode( $data, true );

				if ( !empty ( $data ) && json_last_error() == JSON_ERROR_NONE ) {

					update_option( 'fw_theme_settings_options:'. fw()->theme->manifest->get_id(), $data );

					wp_send_json_success( 
						array(
							'values' => 'import successfully'
						)
					);

					exit;

				}

			}

		} catch (Exception $e) {
			
		}

		wp_send_json_error( 
			array(
				'message' => 'Invalid input data for import options'
			)
		);
		exit;
	}
}

add_action('wp_ajax_fw_backend_options_import', array('FW_Option_Type_Settings_Import', '_action_ajax_options_import'));
add_action('wp_ajax_nopriv_fw_backend_options_import', array('FW_Option_Type_Settings_Import', '_action_ajax_options_import'));

FW_Option_Type::register( 'FW_Option_Type_Settings_Import' );