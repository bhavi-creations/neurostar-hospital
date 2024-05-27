<?php

namespace Sky_Addons_Pro\Modules\HoverVideo\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Embed;
use Elementor\Widget_Base;
use Elementor\Modules\DynamicTags\Module as TagsModule;

use Sky_Addons_Pro\Traits\Global_Plyr;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Hover_Video extends Widget_Base {

	use Global_Plyr;

	public function get_name() {
		return 'sky-hover-video';
	}

	public function get_title() {
		return esc_html__( 'Hover Video', 'sky-elementor-addons-pro' );
	}

	public function get_icon() {
		return 'sky-icon-hover-video';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons-pro' ];
	}

	public function get_keywords() {
		return [ 'sky', 'hover', 'video', 'youtube', 'vimeo', 'dailymotion' ];
	}

	public function get_script_depends() {
		return [ 'plyr' ];
	}

	public function get_style_depends() {
		return [ 
			'plyr',
		];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'section_video_gallery',
			[ 
				'label' => esc_html__( 'Hover Video', 'sky-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'video_tabs' );

		$repeater->start_controls_tab(
			'tab_video',
			[ 
				'label' => esc_html__( 'Video', 'sky-elementor-addons-pro' ),
			]
		);

		$repeater->add_control(
			'video_url',
			[ 
				'label'       => esc_html__( 'Video Link', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter Your Video URL', 'sky-elementor-addons-pro' ),
				'description' => esc_html__( 'YouTube, Vimeo, Dailymotion etc.', 'sky-elementor-addons-pro' ),
				'default'     => 'https://youtu.be/aqz-KE-bpKQ',
				'label_block' => true,
				'condition'   => [ 
					'self_hosted_video!' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'self_hosted_video',
			[ 
				'label'        => esc_html__( 'Self Hosted Video?', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes'

			]
		);

		$repeater->add_control(
			'external_url_set',
			[ 
				'label'        => esc_html__( 'External URL', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => [ 
					'self_hosted_video' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'external_url',
			[ 
				'label'        => esc_html__( 'URL', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::URL,
				'autocomplete' => false,
				'options'      => false,
				'label_block'  => true,
				'show_label'   => false,
				'dynamic'      => [ 
					'active'     => true,
					'categories' => [ 
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'media_type'   => 'video',
				'placeholder'  => esc_html__( 'Enter your URL', 'sky-elementor-addons-pro' ),
				'condition'    => [ 
					'self_hosted_video' => 'yes',
					'external_url_set'  => 'yes',
				],
			]
		);

		$repeater->add_control(
			'hosted_url',
			[ 
				'label'      => esc_html__( 'Choose File', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => [ 
					'active'     => true,
					'categories' => [ 
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_type' => 'video',
				'condition'  => [ 
					'self_hosted_video' => 'yes',
					'external_url_set!' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'poster',
			[ 
				'label'       => esc_html__( 'Poster', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
				'condition'   => [ 
					'self_hosted_video' => 'yes',
				],
			]
		);


		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_content',
			[ 
				'label' => esc_html__( 'Content', 'sky-elementor-addons-pro' ),
			]
		);


		$repeater->add_control(
			'title',
			[ 
				'label'       => esc_html__( 'Title', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Video Title', 'sky-elementor-addons-pro' ),
				'label_block' => true,
				'rows'        => 2,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'title_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons-pro' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();


		$this->add_control(
			'video_list',
			[ 
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'separator'   => 'before',
				'default'     => [ 
					[ 
						'title'     => esc_html__( 'Video One', 'sky-elementor-addons-pro' ),
						'video_url' => 'https://youtu.be/JVc6mCcCyjs'
					],
					[ 
						'title'     => esc_html__( 'Video Two', 'sky-elementor-addons-pro' ),
						'video_url' => 'https://youtu.be/VIhZUbvtQ18'
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_responsive_control(
			'video_height',
			[ 
				'label'       => esc_html__( 'Video Height', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', 'em' ],
				'range'       => [ 
					'px' => [ 
						'min' => 400,
						'max' => 1000,
					],
				],
				'selectors'   => [ 
					'{{WRAPPER}} .sa-videos-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
				'separator'   => 'before',

			]
		);

		$this->add_control(
			'height_notice',
			[ 
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note: Video Height is not working, because of Aspect Ratio. Now Aspect Ratio Working.', 'sky-elementor-addons-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [ 
					'aspect_ratio!' => ''
				]

			]
		);

		$this->add_control(
			'aspect_ratio',
			[ 
				'label'        => esc_html__( 'Aspect Ratio', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [ 
					''    => esc_html__( 'Select Aspect Ratio', 'sky-elementor-addons-pro' ),
					'11'  => '1:1',
					'21'  => '2:1',
					'32'  => '3:2',
					'43'  => '4:3',
					'85'  => '8:5',
					'169' => '16:9',
					'219' => '21:9',
					'916' => '9:16',
				],
				'prefix_class' => 'sa-hv-ratio-yes sa-ratio-',
				'render_type'  => 'template',
			]
		);

		// $this->add_control(
		//     'show_title',
		//     [
		//         'label'    => esc_html__('Show Title', 'sky-elementor-addons-pro'),
		//         'type'     => Controls_Manager::SWITCHER,
		//         'default'  => 'yes',
		//         'separator' => 'before'
		//     ]
		// );

		// $this->add_control(
		//     'title_tag',
		//     [
		//         'label'     => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
		//         'type'      => Controls_Manager::SELECT,
		//         'default'   => 'h3',
		//         'options'   => sky_title_tags(),
		//         'condition' => [
		//             'show_title' => 'yes'
		//         ]
		//     ]
		// );

		$this->add_control(
			'show_button',
			[ 
				'label'     => esc_html__( 'Show Button', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_button_progress',
			[ 
				'label'     => esc_html__( 'Show Progress on Button', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);
		$this->add_control(
			'show_progress_bar',
			[ 
				'label'     => esc_html__( 'Show Progress Bar', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default'   => 'yes'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_video',
			[ 
				'label' => esc_html__( 'Video', 'sky-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'video_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-videos-wrapper',
			]
		);

		$this->add_responsive_control(
			'video_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-videos-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'video_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-videos-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name'     => 'video_css_filters',
				'selector' => '{{WRAPPER}} .sa-videos-wrapper',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[ 
				'label'     => esc_html__( 'Button', 'sky-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_control(
			'button_style',
			[ 
				'label'        => esc_html__( 'Style', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'default'      => 'button',
				'prefix_class' => 'sa-hv-button-style-',
				'options'      => [ 
					'button' => esc_html__( 'Button', 'sky-elementor-addons-pro' ),
					'tab'    => esc_html__( 'Tab', 'sky-elementor-addons-pro' ),
				],
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'left'   => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-buttons-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_space_between',
			[ 
				'label'      => esc_html__( 'Space Between', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
					],
				],
				'default'    => [ 
					'unit' => 'px',
					'size' => 8,
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-buttons-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_position',
			[ 
				'label'                => esc_html__( 'Icon Position', 'sky-elementor-addons-pro' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [ 
					'left'   => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right'  => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-h-align-right',
					],
					'top'    => [ 
						'title' => esc_html__( 'Top', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [ 
						'title' => esc_html__( 'Bottom', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'              => 'left',
				'toggle'               => false,
				'selectors'            => [ 
					'{{WRAPPER}} .sa-content' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'left'   => 'flex-direction: row;',
					'right'  => 'flex-direction: row-reverse;',
					'top'    => 'flex-direction: column;',
					'bottom' => 'flex-direction: column-reverse;',
				]
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[ 
				'label'      => esc_html__( 'Icon Spacing', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
					],
				],
				'default'    => [ 
					'unit' => 'px',
					'size' => 8,
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-content' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[ 
				'label' => esc_html__( 'Settings', 'sky-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'play_by_progress',
			[ 
				'label'       => esc_html__( 'Play By Progress', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Play when hovering on Progress Bar.', 'sky-elementor-addons-pro' ),
				'default'     => 'yes'
			]
		);

		$this->add_control(
			'screen_out_pause',
			[ 
				'label'       => esc_html__( 'Pause By Screen', 'sky-elementor-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Pause the player when the mouse leaves the video area.', 'sky-elementor-addons-pro' ),
				'default'     => 'yes'
			]
		);

		$this->add_control(
			'show_controls',
			[ 
				'label'     => esc_html__( 'Show Controls', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'controls_mute',
			[ 
				'label'     => esc_html__( 'Mute & Volume Icon', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [ 
					'show_controls' => 'yes'
				]
			]
		);

		$this->add_control(
			'controls_current_time',
			[ 
				'label'     => esc_html__( 'Current Time', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_controls' => 'yes'
				]
			]
		);

		$this->add_control(
			'controls_fullscreen',
			[ 
				'label'     => esc_html__( 'Fullscreen', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_controls' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[ 
				'label'     => esc_html__( 'Button', 'sky-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-content',
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'button_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'condition'  => [ 
					'button_style' => 'button'
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius_tab',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'condition'  => [ 
					'button_style' => 'tab'
				],
				'selectors'  => [ 
					'{{WRAPPER}}' => '--sa-hv-border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'button_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_control(
			'button_hover_animation',
			[ 
				'label' => esc_html__( 'Animation', 'sky-elementor-addons-pro' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'button_color_active',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button.sa-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_background_active',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button.sa-active',
			]
		);

		$this->add_control(
			'button_border_color_active',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button.sa-active' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'button_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius_active',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-button.sa-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_text_shadow_active',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-button.sa-active',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_box_shadow_active',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-button.sa-active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress',
			[ 
				'label'     => esc_html__( 'Progress Bar', 'sky-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_progress_bar' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'progress_bar_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'left'   => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-progress-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_bar_spacing',
			[ 
				'label'      => esc_html__( 'Spacing', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-progress-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_bar_height',
			[ 
				'label'      => esc_html__( 'Height', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'progress_bar_width',
			[ 
				'label'      => esc_html__( 'Width', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-progress-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'           => 'progress_bar_base_color',
				'label'          => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'          => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Base Color', 'sky-elementor-addons-pro' ),
					],
				],
				'selector'       => '{{WRAPPER}} .sa-progress-bar',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'           => 'progress_color',
				'label'          => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'          => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Progress Color', 'sky-elementor-addons-pro' ),
					],
				],
				'separator'      => 'before',
				'selector'       => '{{WRAPPER}} .sa-hover-video .sa-progress',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_progress_style',
			[ 
				'label'     => esc_html__( 'Button Progress', 'sky-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button'          => 'yes',
					'show_button_progress' => 'yes'
				]
			]
		);

		$this->add_control(
			'button_progress_style',
			[ 
				'label'        => esc_html__( 'Style', 'sky-elementor-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'default'      => 'bottom',
				'prefix_class' => 'sa-hv-button-progress-style-',
				'options'      => [ 
					'bottom'      => esc_html__( 'Bottom', 'sky-elementor-addons-pro' ),
					'full_height' => esc_html__( 'Full Height', 'sky-elementor-addons-pro' ),
				],
			]
		);

		$this->add_responsive_control(
			'button_progress_height',
			[ 
				'label'      => esc_html__( 'Height', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}}' => '--sa-btn-hv-progress-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 
					'button_progress_style!' => 'full_height'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'           => 'button_progress_base_color',
				'label'          => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'          => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Base Color', 'sky-elementor-addons-pro' ),
					],
				],
				'selector'       => '{{WRAPPER}} .sa-button-progress',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'           => 'button_progress_color',
				'label'          => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'          => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Progress Color', 'sky-elementor-addons-pro' ),
					],
				],
				'separator'      => 'before',
				'selector'       => '{{WRAPPER}} .sa-button-progress .sa-progress',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_controls_style',
			[ 
				'label'     => esc_html__( 'Controls', 'sky-elementor-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_controls' => 'yes',
				]
			]
		);

		$this->add_control(
			'player_controls_color',
			[ 
				'label'     => esc_html__( 'Controls Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-video-control-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'player_controls_color_hover',
			[ 
				'label'     => esc_html__( 'Controls Hover Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-video-control-color-hover: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'player_primary_color',
			[ 
				'label'     => esc_html__( 'Primary Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-color-main: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// $id       = 'sa-hover-video-' . $this->get_id() . '-' . rand(10, 500);
		$id        = 'sa-hover-video-' . $this->get_id() . rand( 10, 100 );
		$player_id = $id . '-player-';

		$player_id_final = [];
		foreach ( $settings['video_list'] as $index => $item ) {
			$player_id_final[] = $player_id . $index;
		}

		$this->add_render_attribute(
			[ 
				'video-settings' => [ 
					'class'         => 'sa-hover-video',
					'id'            => $id,
					'data-settings' => [ 
						wp_json_encode( array_filter( [ 
							'id'                  => '#' . $id,
							'playerId'            => $player_id_final,
							'playByProgress'      => ( 'yes' == $settings['play_by_progress'] ) ? true : false,
							'screenOutPause'      => ( 'yes' == $settings['screen_out_pause'] ) ? true : false,
							'controlsMute'        => ( 'yes' == $settings['show_controls'] && ( 'yes' == $settings['controls_mute'] ) ) ? true : false,
							'controlsCurrentTime' => ( 'yes' == $settings['show_controls'] && ( 'yes' == $settings['controls_current_time'] ) ) ? true : false,
							'controlsFullScreen'  => ( 'yes' == $settings['show_controls'] && ( 'yes' == $settings['controls_fullscreen'] ) ) ? true : false,
						] ) )
					],
				]
			]
		);

		?>
		<div <?php echo $this->get_render_attribute_string( 'video-settings' ); ?>>
			<div class="sa-videos-wrapper sa-d-block sa-rounded">
				<?php
				foreach ( $settings['video_list'] as $index => $item ) {
					$video_index = 'video-item' . $index;

					$this->add_render_attribute( $video_index, [ 
						'class'   => 'sa-video-item ' . $player_id . $index,
						'data-id' => $player_id . $index
					] );

					if ( $index == 0 ) {
						$this->add_render_attribute( $video_index, [ 
							'class' => 'sa-active'
						] );
					}

					?>
					<div <?php $this->print_render_attribute_string( $video_index ); ?>>
						<?php
						if ( 'yes' !== $item['self_hosted_video'] ) {
							$video_info = Embed::get_video_properties( $item['video_url'] );
							$this->video_markup_online_platform( $player_id . $index, $video_info['provider'], $video_info['video_id'] );
						} else {
							$poster = $item['poster']['url'];
							if ( $item['external_url_set'] == 'yes' ) {
								$video_url = $item['external_url']['url'];
							} else {
								$video_url = $item['hosted_url']['url'];
							}
							// $poster = (empty($poster)) ? Utils::get_placeholder_image_src() : $poster;
			
							$this->video_markup_html5( $player_id . $index, $poster, $video_url );
						}
						?>
					</div>
				<?php } ?>
			</div>
			<?php if ( 'yes' == $settings['show_progress_bar'] ) : ?>
				<div class="sa-progress-wrapper sa-d-flex sa-mt-4 sa-justify-content-center">
					<?php foreach ( $settings['video_list'] as $index => $item ) : ?>
						<div class="sa-progress-bar" data-id="<?php echo esc_attr( $player_id . $index ); ?>">
							<div class="sa-progress"></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php if ( 'yes' == $settings['show_button'] ) : ?>
				<div class="sa-buttons-wrapper sa-d-flex sa-mt-4 sa-justify-content-center">
					<?php
					foreach ( $settings['video_list'] as $index => $item ) {
						$video_index = 'button-item' . $index;

						$this->add_render_attribute( $video_index, [ 
							'class'   => 'sa-button sa-link sa-rounded ' . $player_id . $index,
							'data-id' => $player_id . $index
						] );

						if ( $settings['button_hover_animation'] ) {
							$this->add_render_attribute( $video_index, 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
						}

						if ( $index == 0 ) {
							$this->add_render_attribute( $video_index, [ 
								'class' => 'sa-active'
							] );
						}
						?>
						<a <?php $this->print_render_attribute_string( $video_index ) ?>>
							<div class="sa-content sa-d-flex sa-align-items-center">
								<?php

								if ( ! empty( $item['title_icon']['value'] ) ) :
									?>
									<span class="sa-icon-wrap">
										<?php
										Icons_Manager::render_icon( $item['title_icon'], [ 
											'aria-hidden' => 'true',
											'class'       => 'sa-button-icon'
										] );
										?>
									</span>
								<?php endif;

								if ( ! empty( $item['title'] ) ) :
									printf(
										'<span class="%1$s">%2$s</span>',
										'sa-button-text',
										esc_html( $item['title'] )
									);
								endif;

								?>
							</div>
							<?php if ( 'yes' == $settings['show_button_progress'] ) : ?>
								<div class="sa-button-progress">
									<div class="sa-progress"></div>
								</div>
							<?php endif; ?>
						</a>
					<?php } ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
