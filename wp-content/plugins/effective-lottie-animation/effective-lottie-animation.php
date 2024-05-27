<?php
/**
 * Plugin Name: Effective Lottie Animation
 * Description: Effective Lottie Animation is an Elementor plugin by which show lottie animated image.
 * Plugin URI:  https://bestwpdeveloper.com/effective-lottie-animation
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: effective-lottie-animation
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.7.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/elottiea-plugin-activition.php';
final class elottiea_swiper_lottie{

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'elottiea_init', array( $this, 'elottiea_loaded_textdomain' ) );
		// elottiea_init Plugin
		add_action( 'plugins_loaded', array( $this, 'elottiea_init' ) );
	}

	public function elottiea_loaded_textdomain() {
		load_plugin_textdomain( 'effective-lottie-animation' );
	}

	public function elottiea_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'elottiea_addon_failed_load');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'elottiea_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'elottiea_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'elottiea-lottie-boots.php' );
	}

	public function elottiea_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'effective-lottie-animation' ),
			'<strong>' . esc_html__( 'Effective Lottie Animation', 'effective-lottie-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'effective-lottie-animation' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'effective-lottie-animation') . '</p></div>', $message );
	}

	public function elottiea_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'effective-lottie-animation' ),
			'<strong>' . esc_html__( 'Effective Lottie Animation', 'effective-lottie-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'effective-lottie-animation' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'effective-lottie-animation') . '</p></div>', $message );
	}
}

// Instantiate lottie.
new elottiea_swiper_lottie();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );