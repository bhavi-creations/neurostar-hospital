<?php

namespace Sky_Addons_Pro\Modules\LineChart;

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
                $item['label']                = !empty($item['label']) ? esc_html($item['label']) : '';
                $item['data']                 = !empty($item['data']) ? array_map('trim', explode(',', $item['data'])) : '';
                $item['backgroundColor']      = !empty($item['background_color']) ? $item['background_color'] : 'rgba(132, 65, 164, 0.7)';
                $item['borderColor']          = !empty($item['border_color']) ? $item['border_color'] : '#E0528D';
                $item['borderWidth']          = !empty($settings["bar_border_width"]["size"]) || ($settings["bar_border_width"]["size"] === 0) ? (int)$settings["bar_border_width"]["size"] : 0;

                $item['fill']                 = $item['background_fill'] == 'yes' ? true : false;
                $item['borderDash']           = !empty($item['dash_border']) ? array_map('trim', explode(',', $item['dash_border'])) : [];
                $item['pointStyle']           = ($settings['point_style'] !== '') ? $settings['point_style'] : 'circle';
                $item['pointBorderColor']     = ($item['point_color'] !== '') ? $item['point_color'] : '#E0528D';
                $item['pointBorderWidth']     = ($settings['point_border_width']['size'] !== '') ? $settings['point_border_width']['size'] : 0;
                $item['tension']           = ($settings['line_tension']['size'] !== '') ? $settings['line_tension']['size'] : 0.5;

                $datasets[] = $item;
            }
        }

        return $datasets;
    }

    public static function chart_options($settings) {

        $options        = [];
        $plugins        = [];

        $show_xaxes_grid = ('yes' == $settings['show_xaxes_grid']) ? true : false;
        $show_yaxes_grid = ('yes' == $settings['show_yaxes_grid']) ? true : false;

        $plugins['title']   = self::chart_title($settings);
        $plugins['legend']  = self::chart_legend($settings);
        $plugins['tooltip'] = self::chart_tooltip($settings);

        if ('yes' == $show_xaxes_grid) {
            $xaxes_gridLines = [
                'drawBorder' => false,
                'color'      => !empty($settings['xaxes_grid_color']) ? $settings['xaxes_grid_color'] : '#eeeeee',
            ];
        } else {
            $xaxes_gridLines = ['display' => false];
        }

        if ('yes' == $show_yaxes_grid) {
            $yaxes_gridLines = [
                'drawBorder' => false,
                'color'      => !empty($settings['yaxes_grid_color']) ? $settings['yaxes_grid_color'] : '#eeeeee',
            ];
        } else {
            $yaxes_gridLines = ['display' => false];
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
                'x' => [
                    'ticks' => [
                        'display'  => $settings['show_xaxes_labels'] == 'yes' ? true : false,
                        'stepSize' => isset($settings['step_size']) ? $settings['step_size'] : 1,
                        'color'    => !empty($settings['labels_xaxes_font_color']) ? $settings['labels_xaxes_font_color'] : '#222',
                        'font'     => [
                            'family' => !empty($settings['labels_xaxes_font_family']) ? $settings['labels_xaxes_font_family'] : 'auto',
                            'size'   => !empty($settings['labels_xaxes_font_size']['size']) ? $settings['labels_xaxes_font_size']['size'] : 12,
                            'style'  => (!empty($settings['labels_xaxes_font_style']) ? $settings['labels_xaxes_font_style'] : '') . ' ' . (!empty($settings['labels_xaxes_font_weight']) ? $settings['labels_xaxes_font_weight'] : ''),
                        ],
                        'padding' => !empty($settings['labels_padding']['size']) ? $settings['labels_padding']['size'] : 10,
                    ],
                    'grid' => $xaxes_gridLines,
                ],
                'y' => [
                    'ticks' => [
                        'display'  => $settings['show_yaxes_labels'] == 'yes' ? true : false,
                        'stepSize' => isset($settings['step_size']) ? $settings['step_size'] : 1,
                        'color'    => !empty($settings['labels_yaxes_font_color']) ? $settings['labels_yaxes_font_color'] : '#222',
                        'font'     => [
                            'family' => !empty($settings['labels_yaxes_font_family']) ? $settings['labels_yaxes_font_family'] : 'auto',
                            'size'   => !empty($settings['labels_yaxes_font_size']['size']) ? $settings['labels_yaxes_font_size']['size'] : 12,
                            'style'  => (!empty($settings['labels_yaxes_font_style']) ? $settings['labels_yaxes_font_style'] : '') . ' ' . (!empty($settings['labels_yaxes_font_weight']) ? $settings['labels_yaxes_font_weight'] : ''),
                        ],
                        'padding' => !empty($settings['labels_padding']['size']) ? $settings['labels_padding']['size'] : 10,
                    ],
                    'grid' => $yaxes_gridLines,
                ],
            ],
            // todo - below animation working. If find great then use it or delete it.
            // 'animations' => [
            //     'tension' => [
            //         'duration' => 1000,
            //         'easing' => 'linear',
            //         'form' => 1,
            //         'to' => 0,
            //         'loop' => true
            //     ]
            // ]
        ];

        $options['plugins'] = $plugins;

        return $options;
    }

    public static function chart_initial($settings) {

        $data_settings = json_encode(
            [
                'type'    => 'line',
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
