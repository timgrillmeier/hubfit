<?php
/**
 * Created
 * User: alan
 * Date: 04/04/18
 * Time: 13:45
 */

namespace Stop_User_Enumeration\Admin;


class Admin_Settings extends Admin_Pages {

	protected $settings_page;
	// protected $settings_page_id = 'toplevel_page_stop-user-enumeration';  // top level
	protected $settings_page_id = 'settings_page_stop-user-enumeration';
	protected $option_group = 'stop-user-enumeration';
	protected $settings_title;

	/**
	 * Settings constructor.
	 *
	 * @param string $plugin_name
	 * @param string $version plugin version.
	 * @param \Freemius $freemius Freemius SDK.
	 */

	public function __construct( $plugin_name, $version, $freemius ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->freemius    = $freemius;


		$this->settings_title = esc_html__( 'Stop User Enumeration', 'stop-user-enumeration' );
		parent::__construct();
	}

	public function register_settings() {
		/* Register our setting. */
		register_setting(
			$this->option_group,                         /* Option Group */
			'stop-user-enumeration',                   /* Option Name */
			array( $this, 'sanitize_settings' )          /* Sanitize Callback */
		);


		/* Add settings menu page */
		$this->settings_page = add_submenu_page(
			'stop-user-enumeration',
			'Settings', /* Page Title */
			'Settings',                       /* Menu Title */
			'manage_options',                 /* Capability */
			'stop-user-enumeration',                         /* Page Slug */
			array( $this, 'settings_page' )          /* Settings Page Function Callback */
		);

		register_setting(
			$this->option_group,                         /* Option Group */
			"{$this->option_group}-reset",                   /* Option Name */
			array( $this, 'reset_sanitize' )          /* Sanitize Callback */
		);

	}


	public function delete_options() {
		update_option( 'stop-user-enumeration', self::option_defaults( 'stop-user-enumeration' ) );

	}

	public static function option_defaults( $option ) {
		switch ( $option ) {
			case 'stop-user-enumeration':
				return array(
					// set defaults
					'stop_rest_user' => 'on',
					'log_auth'       => 'on',
					'comment_jquery' => 'on',
				);
			default:
				return false;
		}
	}

	public function add_meta_boxes() {
		add_meta_box(
			'settings-1',                  /* Meta Box ID */
			esc_html__( 'Information', 'stop-user-enumeration' ),               /* Title */
			array( $this, 'meta_box_information' ),  /* Function Callback */
			$this->settings_page_id,               /* Screen: Our Settings Page */
			'normal',                 /* Context */
			'default'                 /* Priority */
		);
		add_meta_box(
			'settings-2',                  /* Meta Box ID */
			__( 'Options', 'stop-user-enumeration' ),               /* Title */
			array( $this, 'meta_box_options' ),  /* Function Callback */
			$this->settings_page_id,               /* Screen: Our Settings Page */
			'normal',                 /* Context */
			'default'                 /* Priority */
		);


	}

	public function meta_box_information() {
		?>
        <table class="form-table">
            <tbody>
            <tr valign="top" class="alternate">
                <th scope="row"><?php _e( 'About this Plugin', 'stop-user-enumeration' ); ?></th>
                <td>
					<?php _e( '<p>Stop User Enumeration detects attempts by malicious scanners to identify your users</p>
                    <p>If a bot or user is caught scanning for user names they are denied access and their IP is
                        logged</p>
                    <p>When you are viewing an admin page, the plugin does nothing, this is designed this way as it is
                        assumed admin user have authority, bear this in mind when testing.</p><br>
                    <p>This plugin is best used in conjunction with a blocking tool to exclude the IP for longer. If you
                        are on a VPS or dedicated server where you have root access you can install and configure <a
                                href="https://www.fail2ban.org" target="_blank">fail2ban</a></p>', 'stop-user-enumeration' ); ?>
                </td>
            </tr>
                <tr valign="top">
                <th scope="row"><?php _e( 'Support', 'stop-user-enumeration' ); ?></th>
                <td>
		            <?php _e( '<a class="button-secondary"
                                href="https://wordpress.org/support/plugin/stop-user-enumeration/" target="_blank">WordPress.org support forum</a>', 'stop-user-enumeration' ); ?>
                </td>
            </tr>
            </tbody>
        </table>
		<?php
	}

	public function sanitize_settings( $settings ) {
		if ( ! isset( $settings['stop_rest_user'] ) ) {
			$settings['stop_rest_user'] = 'off';  // always set checkboxes if they dont exist
		}
		if ( ! isset( $settings['log_auth'] ) ) {
			$settings['log_auth'] = 'off';  // always set checkboxes if they dont exist
		}
		if ( ! isset( $settings['comment_jquery'] ) ) {
			$settings['comment_jquery'] = 'off';  // always set checkboxes if they dont exist
		}

		return $settings;
	}


	public function meta_box_options() {
		?>
		<?php
		$options = get_option( 'stop-user-enumeration' );
		if ( ! isset( $options['stop_rest_user'] ) ) {
			$options['stop_rest_user'] = 'off';
		}
		if ( ! isset( $options['log_auth'] ) ) {
			$options['log_auth'] = 'off';
		}
		if ( ! isset( $options['comment_jquery'] ) ) {
			$options['comment_jquery'] = 'off';
		}
		?>
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Stop REST API User calls', 'stop-user-enumeration' ); ?></th>
                <td>
                    <label for="stop-user-enumeration[stop_rest_user]"><input type="checkbox"
                                                                              name="stop-user-enumeration[stop_rest_user]]"
                                                                              id="stop-user-enumeration[stop_rest_user]"
                                                                              value="on"
							<?php checked( 'on', $options['stop_rest_user'] ); ?>>
						<?php _e( 'WordPress allows anyone to find users by API call, by checking this box the calls will be restricted to logged in users only. Only untick this box if you need to allow unfettered API access to users', 'stop-user-enumeration' ); ?>
                    </label>
                </td>
            </tr>
            <tr valign="top" class="alternate">
                <th scope="row"><?php esc_html_e( 'log attempts to AUTH LOG', 'stop-user-enumeration' ); ?></th>
                <td>
                    <label for="stop-user-enumeration[log_auth]"><input type="checkbox"
                                                                        name="stop-user-enumeration[log_auth]]"
                                                                        id="stop-user-enumeration[log_auth]"
                                                                        value="on"
							<?php checked( 'on', $options['log_auth'] ); ?>>
						<?php printf( esc_html__( 'Leave this ticked if you are using %1$sFail2Ban%2$s on your VPS to block attempts at enumeration.%3$s If you are not running Fail2Ban or on a shared host this does not need to be ticked, however it normally will not cause a problem being ticked.'
							, 'stop-user-enumeration' ),
							'<a href="http://www.fail2ban.org/wiki/index.php/Main_Page" target="_blank">', '</a>', '<br>' ); ?>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Remove numbers from comment authors', 'stop-user-enumeration' ); ?></th>
                <td>
                    <label for="stop-user-enumeration[comment_jquery]"><input type="checkbox"
                                                                              name="stop-user-enumeration[comment_jquery]]"
                                                                              id="stop-user-enumeration[comment_jquery]"
                                                                              value="on"
							<?php checked( 'on', $options['comment_jquery'] ); ?>>
						<?php esc_html_e( 'This plugin uses jQuery to remove any numbers from a comment author name, this is because numbers trigger enumeration checking. You can untick this if you do not use comments on your site or you use a different comment method than standard',
							'stop-user-enumeration' ); ?></label>
                </td>
            </tr>


            </tbody>
        </table>
		<?php
	}


}

