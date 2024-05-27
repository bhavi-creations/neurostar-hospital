<?php

/**
 * Plugin Name: Sky Addons Pro for Elementor
 * Plugin URI: https://skyaddons.com/
 * Description: <a href="https://skyaddons.com/">Sky Addons Pro</a> for Elementor has many Widgets and Extensions to improve the functionality of your websites. With one-click installs, you can create beautiful, mobile-ready sites in minutes with no hassle.
 * Version: 1.5.7
 * Author: Techfyd
 * Author URI: https://techfyd.com/
 * Text Domain: sky-elementor-addons-pro
 * Domain Path: /languages/
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.16.4
 * 
 * @package Sky_Addons_Pro
 */

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

define( 'SKY_ADDONS_PRO_VERSION', '1.5.7' );

/**
 * Required free version
 */
define( 'SKY_ADDONS_CORE_REQUIRED_VERSION', '2.1.0' );

define( 'SKY_ADDONS_PRO__FILE__', __FILE__ );
define( 'SKY_ADDONS_PRO_PLUGIN_BASE', plugin_basename( SKY_ADDONS_PRO__FILE__ ) );
define( 'SKY_ADDONS_PRO_PATH', plugin_dir_path( SKY_ADDONS_PRO__FILE__ ) );
define( 'SKY_ADDONS_PRO_MODULES_PATH', SKY_ADDONS_PRO_PATH . 'modules/' );
define( 'SKY_ADDONS_PRO_URL', plugins_url( '/', SKY_ADDONS_PRO__FILE__ ) );
define( 'SKY_ADDONS_PRO_ASSETS_URL', SKY_ADDONS_PRO_URL . 'assets/' );
define( 'SKY_ADDONS_PRO_MODULES_URL', SKY_ADDONS_PRO_URL . 'modules/' );
define( 'SKY_ADDONS_PRO_PATH_NAME', basename( dirname( SKY_ADDONS_PRO__FILE__ ) ) );

/**
 * Load gettext translate for our text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sky_addons_pro_load_plugin() {
	load_plugin_textdomain( 'sky-elementor-addons-pro', false, SKY_ADDONS_PRO_PATH_NAME . '/languages' );

	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'sky_addons_pro_fail_load' );
		return;
	}

	$elementor_version_required = '3.0.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'sky_addons_pro_fail_load_out_of_date' );
		return;
	}
}

add_action( 'plugins_loaded', 'sky_addons_pro_load_plugin' );

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sky_addons_pro_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	if ( _is_elementor_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

		$message = '<p>' . esc_html__( 'Sky Addons for Elementor is not working because you need to activate the Elementor plugin.', 'sky-elementor-addons-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'sky-elementor-addons-pro' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

		$message = '<p>' . esc_html__( 'Sky Addons for Elementor is not working because you need to install the Elemenor plugin', 'sky-elementor-addons-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'sky-elementor-addons-pro' ) ) . '</p>';
	}

	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Warning Elementor Old Version
 *
 * @since 1.0.0
 *
 * @return void
 */
function sky_addons_pro_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message      = '<p>' . esc_html__( 'Sky Addons for Elementor is not working because you are using an old version of Elementor.', 'sky-elementor-addons-pro' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update Elementor Now', 'sky-elementor-addons-pro' ) ) . '</p>';

	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Check Elementor Installed or not
 *
 * @since 1.0.0
 *
 */
if ( ! function_exists( '_is_elementor_installed' ) ) {

	function _is_elementor_installed() {
		$file_path         = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}

/**
 * Do stuff upon plugin activation
 *
 * @since 1.0.0
 *
 * @return void
 */
function sky_addon_pro_activate() {
	$installed     = get_option( 'sky_addons_pro_installed' );
	$first_version = get_option( 'sky_addons_pro_first_version' );

	if ( ! $installed ) {
		update_option( 'sky_addons_pro_installed', time() );
	}

	if ( ! $first_version ) {
		update_option( 'sky_addons_pro_first_version', SKY_ADDONS_PRO_VERSION );
	}

	update_option( 'sky_addons_pro_version', SKY_ADDONS_PRO_VERSION );
}


register_activation_hook( SKY_ADDONS_PRO__FILE__, 'sky_addon_pro_activate' );


/**
 * Do stuff upon plugin activation
 *
 * @since 1.0.0
 *
 * @return boolean
 */

function sky_addons_pro_plugin_activate() {
	return true;
}

add_filter( 'sky_addons_pro_init', 'sky_addons_pro_plugin_activate', 10 );

function sky_addons_init_version() {
	return ', ' . SKY_ADDONS_PRO_VERSION . ' (pro)';
}

add_filter( 'sky_addons_pro_version', 'sky_addons_init_version', 10 );


/**
 * Sky Addons for Elementor missing notice
 *
 * @since 1.0.0
 *
 * @return void
 */
function sky_addons_core_load_plugin() {

	/**
	 * Need to must load free version
	 */

	if ( ! did_action( 'skyaddons_loaded' ) ) {
		add_action( 'admin_notices', 'sky_addons_core_fail_load' );
		return;
	}

	if ( ! version_compare( SKY_ADDONS_VERSION, SKY_ADDONS_CORE_REQUIRED_VERSION, '>=' ) ) {
		add_action( 'admin_notices', 'sky_addons_core_fail_load_out_of_date' );
		return;
	}

	require( SKY_ADDONS_PRO_PATH . 'plugin.php' );
}

add_action( 'plugins_loaded', 'sky_addons_core_load_plugin', 20 );

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @since 1.0.0
 *
 */
function sky_addons_core_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$plugin = 'sky-elementor-addons/sky-elementor-addons.php';

	if ( _is_sky_addons_core_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

		$message = '<p>' . esc_html__( 'Sky Addons Pro for Elementor is not working because you need to activate the Sky Addons for Elementor plugin.', 'sky-elementor-addons-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Sky Addons Now', 'sky-elementor-addons-pro' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( admin_url( 'plugin-install.php?s=Sky+Elementor+Addons&tab=search&type=term' ), 'install-plugin_sky_elementor_addons' );

		$message = '<p>' . esc_html__( 'Sky Addons Pro for Elementor is not working because you need to install the Sky Addons for Elementor plugin.', 'sky-elementor-addons-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Sky Addons Now', 'sky-elementor-addons-pro' ) ) . '</p>';
	}

	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Sky Addons for Elementor update version required
 *
 * @since 1.0.0
 *
 */

function sky_addons_core_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'sky-elementor-addons/sky-elementor-addons.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message      = '<p>' . esc_html__( 'Sky Addons Pro for Elementor is not working properly because you are using an old version of Sky Addons.', 'sky-elementor-addons-pro' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update Elementor Now', 'sky-elementor-addons-pro' ) ) . '</p>';

	printf( '<div class="error"><p>%s</p></div>', $message );
}

if ( ! function_exists( '_is_sky_addons_core_installed' ) ) {

	function _is_sky_addons_core_installed() {
		$file_path         = 'sky-elementor-addons/sky-elementor-addons.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}
