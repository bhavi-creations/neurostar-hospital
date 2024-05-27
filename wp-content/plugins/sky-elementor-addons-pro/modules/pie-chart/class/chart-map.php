<?php

namespace Sky_Addons_Pro\Modules\PieChart;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Sky_Addons_Pro\Traits\Global_Chart;

class Chart_Map {

    use Global_Chart;

    public static function chart_dataset($settings) {

        $datasets = [];
        $items = $settings['chart_dataset'];
        $datasets['data']  = [];
        $datasets['backgroundColor']  = [];
        $datasets['hoverBackgroundColor']  = [];

        if (!empty($items)) {
            foreach ($items as $item) {
                $datasets['data'][]                 = !empty($item['data']) ?  $item['data'] : '';
                $datasets['backgroundColor'][]      = !empty($item['background_color']) ? $item['background_color'] : 'rgba(132, 65, 164, 0.7)';
                $datasets['hoverBackgroundColor'][] = !empty($item['hover_background_color']) ? $item['hover_background_color'] : '#8441A4';
                $datasets['borderWidth']            = !empty($settings["bar_border_width"]["size"]) || ($settings["bar_border_width"]["size"] === 0) ? (int)$settings["bar_border_width"]["size"] : 0;
                $datasets['borderColor'][]          = !empty($item['border_color']) ? $item['border_color'] : '#E0528D';
                $datasets['hoverBorderColor'][]     = !empty($item['hover_border_color']) ? $item['hover_border_color'] : '#E0528D';
                $datasets['hoverOffset'][]            = !empty($item["hover_offset"]["size"]) || ($item["hover_offset"]["size"] === 0) ? (int)$item["hover_offset"]["size"] : 4;
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
        ];

        $options['plugins'] = $plugins;

        return $options;
    }

    public static function chart_initial($settings) {

        $labels = [];
        $items = $settings['chart_dataset'];

        if (!empty($items)) {
            foreach ($items as $item) {
                $labels[] = !empty($item['label']) ? esc_html($item['label']) : '';
            }
        }

        $data_settings = json_encode(
            [
                'type'    => $settings['chart_type'],
                'data'    => [
                    'labels'   => $labels,
                    'datasets' => [self::chart_dataset($settings)],
                ],
                'options' => self::chart_options($settings)
            ]
        );

        return $data_settings;
    }
}
