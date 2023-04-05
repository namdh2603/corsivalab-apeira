<?php
/**
 *  Elite Licenser Activation Code
 */


class wpgs_license {
	/**
	 * @var mixed
	 */
	public $plugin_file = __FILE__;
	/**
	 * @var mixed
	 */
	public $responseObj;
	/**
	 * @var mixed
	 */
	public $licenseMessage;
	/**
	 * @var mixed
	 */
	public $showMessage = true;
	/**
	 * @var string
	 */
	public $slug = "twist";
	/**
	 * @var string
	 */
	public $slug_page = "codeixer-dashboard";
	public function __construct() {
		$licenseKey = ( cix_wpgs::option( 'purchse_key_ovrd' ) == 1 ) ? str_replace( ' ', '', cix_wpgs::option( 'purchse_key' ) ) : str_replace( ' ', '', get_option( "Twist_lic_Key", "" ) );
		$liceEmail  = get_option( "Twist_lic_email", "" );
		TwistBase::addOnDelete( function () {
			delete_option( "Twist_lic_Key" );
		} );
		add_filter( 'has_codeixer_pro', '__return_true' );
		if ( TwistBase::CheckWPPlugin( $licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, __FILE__ ) ) {
			add_action( 'admin_post_Twist_el_deactivate_license', [$this, 'action_deactivate_license'] );

			//Write you plugin's code here

			add_action( 'codeixer_license_data', [$this, 'Activated'] );
		} else {
			if ( !empty( $licenseKey ) && !empty( $this->licenseMessage ) ) {
				$this->showMessage = true;
			}
			update_option( "Twist_lic_Key", "" ) || add_option( "Twist_lic_Key", "" );
			add_action( 'admin_post_Twist_el_activate_license', [$this, 'action_activate_license'] );

			// codexier-lisence-active
			add_action( 'codeixer_license_form', [$this, 'LicenseForm'] );
			add_action( 'admin_notices', [$this, 'admin_notice'] );
		}
	}
	public function admin_notice() {
		?>
        <div class="notice notice-error codeixer-notice">

            <p><?php _e( ' Would you like to receive automatic updates, awesome support? Please', 'twist' );?> <a href="<?php echo admin_url( 'admin.php?page=codeixer-dashboard' ); ?>"><?php _e( 'activate your copy', 'twist' );?></a> <?php _e( 'of ', 'twist' );
		echo '<b>' . WPGS_NAME . '</b>';?> </p>

        </div>
       <?php
}

	public function action_activate_license() {
		check_admin_referer( 'el-license' );
		$licenseKey   = !empty( $_POST['el_license_key'] ) ? $_POST['el_license_key'] : "";
		$licenseEmail = !empty( $_POST['el_license_email'] ) ? $_POST['el_license_email'] : "";
		update_option( "Twist_lic_Key", $licenseKey ) || add_option( "Twist_lic_Key", $licenseKey );
		update_option( "Twist_lic_email", $licenseEmail ) || add_option( "Twist_lic_email", $licenseEmail );
		wp_safe_redirect( admin_url( 'admin.php?page=' . $this->slug_page ) );
	}
	public function action_deactivate_license() {
		check_admin_referer( 'el-license' );
		$message = "";
		if ( TwistBase::RemoveLicenseKey( __FILE__, $message ) ) {
			update_option( "Twist_lic_Key", "" ) || add_option( "Twist_lic_Key", "" );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=' . $this->slug_page ) );
	}
	public function Activated() {

		?>
        <div class="cix-card-active">
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="Twist_el_deactivate_license"/>
                <div class="el-license-container">
                      <h3> Activate <b>Product Gallery Slider for WooCommerce PRO</b> by entering your license key to get professional support and automatic update from your WordPress dashboard.</h3>


						<div class="el-license-field">
							<input type="text" class=" txt-disable" disabled value="<?php echo esc_attr( $this->responseObj->license_key ); ?>">
						</div>

                    <div class="el-license-active-btn deactivate-btn">
                        <?php wp_nonce_field( 'el-license' );?>
                        <?php submit_button( 'Deactivate License' );?>
                    </div>
                </div>
            </form>
            <div class="infobox">

				<div class="simpletext"><span><?php echo $this->responseObj->msg; ?></span></div>
			</div>
        </div>
    <?php }

	public function LicenseForm() {?>

        <div class="cix-card-active">
            <h3> Activate <b>Product Gallery Slider for WooCommerce PRO</b> by entering your license key to get professional support and automatic update from your WordPress dashboard.</h3>

            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="Twist_el_activate_license"/>
                <div class="el-license-container">

                <?php

		if ( !empty( $this->showMessage ) && !empty( $this->licenseMessage ) ) {
			?>
                    <div class="notice-error">
                            <p><?php echo _e( $this->licenseMessage, $this->slug ); ?></p>
                        </div>
                        <?php
        }?>

                    <div class="el-license-field">

                        <input type="text" class=" code" name="el_license_key" size="50" placeholder="Enter Purchase Code" required="required" >
						<a target="_blank" href="https://www.codeixer.com/docs/where-is-my-purchase-code/" class="href">Where Is My Purchase Code?</a>
                    </div>

                    <div class="el-license-active-btn">
                        <?php wp_nonce_field( 'el-license' );?>
                        <?php submit_button( 'Activate License' );?>
                    </div>
                </div>
            </form>

        </div>

    <?php }
}

new wpgs_license;

/* Elite Licenser Activation Code End */