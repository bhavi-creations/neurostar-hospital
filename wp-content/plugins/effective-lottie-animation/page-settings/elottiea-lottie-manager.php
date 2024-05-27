<?php
namespace elottiea_lottie_namespace\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'elottiea_adlottie_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'elottiea_adlottie_register_document_controls' ] );
	}

	public function elottiea_adlottie_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Effective Lottie Animation', 'effective-lottie-animation' ) );
	}

	public function elottiea_adlottie_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'elottiea_new_section',
			[
				'label' => esc_html__( 'Settings', 'effective-lottie-animation' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'elottiea_text',
			[
				'label' => esc_html__( 'Title', 'effective-lottie-animation' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'effective-lottie-animation' ),
			]
		);

		$document->end_controls_section();
	}
}
