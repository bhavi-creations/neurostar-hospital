<?php

namespace Sky_Addons_Pro\Traits;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

trait Global_Chart {

    protected function global_chart_typo_controls($name, $popover_name = 'Typography') {

        $this->add_control(
            $name . '_popover_toggle',
            [
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label'        => esc_html__($popover_name, 'sky-elementor-addons-pro'),
                'label_off'    => esc_html__('Default', 'sky-elementor-addons-pro'),
                'label_on'     => esc_html__('Custom', 'sky-elementor-addons-pro'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_control(
            $name . '_font_size',
            [
                'label'      => esc_html__('Font Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    $name . '_popover_toggle' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $name . '_font_family',
            [
                'label'     => esc_html__('Font Family', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::FONT,
                'default'   => '',
                'condition' => [
                    $name . '_popover_toggle' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $name . '_font_weight',
            [
                'label'   => esc_html__('Font Weight', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__('Default', 'sky-elementor-addons'),
                    'normal' => esc_html__('Normal', 'sky-elementor-addons'),
                    'bold'   => esc_html__('Bold', 'sky-elementor-addons'),
                    '300'    => esc_html__('300', 'sky-elementor-addons'),
                    '400'    => esc_html__('400', 'sky-elementor-addons'),
                    '600'    => esc_html__('600', 'sky-elementor-addons'),
                    '700'    => esc_html__('700', 'sky-elementor-addons')
                ],
                'condition' => [
                    $name . '_popover_toggle' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $name . '_font_style',
            [
                'label'   => esc_html__('Font Style', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''        => esc_html__('Default', 'sky-elementor-addons'),
                    'normal'  => esc_html__('Normal', 'sky-elementor-addons'),
                    'italic'  => esc_html__('Italic', 'sky-elementor-addons'),
                    'oblique' => esc_html__('Oblique', 'sky-elementor-addons'),
                ],
                'condition' => [
                    $name . '_popover_toggle' => 'yes'
                ]
            ]
        );

        $this->end_popover();
    }

    protected function global_chart_grid_multicolor_controls() {
        $this->add_control(
            'grid_color',
            [
                'label'     => esc_html__('Grid Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition'    => [
                    'grid_color_advanced!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'grid_color_advanced',
            [
                'label'        => esc_html__('Grid Advanced Color', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'grid_multicolor',
            [
                'label'       => esc_html__('Colors', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => '#8441A4, #E0528D, #7A7A7A, #61CE70',
                'placeholder' => esc_html__('#8441A4, #E0528D, #7A7A7A, #61CE70', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'grid_color_advanced' => 'yes',
                ],
            ]
        );
    }

    protected function global_chart_tooltip_controls() {
        $this->add_responsive_control(
            'tooltip_content_alignment',
            [
                'label'   => esc_html__('Alignment', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
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
                ],
            ]
        );

        $this->add_control(
            'tooltip_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'tooltip_background',
            [
                'label'     => esc_html__('Background Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'tooltip_border_color',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tooltip_border_width',
            [
                'label'      => esc_html__('Border Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'tooltip_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'tooltip_caret_size',
            [
                'label'      => esc_html__('Caret Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
            ]
        );

        $this->add_control(
            'tooltip_title_font_color',
            [
                'label'     => esc_html__('Title Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tooltip_title_bottom_spacing',
            [
                'label'      => esc_html__('Title Bottom Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->global_chart_typo_controls('tooltip_title', 'Title Typography');

        $this->add_control(
            'tooltip_body_font_color',
            [
                'label'     => esc_html__('Body Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
            ]
        );

        $this->global_chart_typo_controls('tooltip_body', 'Body Typography');
    }

    public static function chart_tooltip($settings) {
        $tooltip = [];

        if ('yes' !== $settings['show_tooltip']) {
            return $tooltip['enabled'] = false;
        }

        $tooltip = [
            'enabled'         => true,
            'backgroundColor' => !empty($settings['tooltip_background']) ? $settings['tooltip_background'] : 'rgba(0, 0, 0, .8)',
            'titleColor'      => !empty($settings['tooltip_title_font_color']) ? $settings['tooltip_title_font_color'] : '#fff',
            'titleFont'       => [
                'size'   => !empty($settings['tooltip_title_font_size']['size']) ? $settings['tooltip_title_font_size']['size'] : 12,
                'family' => !empty($settings['tooltip_title_font_family']) ? $settings['tooltip_title_font_family'] : 'auto',
                'style'  => (!empty($settings['tooltip_title_font_style']) ? $settings['tooltip_title_font_style'] : '') . ' ' . (!empty($settings['tooltip_title_font_weight']) ? $settings['tooltip_title_font_weight'] : ''),
            ],
            'bodyColor' => !empty($settings['tooltip_body_font_color']) ? $settings['tooltip_body_font_color'] : '#fff',
            'bodyFont'  => [
                'size'   => !empty($settings['tooltip_body_font_size']['size']) ? $settings['tooltip_body_font_size']['size'] : 12,
                'family' => !empty($settings['tooltip_body_font_family']) ? $settings['tooltip_body_font_family'] : 'auto',
                'style'  => (!empty($settings['tooltip_body_font_style']) ? $settings['tooltip_body_font_style'] : '') . ' ' . (!empty($settings['tooltip_body_font_weight']) ? $settings['tooltip_body_font_weight'] : ''),
            ],
            'titleAlign'        => !empty($settings['tooltip_content_alignment']) ? $settings['tooltip_content_alignment'] : 'left',
            'bodyAlign'         => !empty($settings['tooltip_content_alignment']) ? $settings['tooltip_content_alignment'] : 'left',
            'titleMarginBottom' => !empty($settings['tooltip_title_bottom_spacing']['size']) ? $settings['tooltip_title_bottom_spacing']['size'] : 6,
            'padding'           => [
                'top'    => !empty($settings['tooltip_padding']['top']) ? $settings['tooltip_padding']['top'] : 6,
                'right'  => !empty($settings['tooltip_padding']['right']) ? $settings['tooltip_padding']['right'] : 6,
                'bottom' => !empty($settings['tooltip_padding']['bottom']) ? $settings['tooltip_padding']['bottom'] : 6,
                'left'   => !empty($settings['tooltip_padding']['left']) ? $settings['tooltip_padding']['left'] : 6
            ],
            'borderColor'  => !empty($settings['tooltip_border_color']) ? $settings['tooltip_border_color'] : 'rgba(0, 0, 0, 0.1)',
            'borderWidth'  => !empty($settings["tooltip_border_width"]["size"]) || ($settings["tooltip_border_width"]["size"] === 0) ? (int)$settings["tooltip_border_width"]["size"] : 0,
            'cornerRadius' => !empty($settings["tooltip_border_radius"]["size"]) || ($settings["tooltip_border_radius"]["size"] === 0) ? (int)$settings["tooltip_border_radius"]["size"] : 6,
            'caretSize'    => !empty($settings['tooltip_caret_size']['size']) ? $settings['tooltip_caret_size']['size'] : 5,
        ];

        return $tooltip;
    }

    public static function chart_title($settings) {
        $title = [];

        if ('yes' !== $settings['show_title'] || empty($settings['chart_title'])) {
            return $title['display'] = false;
        }

        $title['display'] = true;
        if (!empty($settings['chart_title'])) {
            $title['text'] = $settings['chart_title'];
        }
        if (!empty($settings['title_font_color'])) {
            $title['color'] = $settings['title_font_color'];
        }
        if (!empty($settings['title_font_size'])) {
            $title['font']['size'] = $settings['title_font_size']['size'];
        }
        if (!empty($settings['title_font_family'])) {
            $title['font']['family'] = $settings['title_font_family'];
        }
        if (!empty($settings['title_font_style'])) {
            $title['font']['style'] = (!empty($settings['title_font_style']) ? $settings['title_font_style'] : '') . ' ' . (!empty($settings['title_font_weight']) ? $settings['title_font_weight'] : '');
        }
        return $title;
    }

    public static function chart_legend($settings) {
        $legend = [];

        if ('yes' !== $settings['show_legend']) {
            return $legend['display'] = false;
        }

        $legend['display'] = true;

        $legend['position'] = !empty($settings['legend_position']) ? $settings['legend_position'] : 'top';
        $legend['reverse']  = $settings['legend_reverse'] == 'yes' ? true : false;

        $legend_style = [
            'color' => !empty($settings['legend_font_color']) ? $settings['legend_font_color'] : '#666',
            'font'  => [
                'size'     => !empty($settings['legend_font_size']['size']) ? $settings['legend_font_size']['size'] : 12,
                'family'   => !empty($settings['legend_font_family']) ? $settings['legend_font_family'] : 'auto',
                'style'    => (!empty($settings['legend_font_style']) ? $settings['legend_font_style'] : '') . ' ' . (!empty($settings['legend_font_weight']) ? $settings['legend_font_weight'] : ''),
            ],
            'boxHeight' => !empty($settings['legend_box_height']['size']) ? $settings['legend_box_height']['size'] : (!empty($settings['legend_font_size']['size']) ? $settings['legend_font_size']['size'] : 12),
            'boxWidth'  => !empty($settings['legend_box_width']['size']) ? $settings['legend_box_width']['size'] : 40,
        ];

        $legend['labels'] = $legend_style;

        return $legend;
    }
}
