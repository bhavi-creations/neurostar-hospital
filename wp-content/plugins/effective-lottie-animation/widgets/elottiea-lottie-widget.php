<?php
namespace elottiea_lottie_namespace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ELOTTIEA_Effective_widgets extends Widget_Base {

	public function get_name() {
		return esc_html__( 'EffectiveLottieAnimation', 'effective-lottie-animation' );
	}

	public function get_title() {
		return esc_html__( 'Effective Lottie Animation', 'effective-lottie-animation' );
	}

	public function get_icon() {
		return 'elottiea-effective-icon eicon-lottie';
	}

	public function get_categories() {
		return [ 'bwdthebest_general_category' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'elottiea_section_general_settings',
			array(
				'label' => __( 'General Settings', 'effective-lottie-animation' ),
			)
		);

		$this->add_control(
			'elottiea_source',
			array(
				'label'   => __( 'File Source', 'effective-lottie-animation' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'url'  => __( 'External URL', 'effective-lottie-animation' ),
					'file' => __( 'Media File', 'effective-lottie-animation' ),
				),
				'default' => 'url',
			)
		);

		$this->add_control(
			'elottiea_lottie_url',
			array(
				'label'       => __( 'Animation JSON URL', 'effective-lottie-animation' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default' 		=> 'https://assets5.lottiefiles.com/packages/lf20_1vK4588Atx.json',
				'description' => 'Get URL/JSON file from <a href="https://lottiefiles.com/featured" target="_blank">here...</a>',
				'label_block' => true,
				'condition'   => array(
					'elottiea_source' => 'url',
				),
			)
		);

		$this->add_control(
			'elottiea_lottie_file',
			array(
				'label'              => __( 'Upload JSON File', 'effective-lottie-animation' ),
				'type'               => Controls_Manager::MEDIA,
				'media_type'         => 'application/json',
				'frontend_available' => true,
				'condition'          => array(
					'elottiea_source' => 'file',
				),
			)
		);

		$this->add_control(
			'elottiea_lottie_loop',
			array(
				'label'        => __( 'Loop', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'elottiea_lottie_reverse',
			array(
				'label'        => __( 'Reverse', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'elottiea_lottie_speed',
			array(
				'label'   => __( 'Animation Speed', 'effective-lottie-animation' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 0.1,
				'max'     => 3,
				'step'    => 0.1,
			)
		);

		$this->add_control(
			'elottiea_trigger',
			array(
				'label' => __( 'Trigger', 'effective-lottie-animation' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none' => __( 'None', 'effective-lottie-animation' ),
					'hover' => __( 'Hover', 'effective-lottie-animation' ),
					'scroll' => __( 'Scroll', 'effective-lottie-animation' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'elottiea_hover_leave_reverse',
			array(
				'label'        => __( 'Reset on Mouse Leave', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'condition'    => array(
					'elottiea_trigger'         => 'hover',
					'lottie_reverse!' => 'true',
				),
			)
		);

		$this->add_control(
			'elottiea_lottie_hover',
			array(
				'label'        => __( 'Play on Hover', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::HIDDEN,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'elottiea_animate_on_scroll',
			array(
				'label'        => __( 'Play On Scroll', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::HIDDEN,
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'elottiea_animate_speed',
			array(
				'label'     => __( 'Speed', 'effective-lottie-animation' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 4,
				),
				'range'     => array(
					'px' => array(
						'max'  => 10,
						'step' => 0.1,
					),
				),
				'condition' => array(
					'elottiea_trigger'         => 'scroll',
					'lottie_reverse!' => 'true',
				),
			)
		);

		$this->add_control(
			'elottiea_animate_view',
			array(
				'label'     => __( 'Viewport', 'effective-lottie-animation' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'sizes' => array(
						'start' => 0,
						'end'   => 100,
					),
					'unit'  => '%',
				),
				'labels'    => array(
					__( 'Bottom', 'effective-lottie-animation' ),
					__( 'Top', 'effective-lottie-animation' ),
				),
				'scales'    => 1,
				'handles'   => 'range',
				'condition' => array(
					'elottiea_trigger'         => array( 'scroll', 'viewport' ),
					'lottie_reverse!' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'elottiea_animation_size',
			array(
				'label'      => __( 'Size', 'effective-lottie-animation' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 800,
					),
					'em' => array(
						'min' => 1,
						'max' => 30,
					),
				),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}}.elottiea-lottie-canvas .elottiea-lottie-animation, {{WRAPPER}}.elottiea-lottie-svg svg'    => 'width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'elottiea_lottie_rotate',
			array(
				'label'       => __( 'Rotate (degrees)', 'effective-lottie-animation' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => __( 'Set rotation value in degrees', 'effective-lottie-animation' ),
				'range'       => array(
					'px' => array(
						'min' => -180,
						'max' => 180,
					),
				),
				'default'     => array(
					'size' => 0,
				),
				'selectors'   => array(
					'{{WRAPPER}} .elottiea-lottie-animation' => 'transform: rotate({{SIZE}}deg)',
				),
			)
		);

		$this->add_responsive_control(
			'elottiea_animation_align',
			array(
				'label'     => __( 'Alignment', 'effective-lottie-animation' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'effective-lottie-animation' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'effective-lottie-animation' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'effective-lottie-animation' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => false,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'elottiea_link_switcher',
			array(
				'label' => __( 'Link', 'effective-lottie-animation' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'link',
			array(
				'label'       => __( 'Place URL', 'effective-lottie-animation' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array( 'active' => true ),
				'default'     => array(
					'url' => '#',
				),
				'placeholder' => 'https://example.com/',
				'label_block' => true,
				'separator'   => 'after',
				'condition'   => array(
					'elottiea_link_switcher'  => 'yes',
				),
			)
		);
		$this->add_control(
			'elottiea_lottie_renderer',
			array(
				'label'        => __( 'Render As', 'effective-lottie-animation' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'svg'    => __( 'SVG', 'effective-lottie-animation' ),
					'canvas' => __( 'Canvas', 'effective-lottie-animation' ),
				),
				'default'      => 'svg',
				'prefix_class' => 'elottiea-lottie-',
				'render_type'  => 'template',
				'label_block'  => true,
				'separator'    => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'elottiea_catpost_carousel_box_style',
			[
				'label' => esc_html__( 'Wrap Style', 'effective-lottie-animation' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		// Hover control start for box
		$this->start_controls_tabs(
			'elottiea_box_style_post'
		);
		$this->start_controls_tab(
			'elottiea_box_normal_post',
			[
				'label' => esc_html__( 'Normal', 'effective-lottie-animation' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'elottiea_box_bg_grediant_color',
				'label' => esc_html__( 'Background', 'effective-lottie-animation' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elottiea_box_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'effective-lottie-animation' ),
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'elottiea_box_border',
				'label' => esc_html__( 'Border', 'effective-lottie-animation' ),
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation svg',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'elottiea_box_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'effective-lottie-animation' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'elottiea_box_bg_grediant_color_hover',
				'label' => esc_html__( 'Background', 'effective-lottie-animation' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation:hover svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elottiea_box_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'effective-lottie-animation' ),
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation:hover svg',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'elottiea_box_border_hover',
				'label' => esc_html__( 'Border', 'effective-lottie-animation' ),
				'selector' => '{{WRAPPER}} .elottiea-lottie-animation:hover svg',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End

		$this->add_responsive_control(
			'elottiea_the_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'effective-lottie-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .elottiea-lottie-animation svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'elottiea_the_box_border_bottom',
			[
				'label' => esc_html__('Margin', 'effective-lottie-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .elottiea-lottie-animation svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'elottiea_box_padding',
			[
				'label' => esc_html__('Padding', 'effective-lottie-animation'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .elottiea-lottie-animation svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if(!empty($settings['elottiea_lottie_url'] || $settings['elottiea_lottie_file']['url'])){
			$anim_url = 'url' === $settings['elottiea_source'] ? $settings['elottiea_lottie_url'] : $settings['elottiea_lottie_file']['url'];
			if ( empty( $anim_url ) ) {
				return;
			}
			if ( '' !== $settings['elottiea_trigger'] ) {
				$settings['elottiea_lottie_hover'] = false;
				$settings['elottiea_animate_on_scroll'] = false;
			}
			$this->add_render_attribute(
				'lottie',
				array(
					'class' => 'elottiea-lottie-animation',
					'data-lottie-url' => $anim_url,
					'data-lottie-loop' => $settings['elottiea_lottie_loop'],
					'data-lottie-reverse' => $settings['elottiea_lottie_reverse'],
					'data-lottie-hover' => $settings['elottiea_lottie_hover'] || 'hover' === $settings['elottiea_trigger'],
					'data-lottie-speed' => $settings['elottiea_lottie_speed'],
					'data-lottie-render' => $settings['elottiea_lottie_renderer'],
				)
			);
			if ( 'hover' === $settings['elottiea_trigger'] && 'true' === $settings['elottiea_hover_leave_reverse'] ) {
				$this->add_render_attribute( 'lottie', 'data-lottie-reset', 'true' );
			}
			if ( $settings['elottiea_animate_on_scroll'] || 'scroll' === $settings['elottiea_trigger'] ) {
				$this->add_render_attribute(
					'lottie',
					array(
						'class' => 'elottiea-lottie-scroll',
						'data-lottie-scroll' => 'true',
						'data-scroll-start' => isset( $settings['elottiea_animate_view']['sizes']['start'] ) ? $settings['elottiea_animate_view']['sizes']['start'] : '0',
						'data-scroll-end' => isset( $settings['elottiea_animate_view']['sizes']['end'] ) ? $settings['elottiea_animate_view']['sizes']['end'] : '100',
						'data-scroll-speed' => $settings['elottiea_animate_speed']['size'],
					)
				);
			} elseif( 'viewport' === $settings['elottiea_trigger']){
				$this->add_render_attribute(
					'lottie',
					array(
						'data-lottie-viewport' => 'true', 'data-scroll-start' => $settings['elottiea_animate_view']['sizes']['start'], 'data-scroll-end' => $settings['elottiea_animate_view']['sizes']['end'],
					)
				);
			}
			if ( 'yes' === $settings['elottiea_link_switcher'] ) {
					$this->add_link_attributes( 'link', $settings['link'] );
			}
			echo 'yes' === $settings['elottiea_link_switcher']?'<a href="'.$settings['link']['url'].'">':'';
				echo '<div '.wp_kses_post( $this->get_render_attribute_string( 'lottie' ) ).'></div>';
			echo 'yes' === $settings['elottiea_link_switcher']?'</a>':'';
		}else{echo esc_html__('Add the Lottie link/file.');}
	}
}