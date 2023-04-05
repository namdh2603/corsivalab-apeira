<?php
/**
 * Customize API: ButtonSet control class
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Controls
 * @since   0.1.0
 */

 namespace ThemeGrill\WoocommerceCustomizer\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

/**
 * Customize ButtonSet Control class.
 *
 * @see WP_Customize_Control
 */
class ButtonSet extends \WP_Customize_Control {

	/**
	 * Type.
	 *
	 * @var string
	 */
	public $type = 'tgwc-buttonset';

	/**
	 * Display Label param.
	 *
	 * @var bool
	 */
	public $display_label = false;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['default']       = $this->setting->default;
		$this->json['id']            = $this->id;
		$this->json['value']         = $this->value();
		$this->json['link']          = $this->get_link();
		$this->json['choices']       = $this->choices;
		$this->json['display_label'] = $this->display_label;

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {}

	/**
	 * Render a JS template for control display.
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	protected function content_template() {
		?>
		<label>
			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><#
			} #>
		</label>
		<div class="buttonset-wrap">
			<# Object.keys( data.choices ).forEach( function( key ) { #>
				<input id="buttonset-wrap-{{{data.id}}}-{{{key}}}" type="radio" name="buttonset-wrap-{{{data.id}}}" value = "{{{key}}}" {{{data.link}}} {{{ (data.value === key)? 'checked="checked"' : '' }}} />
				<label class="buttonset-label" title="{{{data.choices[key].name}}}" for="buttonset-wrap-{{{data.id}}}-{{{key}}}">{{{data.choices[key].name}}}</label>
			<# } ); #>
			</div>
		<?php
	}
}
