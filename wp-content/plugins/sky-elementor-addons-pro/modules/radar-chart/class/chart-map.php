<?php

namespace Sky_Addons_Pro\Modules\RadarChart;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Sky_Addons_Pro\Traits\Global_Chart;

class Chart_Map {

    use Global_Chart;

    public static function chart_dataset($settings) {

        $datasets = [];
        $items = $settings['chart_dataset'];

        if (!empty($items)) {
            foreach ($items as $item) {
                $point_border_color = !empty($item['point_border_color']) ? $item['point_border_color'] : '#8441A4';

                $item['label']                = !empty($item['label']) ? esc_html($item['label']) : '';
                $item['data']                 = !empty($item['data']) ? array_map('trim', explode(',', $item['data'])) : '';
                $item['fill'] = true;
                $item['backgroundColor']      = !empty($item['background_color']) ? $item['background_color'] : 'rgba(132, 65, 164, 0.7)';
                $item['borderColor']          = !empty($item['border_color']) ? $item['border_color'] : '#E0528D';
                $item['borderWidth']          = !empty($settings["bar_border_width"]["size"]) || ($settings["bar_border_width"]["size"] === 0) ? (int)$settings["bar_border_width"]["size"] : 1;

                $item['pointBorderColor']     = $point_border_color;
                $item['pointHoverBorderColor']     = !empty($item['point_border_color_hover']) ? $item['point_border_color_hover'] : $point_border_color;

                $item['pointBackgroundColor'] = !empty($item['point_background_color']) ? $item['point_background_color'] : '#8441A4';
                $item['pointHoverBackgroundColor'] = !empty($item['point_background_color_hover']) ? $item['point_background_color_hover'] : $point_border_color;

                $item['pointBorderWidth']     = !empty($settings['pointer_border_width']['size']) ? $settings['pointer_border_width']['size'] : 1;

                $datasets[] = $item;
            }
        }

        return $datasets;
    }

    public static function chart_options($settings) {

        $options        = [];
        $plugins        = [];

        $plugins['title']   = self::chart_title($settings);
        $plugins['legend']  = self::chart_legend($settings);
        $plugins['tooltip'] = self::chart_tooltip($settings);

        $grid_color = !empty($settings['grid_color']) ? $settings['grid_color'] : 'rgba(0, 0, 0, 0.1)';

        if ('yes' == $settings['grid_color_advanced'] && isset($settings['grid_multicolor']) && !empty($settings['grid_multicolor'])) {
            $grid_color =  !empty($settings['grid_multicolor']) ? array_map('trim', explode(',', $settings['grid_multicolor'])) : 'rgba(0, 0, 0, 0.1)';
        }

        $options = [
            'animation' => [
                'easing'   => $settings['select_animation'],
                'duration' => !empty($settings['chart_animation_duration']['size']) ? $settings['chart_animation_duration']['size'] : 1000,
            ],
            'layout' => [
                'padding' => [
                    'top'    => !empty($settings['layout_padding']['top']) ? $settings['layout_padding']['top'] : 0,
                    'right'  => !empty($settings['layout_padding']['right']) ? $settings['layout_padding']['right'] : 0,
                    'bottom' => !empty($settings['layout_padding']['bottom']) ? $settings['layout_padding']['bottom'] : 0,
                    'left'   => !empty($settings['layout_padding']['left']) ? $settings['layout_padding']['left'] : 0
                ]
            ],
            'maintainAspectRatio' => false,
            'scales'              => [
                'r' => [
                    'grid' => [
                        'color' => $grid_color
                    ],
                    'ticks' => [
                        'color' => !empty($settings['ticks_font_color']) ? $settings['ticks_font_color'] : '#666',
                        'font'  => [
                            'family' => !empty($settings['ticks_font_family']) ? $settings['ticks_font_family'] : 'auto',
                            'size'   => !empty($settings['ticks_font_size']['size']) ? $settings['ticks_font_size']['size'] : 14,
                            'style'  => (!empty($settings['ticks_font_style']) ? $settings['ticks_font_style'] : '') . ' ' . (!empty($settings['ticks_font_weight']) ? $settings['ticks_font_weight'] : ''),
                        ],
                    ],
                    'pointLabels' => [
                        'color' => !empty($settings['point_labels_font_color']) ? $settings['point_labels_font_color'] : '#666',
                        'font'  => [
                            'family' => !empty($settings['point_labels_font_family']) ? $settings['point_labels_font_family'] : 'auto',
                            'size'   => !empty($settings['point_labels_font_size']['size']) ? $settings['point_labels_font_size']['size'] : 12,
                            'style'  => (!empty($settings['point_labels_font_style']) ? $settings['point_labels_font_style'] : '') . ' ' . (!empty($settings['point_labels_font_weight']) ? $settings['point_labels_font_weight'] : ''),
                        ],
                    ],
                    'angleLines' => [
                        'color' => !empty($settings['angle_lines_color']) ? $settings['angle_lines_color'] : 'rgba(0, 0, 0, 0.1)',
                    ]
                ],
            ],
            'elements' => [
                'line' => [
                    'tension' => ($settings['line_tension']['size'] !== '') ? $settings['line_tension']['size'] : 0
                ]
            ]
        ];

        if ('bar_horizontal' == $settings['chart_type']) {
            $options['indexAxis'] = 'y';
        }

        $options['plugins'] = $plugins;

        return $options;
    }

    public static function chart_initial($settings) {

        $data_settings = json_encode(
            [
                'type'    => 'radar',
                'data'    => [
                    'labels'   => explode(',', esc_html($settings['labels'])),
                    'datasets' => self::chart_dataset($settings),
                ],
                'options' => self::chart_options($settings)
            ]
        );

        return $data_settings;
    }
}
