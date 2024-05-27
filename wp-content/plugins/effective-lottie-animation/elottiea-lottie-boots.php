<?php
namespace elottiea_lottie_namespace;

use elottiea_lottie_namespace\PageSettings\Page_Settings;
define( "ELOTTIEA_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "ELOTTIEA_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class Classelottieaeffective {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function elottiea_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'elottiea_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function elottiea_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elottiea_effective_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/elottiea-lottie-widget.php' );
	}

	public function elottiea_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register WidgetsF
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ELOTTIEA_Effective_widgets());
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/elottiea-lottie-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function elottiea_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'bwdthebest_general_category',
			[
				'title' => esc_html__( 'BWD General Group', 'effective-lottie-animation' ),
				'icon' => 'eicon-person',
			]
		);
	}

	//css-js-link-here
	public function elottiea_all_assets_for_the_public(){
		wp_enqueue_style( 'elottiea-effective-style', plugin_dir_url( __FILE__ ) . 'assets/public/css/style.css', null, '1.0', 'all' );
		wp_enqueue_script( 'elottiea-effective-lottie', plugin_dir_url( __FILE__ ) . 'assets/public/js/lottie.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'elottiea-effective-min-lottie', plugin_dir_url( __FILE__ ) . 'assets/public/js/lottie.min.js', array('jquery'), '1.0', true );
	}

	//admin-icon
	public function elottiea_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
			'elottiea-admin-main' => array('elottiea_path_admin_define'=>ELOTTIEA_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['elottiea_path_admin_define'], null, '1.0', 'all');
		}
	}
	
	public function __construct() {

		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'elottiea_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'elottiea_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'elottiea_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'elottiea_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'elottiea_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Classelottieaeffective::instance();