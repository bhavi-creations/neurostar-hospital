<?php

namespace Sky_Addons_Pro\Modules\PaceSlider\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Pace_Slider extends Widget_Base {

    public function get_name() {
        return 'sky-pace-slider';
    }

    public function get_title() {
        return __('Pace Slider', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-pace-slider';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords() {
        return ['creative', 'pace', 'slider', 'carousel', 'portfolio', 'sky'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_sliders',
            [
                'label' => esc_html__('Sliders', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 2,
                'default'     => esc_html__('Slide Title', 'sky-elementor-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'thumb_title',
            [
                'label'       => esc_html__('Alternative Thumb Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 2,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'custom_text',
            [
                'label'       => esc_html__('Text', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                'placeholder' => esc_html__('Type your description here', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $repeater->add_control(
            'slider_image',
            [
                'label'     => esc_html__('Image', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => ['active' => true],
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com', 'sky-elementor-addons-pro'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
                'dynamic'       => ['active' => true],
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'       => esc_html__('Slide Title #1', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'       => esc_html__('Slide Title #2', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'       => esc_html__('Slide Title #3', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'       => esc_html__('Slide Title #4', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'       => esc_html__('Slide Title #5', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'       => esc_html__('Slide Title #6', 'sky-elementor-addons-pro'),
                        'custom_text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons-pro'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_layout',
            [
                'label' => esc_html__('Slider Layout', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__('Note: We recommend that you select full width for your Section and disable gaps between Columns.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 400,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pace-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h3',
                'options'   => sky_title_tags(),
            ]
        );

        $this->add_control(
            'slider_heading',
            [
                'label'     => esc_html__('M A I N - S L I D E R', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'content_position',
            [
                'label'                => esc_html__('Content Position', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::SELECT,
                'label_block'          => false,
                'options'              => [
                    'top-left'      => esc_html__('Top Left', 'sky-elementor-addons-pro'),
                    'top-center'    => esc_html__('Top Center', 'sky-elementor-addons-pro'),
                    'top-right'     => esc_html__('Top Right', 'sky-elementor-addons-pro'),
                    // 'bottom-left'   => esc_html__('Bottom Left', 'sky-elementor-addons-pro'),
                    // 'bottom-center' => esc_html__('Bottom Center', 'sky-elementor-addons-pro'),
                    // 'bottom-right'  => esc_html__('Bottom Right', 'sky-elementor-addons-pro'),
                ],
                'desktop_default'      => 'top-left',
                'tablet_default'       => 'top-left',
                'mobile_default'       => 'top-left',
                'style_transfer'       => true,
                'selectors'            => [
                    '{{WRAPPER}} .sa-slider-content' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top-left'      => 'top: 0%; left: 0; transform: translate(0%, 0%);right: auto;',
                    'top-center'    => 'top: 0; left: 50%; transform: translate(-50%, 0%);',
                    'top-right'     => 'top: 0%; right: 0; transform: translate(0%, 0%);left: auto;',
                    // 'bottom-left'   => 'bottom: 0; left: 0%; transform: translate(0%, 0%);top: auto;',
                    // 'bottom-center' => 'bottom: 0; left: 50%; transform: translate(-50%, 0%);top: auto;',
                    // 'bottom-right'  => 'bottom: 0; right: 0%; transform: translate(0%, 0%);top: auto;left:auto;',
                ]
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label'     => esc_html__('Text Alignment', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-slider-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label'      => esc_html__('Content Max Width (%)', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-slider-content' => 'min-width: {{SIZE}}%; max-width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'thumb_slider_heading',
            [
                'label'     => esc_html__('T H U M B N A I L', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'thumb_content_position',
            [
                'label'                => esc_html__('Content Position', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
                    'top'      => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'   => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'   => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'desktop_default'      => 'bottom',
                'tablet_default'       => 'bottom',
                'mobile_default'       => 'bottom',
                'style_transfer'       => true,
                'selectors'            => [
                    '{{WRAPPER}} .sa-thumb-content' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'top: 0%; left: 0; transform: translate(0%, 0%);right: auto;',
                    'middle' => 'bottom: auto; left: 0; transform: translate(0%, -50%); top: 50%;',
                    'bottom' => 'bottom: 0; left: 0%; transform: translate(0%, 0%);top: auto;',
                ]
            ]
        );

        $this->add_responsive_control(
            'thumb_content_alignment',
            [
                'label'     => esc_html__('Text Alignment', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thumb_show_title',
            [
                'label'   => esc_html__('Show Title', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'   => esc_html__('Show Button / Link', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_navigation',
            [
                'label'     => esc_html__('Show Navigation', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label'     => esc_html__('Button / Link', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_button' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'button_text',
            [
                'label'   => esc_html__('Button Text', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Learn more', 'sky-elementor-addons-pro'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'          => esc_html__('Icon Position', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'before' => [
                        'title' => esc_html__('Before', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'after'  => [
                        'title' => esc_html__('After', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'        => 'after',
                'toggle'         => false,
                'condition'      => [
                    'button_icon[value]!' => ''
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'      => esc_html__('Icon Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 20,
                        'step' => 1,
                    ],
                ],
                'condition'  => [
                    'button_icon[value]!' => ''
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-button-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => esc_html__('Slider Settings', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'           => esc_html__('Columns', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::SELECT,
                'options'         => [
                    1 => esc_html__('1 Column', 'sky-elementor-addons-pro'),
                    2 => esc_html__('2 Columns', 'sky-elementor-addons-pro'),
                    3 => esc_html__('3 Columns', 'sky-elementor-addons-pro'),
                    4 => esc_html__('4 Columns', 'sky-elementor-addons-pro'),
                    5 => esc_html__('5 Columns', 'sky-elementor-addons-pro'),
                    6 => esc_html__('6 Columns', 'sky-elementor-addons-pro'),
                ],
                'default'        => 4,
                'tablet_default' => 2,
                'mobile_default' => 2,
                'render_type'    => 'template',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__('Autoplay', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed (ms)', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 10000,
                        'step' => 500,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 5000,
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'   => esc_html__('Slide Speed (ms)', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 10000,
                        'step' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2000,
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation',
            [
                'label'     => esc_html__('Navigation', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => ['show_navigation' => 'yes']
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => esc_html__('Prev Icon', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__('Slider', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_img_overlay',
            [
                'label'     => esc_html__('Image Overlay', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-img-wrapper:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'slider_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-slider-content',
            ]
        );

        $this->start_controls_tabs(
            'slider_style_tabs'
        );

        $this->start_controls_tab(
            'slider_title_style_tab',
            [
                'label' => esc_html__('Title', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'title_text_stroke',
                'selector' => '{{WRAPPER}} .sa-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'title_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'slider_text_style_tab',
            [
                'label' => esc_html__('Text', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'text_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_thumbs_style',
            [
                'label' => esc_html__('Slider Thumbs', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thumbs_img_overlay',
            [
                'label'     => esc_html__('Image Overlay', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-img-wrapper:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'thumbs_line',
            [
                'label' => esc_html__('Line Style', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'line_size',
            [
                'label'      => esc_html__('Line Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 5,
                        'step' => .5,
                    ],
                ],
                'condition'      => [
                    'thumbs_line' => 'yes'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-thumb-wrapper' => '--sky-fs-line-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label'     => esc_html__('Line Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition'      => [
                    'thumbs_line' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-wrapper' => 'border-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'line_color_hover',
            [
                'label'     => esc_html__('Line Color Hover', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition'      => [
                    'thumbs_line' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-wrapper:before' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'thumb_title_heading',
            [
                'label'     => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'thumb_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-thumb-title',
            ]
        );

        $this->start_controls_tabs(
            'thumb_title_style_tabs'
        );

        $this->start_controls_tab(
            'thumb_title_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'thumb_title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'thumb_title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-thumb-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'thumb_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .swiper-slide',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thumb_title_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'thumb_title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-thumb-title:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'thumb_title_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-thumb-title:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'thumb_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .swiper-slide:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thumb_title_style_active_tab',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'thumb_title_color_active',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide-active .sa-thumb-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'thumb_title_text_shadow_active',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .swiper-slide-active .sa-thumb-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'thumb_background_active',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .swiper-slide.swiper-slide-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label'     => esc_html__('Button / Link', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'button_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );


        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_border_border!' => '',
                ],
            ]
        );


        $this->add_responsive_control(
            'button_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'button_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label'     => esc_html__('Navigation', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'navigation_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} ' => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} ' => '--sa-navigation-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'navigation_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
            ]
        );

        $this->add_responsive_control(
            'navigation_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('navigation_tabs');

        $this->start_controls_tab(
            'navigation_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'navigation_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'navigation_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'navigation_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'navigation_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'navigation_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'navigation_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-swiper-button-prev:hover svg *, {{WRAPPER}} .sa-swiper-button-next:hover svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'navigation_bg_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
            ]
        );

        $this->add_control(
            'navigation_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'navigation_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'navigation_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render_button($link) {
        $settings = $this->get_settings_for_display();

        if ('yes' !== $settings['show_button']) {
            return;
        }

        $this->add_render_attribute('link_attr', 'class', 'sa-button sa-d-inline-block sa-text-decoration-none sa-fw-bold', true);

        if (!empty($link['url'])) {
            $this->add_render_attribute('link_attr', 'href', esc_url($link['url']), true);

            if ($link['is_external']) {
                $this->add_render_attribute('link_attr', 'target', '_blank', true);
            }

            if ($link['nofollow']) {
                $this->add_render_attribute('link_attr', 'rel', 'nofollow', true);
            }
        } else {
            $this->add_render_attribute('link_attr', 'target', '_self', true);
            $this->add_render_attribute('link_attr', 'rel', 'follow', true);
            $this->add_render_attribute('link_attr', 'href', 'javascript:void(0);', true);
        }

        if ($settings['button_hover_animation']) {
            $this->add_render_attribute('link_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
        }
?>
        <a <?php echo $this->get_render_attribute_string('link_attr'); ?>>
            <?php
            if (!empty($settings['button_icon']['value']) && $settings['button_icon_position'] == 'before') {
                Icons_Manager::render_icon($settings['button_icon'], [
                    'aria-hidden' => 'true',
                    'class'       => 'sa-button-left sa-me-2'
                ]);
            }

            //$this->add_render_attribute('button_text', 'class', 'sa-button-text');
            $this->add_inline_editing_attributes('button_text', 'none');

            printf(
                '<span %1$s>%2$s</span>',
                $this->get_render_attribute_string('button_text'),
                esc_html($settings['button_text'])
            );

            if (!empty($settings['button_icon']['value']) && $settings['button_icon_position'] == 'after') {
                Icons_Manager::render_icon($settings['button_icon'], [
                    'aria-hidden' => 'true', 'class'       => 'sa-button-right sa-ms-2'
                ]);
            }
            ?>
        </a>
        <?php
    }

    protected function render_thumbs_title($item, $index) {
        $settings  = $this->get_settings_for_display();

        if ('yes' !== $settings['thumb_show_title']) {
            return;
        }

        $this->add_render_attribute('title-link-attr' . $index, 'class', 'sa-link', true);
        $this->add_render_attribute('title-link-attr' . $index, 'href', 'javascript:void(0);', true);

        $title_content = (isset($item['thumb_title']) && !empty($item['thumb_title'])) ? wp_kses_post($item['thumb_title']) : wp_kses_post($item['title']);

        $title_content = '<a ' . $this->get_render_attribute_string('title-link-attr' . $index) . '>' . $title_content . '</a>';

        if (isset($item['link']['url']) && !empty($item['link']['url'])) :
            $this->add_render_attribute('title-link-attr' . $index, 'href', $item['link']['url'], true);

            if ($item['link']['is_external']) {
                $this->add_render_attribute('title-link-attr' . $index, 'target', '_blank', true);
            }

            if ($item['link']['nofollow']) {
                $this->add_render_attribute('title-link-attr' . $index, 'rel', 'nofollow', true);
            }
            $title_content = '<a ' . $this->get_render_attribute_string('title-link-attr' . $index) . '>' . $title_content . '</a>';
        endif;
        printf('<%s class="sa-thumb-title">%s</%s>', $settings['title_tag'], $title_content, $settings['title_tag']);
    }

    protected function render_thumbs() {
        $settings  = $this->get_settings_for_display();
        $id       = 'sa-pace-slider-' . $this->get_id();

        foreach ($settings['slider_list'] as $index => $item) :
            $item_index = $id . '-' . $item['_id'];
        ?>
            <div class="swiper-slide">
                <?php
                if (!empty($item['slider_image']['url'])) :
                ?>
                    <div class="sa-thumb-img-wrapper" data-swiper-parallax="-100">
                        <?php
                        if ($item['slider_image']['id']) {
                            print(wp_get_attachment_image(
                                $item['slider_image']['id'],
                                $settings['thumbnail_size'],
                                false,
                                [
                                    'class' => 'sa-cover',
                                    'alt'   => !empty($item['title']) ? esc_html($item['title']) : Control_Media::get_image_alt($item['slider_image'])
                                ]
                            ));
                        } else {
                            printf('<img src="%1$s" alt="%2$s" class="sa-cover">', $item['slider_image']['url'], esc_html($item['title']));
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <div class="sa-thumb-wrapper sa-w-100 sa-h-100" data-item-index="<?php echo esc_html($item_index); ?>">
                    <div class="sa-thumb-content sa-w-100">
                        <?php $this->render_thumbs_title($item, $index); ?>
                        <div class="sa-btn-wrapper">
                            <div class="sa-btn-transform">
                                <?php $this->render_button($item['link']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
    }

    protected function render_navigation() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="sa-nav">
            <!-- If we need navigation buttons -->
            <button type="button" class="sa-swiper-button-prev sa-slider-navigation sa-icon-wrap sa-rounded">
                <?php
                if (!empty($settings['prev_icon']['value'])) :
                    Icons_Manager::render_icon($settings['prev_icon'], [
                        'aria-hidden' => 'true',
                        'class'       => 'fa-fw'
                    ]);
                else :
                ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
                        <path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z">
                    </svg>
                <?php
                endif;
                ?>

            </button>
            <button type="button" class="sa-swiper-button-next sa-slider-navigation sa-icon-wrap sa-rounded">
                <?php
                if (!empty($settings['next_icon']['value'])) :
                    Icons_Manager::render_icon($settings['next_icon'], [
                        'aria-hidden' => 'true',
                        'class'       => 'fa-fw'
                    ]);
                else :
                ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
                        <path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z">
                    </svg>
                <?php
                endif;
                ?>
            </button>
        </div>
    <?php
    }
    protected function render() {
        $settings        = $this->get_settings_for_display();
        $id              = 'sa-pace-slider-' . $this->get_id();

        $elementor_vp_lg = get_option('elementor_viewport_lg');
        $elementor_vp_md = get_option('elementor_viewport_md');
        $viewport_lg     = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
        $viewport_md     = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

        $columns_mobile  = isset($settings["columns_mobile"]) ? (int)$settings["columns_mobile"] : 2;
        $columns_tablet  = isset($settings["columns_tablet"]) ? (int)$settings["columns_tablet"] : 2;
        $columns         = isset($settings["columns"]) ? (int)$settings["columns"] : 4;

        $this->add_render_attribute(
            [
                'pace-slider' => [
                    'class'         => 'sa-pace-slider',
                    'id'            => $id,
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'autoplay'              => $settings["autoplay"] == 'yes' ? [
                                "delay"             => !empty($settings["autoplay_speed"]['size']) ? $settings["autoplay_speed"]['size'] : 2000
                            ]                       :  false,
                            'speed'                 => (!empty($settings['speed']['size'])) ? $settings['speed']['size'] : 2000,
                            'pauseOnHover'          => ($settings["autoplay"] == 'yes' && $settings["pause_on_hover"] == 'yes') ? true : false,

                            'effect'                => 'slide',
                            'touchRatio'            => 0.2,
                            'loop'                  => true,
                            'speed'                 => (!empty($settings['speed']['size'])) ? $settings['speed']['size'] : 2000,
                            'loopedSlides'          => 4,
                            'freeMode'              => false,
                            'spaceBetween'          => 0,
                            'observer'              => true,
                            'observeParents'        => true,
                            'slideToClickedSlide'   => true,
                            'watchSlidesVisibility' => true,
                            'watchSlidesProgress'   => true,
                            "slidesPerView"         => $columns_mobile,
                            "breakpoints"           => [
                                (int) $viewport_md  => [
                                    "slidesPerView" => $columns_tablet,
                                ],
                                (int) $viewport_lg  => [
                                    "slidesPerView" => $columns,
                                ]
                            ],
                            'navigation'      => [
                                'nextEl' => "#$id .sa-swiper-button-next",
                                'prevEl' => "#$id .sa-swiper-button-prev",
                            ],
                        ]))
                    ],
                ]
            ]
        );

    ?>
        <div <?php echo $this->get_render_attribute_string('pace-slider'); ?>>
            <div class="sa-pace-slider-main">
                <?php
                foreach ($settings['slider_list'] as $index => $item) :
                    $item_index = $id . '-' . $item['_id'];
                ?>
                    <div class="sa-slide sa-h-100 sa-w-100" id="<?php echo esc_html($item_index); ?>">
                        <?php
                        if (!empty($item['slider_image']['url'])) :
                        ?>
                            <div class="sa-img-wrapper">
                                <?php
                                if ($item['slider_image']['id']) {
                                    print(wp_get_attachment_image(
                                        $item['slider_image']['id'],
                                        $settings['thumbnail_size'],
                                        false,
                                        [
                                            'class' => 'sa-cover',
                                            'alt'   => !empty($item['title']) ? esc_html($item['title']) : Control_Media::get_image_alt($item['slider_image'])
                                        ]
                                    ));
                                } else {
                                    printf('<img src="%1$s" alt="%2$s" class="sa-cover">', $item['slider_image']['url'], esc_html($item['title']));
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="sa-slider-content">
                            <?php

                            if (!empty($item['title'])) {
                                $this->add_render_attribute('title' . $index, 'class', 'sa-title sa-fw-bold sa-mb-3');
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    Utils::validate_html_tag($settings['title_tag']),
                                    $this->get_render_attribute_string('title' . $index),
                                    wp_kses_post($item['title'])
                                );
                            }

                            if (!empty($item['custom_text'])) :
                                printf(
                                    '<div class="sa-text">%1$s</div>',
                                    $this->parse_text_editor($item['custom_text'])
                                );
                            endif;

                            ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="sa-pace-slider-thumbs">
                <div class="swiper-wrapper">
                    <?php $this->render_thumbs(); ?>
                </div>
                <?php
                if ($settings['show_navigation'] == 'yes') :
                    $this->render_navigation();
                endif;
                ?>
            </div>
        </div>
<?php
    }
}
