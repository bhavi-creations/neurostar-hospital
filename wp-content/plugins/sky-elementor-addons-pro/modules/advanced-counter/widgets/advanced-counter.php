<?php

namespace Sky_Addons_Pro\Modules\AdvancedCounter\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Advanced_Counter extends Widget_Base
{

    public function get_name()
    {
        return 'sky-advanced-counter';
    }

    public function get_title()
    {
        return esc_html__('Advanced Counter', 'sky-elementor-addons-pro');
    }

    public function get_icon()
    {
        return 'sky-icon-advanced-counter';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords()
    {
        return ['card', 'advanced', 'counter', 'number', 'fun', 'sky'];
    }

    public function get_style_depends()
    {
        return [
            'elementor-icons-fa-solid',
        ];
    }

    public function get_script_depends()
    {
        return ['countUp'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_counter_layout',
            [
                'label' => esc_html__('Layout', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label'          => esc_html__('Media Type', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-check',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => esc_html__('Choose Image', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image'
                ],
                'dynamic'   => ['active' => true],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default'   => 'medium_large',
                'separator' => 'none',
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                // need default
                'condition'   => [
                    'media_type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'media_position',
            [
                'label'        => esc_html__('Media Position', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'left'  => [
                        'title' => esc_html__('Left', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'       => false,
                'default'      => 'top',
                'prefix_class' => 'sa-advanced-counter-media-',
            ]
        );


        $this->add_control(
            'media_v_align',
            [
                'label'                => esc_html__('Vertical Alignment', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'options'              => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'              => 'top',
                'toggle'               => false,
                'condition'            => [
                    'media_position!' => 'top',
                ],
                'style_transfer'       => true,
                'selectors_dictionary' => [
                    'center' => '    -webkit-align-self: center; -ms-flex-item-align: center; align-self: center;',
                    'bottom' => '    -webkit-align-self: flex-end; -ms-flex-item-align: end; align-self: flex-end;',
                ],
                'selectors'            => [
                    '{{WRAPPER}}.sa-advanced-counter-media-left .sa-figure'  => '{{VALUE}};',
                    '{{WRAPPER}}.sa-advanced-counter-media-right .sa-figure' => '{{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('SKY NUMBER', 'sky-elementor-addons-pro'),
                'placeholder' => esc_html__('Type your title here', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => sky_title_tags(),
            ]
        );


        $this->add_control(
            'counter_start_value',
            [
                'label'       => esc_html__('Counter Start Value', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::NUMBER,
                'placeholder' => esc_html__('0', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'counter_end_value',
            [
                'label'       => esc_html__('Counter End Value', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => esc_html__('1000', 'sky-elementor-addons-pro'),
                'placeholder' => esc_html__('1000', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'show_divider',
            [
                'label'     => esc_html__('Show Divider', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_counter_settings',
            [
                'label' => esc_html__('Counter Settings', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'decimal_places',
            [
                'label'   => esc_html__('Decimal places', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'decimal_symbols',
            [
                'label'       => esc_html__('Decimal Symbols', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('.', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'duration',
            [
                'label' => esc_html__('Duration (ms)', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 2000,
                        'max'  => 10000,
                        'step' => 500,
                    ],
                ],
            ]
        );

        $this->add_control(
            'use_easing',
            [
                'label'   => esc_html__('Use Easing', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'use_grouping',
            [
                'label'   => esc_html__('Use Grouping', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'separator',
            [
                'label'       => esc_html__('Grouping Separator', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__(',', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
                'condition'   => [
                    'use_grouping' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => esc_html__('Prefix', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Your Prefix', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => esc_html__('Suffix', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Your Suffix', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'numerals',
            [
                'label'       => esc_html__('Numerals / Custom Language', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'placeholder' => esc_html__('0,1,2,3,4,5,6,7,8,9', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'numerals_note',
            [
                'label'           => '',
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Highly customizeable with a large range of options, you can even substitute numerals. <strong>It supports any Language.</strong>', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info your-class',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'style_counter',
            [
                'label' => esc_html__('Advanced Counter', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'counter_alignment',
            [
                'label'     => esc_html__('Alignment', 'sky-elementor-addons-pro'),
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
                    '{{WRAPPER}} .sa-advanced-counter' => 'text-align: {{VALUE}} !important; justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Content Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-ac-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_media',
            [
                'label' => esc_html__('Image / Icon', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__('Icon Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition'  => [
                    'media_type' => 'icon',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}' => '--sa-icon-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_width',
            [
                'label'      => esc_html__('Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'media_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'media_offset_popover',
            [
                'label'        => esc_html__('Offset', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__('Default', 'sky-elementor-addons-pro'),
                'label_on'     => esc_html__('Custom', 'sky-elementor-addons-pro'),
                'return_value' => 'yes',
            ]
        );


        $this->start_popover();

        $this->add_responsive_control(
            'media_horizontal_offset',
            [
                'label'          => esc_html__('Horizontal Offset', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'render_type'    => 'ui',
                'condition'      => [
                    'media_offset_popover' => 'yes'
                ],
                'selectors'      => [
                    '{{WRAPPER}} .sa-advanced-counter ' => '--sky-media-h-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'media_vertical_offset',
            [
                'label'          => esc_html__('Vertical Offset', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'render_type'    => 'ui',
                'condition'      => [
                    'media_offset_popover' => 'yes'
                ],
                'selectors'      => [
                    '{{WRAPPER}} .sa-advanced-counter' => '--sky-media-v-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'media_rotate',
            [
                'label'          => esc_html__('Rotate', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::SLIDER,
                'devices'        => ['desktop', 'tablet', 'mobile'],
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'condition'      => [
                    'media_offset_popover' => 'yes'
                ],
                'render_type'    => 'ui',
                'selectors'      => [
                    '{{WRAPPER}} .sa-advanced-counter' => '--sky-media-rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->end_popover();



        $this->add_responsive_control(
            'img_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image img ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon'       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'img_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-advanced-counter .sa-media-image img, {{WRAPPER}} .sa-advanced-counter .sa-media-icon',
            ]
        );

        $this->add_responsive_control(
            'img_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_adv_border_radius!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_adv_border_radius',
            [
                'label' => esc_html__('Advanced Border Radius', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'adv_border_radius',
            [
                'label'     => esc_html__('Radius', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons-pro'),
                'dynamic'   => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image img' => 'border-radius: {{VALUE}};',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon'      => 'border-radius: {{VALUE}};'
                ],
                'condition' => [
                    'show_adv_border_radius' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adv_border_radius_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__("You can easily generate Radius value from this link <a href='%1s' target='_blank'> Go </a>.", 'sky-elementor-addons-pro'), "https://9elements.github.io/fancy-border-radius/"),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                    'show_adv_border_radius' => 'yes',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-advanced-counter .sa-media-image img, {{WRAPPER}} .sa-advanced-counter .sa-media-icon',
            ]
        );


        $this->start_controls_tabs('tabs_media_style');

        $this->start_controls_tab(
            'tab_media_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'media_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon i'     => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_bg',
                'label'     => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'     => ['classic', 'gradient'],
                'condition' => [
                    'media_type' => 'icon'
                ],
                'selector'  => '{{WRAPPER}} .sa-advanced-counter .sa-media-icon',
            ]
        );

        $this->add_control(
            'media_opacity',
            [
                'label'     => esc_html__('Opacity', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-icon *'    => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'img_css_filters',
                'selector'  => '{{WRAPPER}} .sa-advanced-counter .sa-media-image img',
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_media_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'media_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}}  > .elementor-widget-container:hover .sa-media-icon i'     => 'color: {{VALUE}}',
                    '{{WRAPPER}}  > .elementor-widget-container:hover .sa-media-icon svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_bg_hover',
                'label'     => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'     => ['classic', 'gradient'],
                'condition' => [
                    'media_type' => 'icon'
                ],
                'selector'  => '{{WRAPPER}}  > .elementor-widget-container:hover .sa-media-icon',
            ]
        );

        $this->add_control(
            'media_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-advanced-counter  .sa-media-image img:hover'        => 'opacity: {{SIZE}};',
                    '{{WRAPPER}}  > .elementor-widget-container:hover .sa-media-icon * ' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'img_css_filters_hover',
                'selector'  => '{{WRAPPER}} .sa-advanced-counter .sa-media-image img:hover',
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'media_transition',
            [
                'label'     => esc_html__('Transition Duration (s)', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-advanced-counter .sa-media-image img'        => 'transition-duration: {{SIZE}}s',
                    '{{WRAPPER}}  > .elementor-widget-container .sa-media-icon *' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );


        $this->add_control(
            'img_hover_animation',
            [
                'label'     => esc_html__('Hover Animation', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'media_type' => 'image'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_number',
            [
                'label'     => esc_html__('Number', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_end_value!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'number_spacing',
            [
                'label'      => esc_html__('Bottom Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-number-count',
            ]
        );

        $this->start_controls_tabs('tabs_number_style');

        $this->start_controls_tab(
            'tab_number_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-number-wrapper' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_number_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'number_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-number-wrapper' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_title',
            [
                'label'     => esc_html__('Title', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => '',
                ]
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

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
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
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-title',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_divider',
            [
                'label'     => esc_html__('Divider', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_divider' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'divider_spacing',
            [
                'label'      => esc_html__('Bottom Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-divider' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_width',
            [
                'label'      => esc_html__('Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-divider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $number_id = 'sa-advanced-counter-number-' . $this->get_id();
        $this->add_render_attribute(
            [
                'advanced-counter' => [
                    'class'         => 'sa-advanced-counter sa-text-center',
                    'data-settings' => [
                        wp_json_encode(
                            [
                                'id'       => $number_id,
                                'endValue' => !empty($settings['counter_end_value']) ? $settings['counter_end_value'] : 0,
                            ]
                        ),
                    ],
                    'data-options'  => [
                        wp_json_encode(
                            array_filter([
                                'startVal'      => !empty($settings['counter_start_value']) ? $settings['counter_start_value'] : '',
                                'decimalPlaces' => !empty($settings['decimal_places']) ? $settings['decimal_places'] : '',
                                'decimal'       => !empty($settings['decimal_symbols']) ? $settings['decimal_symbols'] : '.',
                                'duration'      => (!empty($settings['duration']['size'])) ? $settings['duration']['size'] / 1000 : '', // ms to sec
                                'useEasing'     => $settings['use_easing'] == 'yes' ? true : false,
                                'useGrouping'   => $settings['use_grouping'] == 'yes' ? true : false,
                                'separator'     => (isset($settings['separator']) && !empty($settings['separator'])) ? $settings['separator'] : '',
                                'prefix'        => !empty($settings['prefix']) ? $settings['prefix'] : '',
                                'suffix'        => !empty($settings['suffix']) ? $settings['suffix'] : '',
                                'numerals'      => !empty($settings['numerals']) ? preg_split("/\,/", $settings['numerals']) : '',
                            ])
                        ),
                    ],
                ],
            ]
        );


        if (!empty($settings['image']['url'])) {
            $this->add_render_attribute('image', 'src', $settings['image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['image']));

            if ($settings['img_hover_animation']) {
                $settings['hover_animation'] = $settings['img_hover_animation'];
                $this->add_render_attribute('image', 'class', 'elementor-animation-' . $settings['hover_animation']);
            }
        }
?>

        <div <?php echo $this->get_render_attribute_string('advanced-counter'); ?>>

            <?php if (!empty($settings['image']['url']) && $settings['media_type'] == 'image') : ?>
                <figure class="sa-figure sa-media-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                </figure>
            <?php endif; ?>

            <?php if (!empty($settings['icon']['value']) && $settings['media_type'] == 'icon') : ?>
                <figure class="sa-figure sa-media-icon sa-icon-wrap">
                    <?php
                    Icons_Manager::render_icon($settings['icon'], [
                        'aria-hidden' => 'true',
                        'class'       => 'sa-icon'
                    ]);
                    ?>
                </figure>
            <?php endif; ?>

            <div class="sa-ac-body">
                <?php
                if (!empty($settings['counter_end_value'])) :
                    $this->add_render_attribute('number-wrapper', 'class', 'sa-number-wrapper  sa-mb-3 sa--text-info sa--text');

                    $this->add_render_attribute('counter_end_value', 'id', $number_id);
                    $this->add_render_attribute('counter_end_value', 'class', 'sa-number-count  sa-fs-4 sa-fw-bold');
                    $this->add_inline_editing_attributes('counter_end_value', 'none');

                ?>
                    <div <?php echo $this->get_render_attribute_string('number-wrapper'); ?>>
                        <span <?php echo $this->get_render_attribute_string('counter_end_value'); ?>>
                            <?php echo wp_kses_post($settings['counter_end_value']); ?>
                        </span>
                    </div>

                <?php endif;
                if ($settings['show_divider']) :
                ?>
                    <span class="sa-divider sa-d-inline-block sa-mb-3"></span>
                <?php endif;


                if (!empty($settings['title'])) :
                    $this->add_render_attribute('title', 'class', 'sa-title sa--title sa--text-title sa-fs-5 sa-m-0');
                    $this->add_inline_editing_attributes('title', 'none');

                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        Utils::validate_html_tag($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );

                endif;
                ?>

            </div>
        </div>

<?php
    }
}
