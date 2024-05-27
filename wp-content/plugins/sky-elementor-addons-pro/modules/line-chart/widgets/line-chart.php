<?php

namespace Sky_Addons_Pro\Modules\LineChart\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

use Sky_Addons_Pro\Modules\LineChart\Chart_Map;
use Sky_Addons_Pro\Traits\Global_Chart;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Line_Chart extends Widget_Base {

    use Global_Chart;

    public function get_name() {
        return 'sky-line-chart';
    }

    public function get_title() {
        return esc_html__('Line Chart', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-line-chart';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords() {
        return ['line', 'chart', 'graph', 'business', 'sky'];
    }

    public function get_script_depends() {
        return ['chart'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Line Chart', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'chart_height',
            [
                'label' => esc_html__('Chart Height (px)', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
                'selectors'   => [
                    '{{WRAPPER}} .sa-global-chart' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'labels',
            [
                'label'       => esc_html__('Label Values', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'label_block' => true,
                'default'     => esc_html__('January, February, March, April, May, June, July, August', 'sky-elementor-addons-pro'),
                'description' => esc_html__('Write multiple label with comma ( , ) separator. Example: January, February, March etc', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            'dataset_tabs'
        );

        $repeater->start_controls_tab(
            'dataset_content_tab',
            [
                'label' => esc_html__('Content', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'label',
            [
                'label'       => esc_html__('Label', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => esc_html__('Dataset Label', 'sky-elementor-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'data',
            [
                'label'       => esc_html__('Data', 'sky-elementor-addons-pro'),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'description' => esc_html__('Write data values with comma ( , ) separator. Example: 2, 4, 8', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'dataset_style_tab',
            [
                'label' => esc_html__('Style', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'dash_border',
            [
                'label'       => __('Dash Border', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'background_fill',
            [
                'label'        => __('Background Fill', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::COLOR,
                'condition' => [
                    'background_fill' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'point_color',
            [
                'label' => __('Point Color', 'sky-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'chart_dataset',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'label'                  => esc_html__('Sky Addons', 'sky-elementor-addons-pro'),
                        'data'                   => esc_html__('25,20,15,14,17,23,30,35', 'sky-elementor-addons-pro'),
                        'background_color'       => 'rgba(132, 65, 164, 0.1)',
                        'border_color'           => '#8441A4', //
                        'hover_border_color'     => 'red',
                        'point_color'       => '#8441A4',
                    ],
                    [
                        'label'                  => esc_html__('Sky Addons Pro', 'sky-elementor-addons-pro'),
                        'data'                   => esc_html__('10,15,20,22,20,15,18,25', 'sky-elementor-addons-pro'),
                        'background_color'       => 'rgba(224, 82, 141, 0.2)',
                        'border_color'           => '#E0528D',
                        'point_color'       => '#E0528D',
                        // 'dash_border'        => esc_html__('1, 2', 'sky-elementor-addons-pro'),
                    ]
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'chart_additional',
            [
                'label' => esc_html__('Additional', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'show_xaxes_labels',
            [
                'label'        => esc_html__('X Axes Labels', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_yaxes_labels',
            [
                'label'        => esc_html__('Y Axes Labels', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_xaxes_grid',
            [
                'label'        => esc_html__('X Axes Grid Lines', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_yaxes_grid',
            [
                'label'        => esc_html__('Y Axes Grid Lines', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_tooltip',
            [
                'label'        => esc_html__('Show Tooltips', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'        => esc_html__('Show Title', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'chart_title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__('Sky Addons for Elementor', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'show_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'step_size',
            [
                'label'       => esc_html__('Step Size', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'legend_heading',
            [
                'label'     => esc_html__('L E G E N D', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_legend',
            [
                'label'        => esc_html__('Show Legend', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'legend_position',
            [
                'label'   => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'    => esc_html__('Top', 'sky-elementor-addons-pro'),
                    'left'   => esc_html__('Left', 'sky-elementor-addons-pro'),
                    'bottom' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                    'right'  => esc_html__('Right', 'sky-elementor-addons-pro'),
                ],
                'condition' => [
                    'show_legend' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'legend_reverse',
            [
                'label'        => esc_html__('Reverse', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'show_legend' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'chart_animation',
            [
                'label' => esc_html__('Animation', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'select_animation',
            [
                'label'   => esc_html__('Select Animation', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear'       => esc_html__('Linear', 'sky-elementor-addons-pro'),
                    'easeInCubic'  => esc_html__('Ease In Cubic', 'sky-elementor-addons-pro'),
                    'easeInCirc'   => esc_html__('Ease In Circ', 'sky-elementor-addons-pro'),
                    'easeInBounce' => esc_html__('Ease In Bounce', 'sky-elementor-addons-pro'),
                ]
            ]
        );

        $this->add_control(
            'chart_animation_duration',
            [
                'label' => esc_html__('Duration (ms)', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10000,
                        'step' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_chart',
            [
                'label'     => esc_html__('Chart', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'xaxes_grid_color',
            [
                'label'     => esc_html__('X Axes Grid Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'show_xaxes_grid' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'yaxes_grid_color',
            [
                'label'     => esc_html__('Y Axes Grid Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'show_yaxes_grid' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'bar_border_width',
            [
                'label'      => esc_html__('Line Border Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
            ]
        );

        $this->add_control(
            'line_tension',
            [
                'label' => esc_html__('Line Tension', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1,
                    ],
                ],
            ]
        );

        $this->add_control(
            'point_border_width',
            [
                'label'     => esc_html__('Point Border Width', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
            ]
        );

        $this->add_control(
            'point_style',
            [
                'label'   => esc_html__('Point Style', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle'   => esc_html__('Circle', 'sky-elementor-addons-pro'),
                    'cross'    => esc_html__('Cross', 'sky-elementor-addons-pro'),
                    'dash'     => esc_html__('Dash', 'sky-elementor-addons-pro'),
                    'line'     => esc_html__('Line', 'sky-elementor-addons-pro'),
                    'react'    => esc_html__('React', 'sky-elementor-addons-pro'),
                    'rectRounded'    => esc_html__('React Rounded', 'sky-elementor-addons-pro'),
                    'rectRot'  => esc_html__('Rect Rot', 'sky-elementor-addons-pro'),
                    'triangle' => esc_html__('Triangle', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_title',
            [
                'label'     => esc_html__('Title', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title'   => 'yes',
                    'chart_title!' => '',
                ]
            ]
        );

        $this->add_control(
            'title_font_color',
            [
                'label' => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::COLOR,
            ]
        );

        $this->global_chart_typo_controls('title');

        $this->end_controls_section();


        $this->start_controls_section(
            'style_legend',
            [
                'label'     => esc_html__('Legend', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_legend' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'legend_font_color',
            [
                'label' => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'legend_box_height',
            [
                'label'      => esc_html__('Box Height', 'sky-elementor-addons-pro'),
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
            'legend_box_width',
            [
                'label'      => esc_html__('Box Width', 'sky-elementor-addons-pro'),
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

        $this->global_chart_typo_controls('legend');

        $this->end_controls_section();

        $this->start_controls_section(
            'style_labels',
            [
                'label'     => esc_html__('Labels', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_xaxes_labels' => 'yes',
                    'show_yaxes_labels' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'labels_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
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
            'labels_xaxes_font_color',
            [
                'label'     => esc_html__('X Axes Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'show_xaxes_labels' => 'yes',
                ]
            ]
        );

        $this->global_chart_typo_controls('labels_xaxes', 'X Axes Typography');

        $this->add_control(
            'labels_yaxes_font_color',
            [
                'label'     => esc_html__('Y Axes Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'show_yaxes_labels' => 'yes',
                ]
            ]
        );

        $this->global_chart_typo_controls('labels_yaxes', 'Y Axes Typography');

        $this->end_controls_section();

        $this->start_controls_section(
            'style_tooltip',
            [
                'label'     => esc_html__('Tooltip', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_tooltip' => 'yes',
                ]
            ]
        );

        $this->global_chart_tooltip_controls();

        $this->end_controls_section();
    }

    protected function render() {
        include_once SKY_ADDONS_PRO_MODULES_PATH . 'line-chart/class/chart-map.php';

        $settings  = $this->get_settings_for_display();
        $id        = 'sa-chart-' . $this->get_id();
        $canvas_id = $id . '-canvas';

        $this->add_render_attribute(
            'container',
            [
                'id'                   => $id,
                'class'                => 'sa-line-chart sa-global-chart',
                'data-settings'        => Chart_Map::chart_initial($settings),
                'data-widget-settings' => [
                    wp_json_encode(array_filter([
                        'id'     => '#' . $id,
                        'canvas' => '#' . $canvas_id,
                    ]))
                ]
            ]
        );

        $this->add_render_attribute(
            'canvas',
            [
                'id'   => $canvas_id,
                'role' => 'img',
            ]
        );


?>
        <div <?php $this->print_render_attribute_string('container'); ?>>

            <canvas <?php $this->print_render_attribute_string('canvas'); ?>></canvas>

        </div>
<?php
    }
}
