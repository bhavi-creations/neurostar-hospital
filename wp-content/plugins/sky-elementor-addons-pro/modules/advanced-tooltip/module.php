<?php

namespace Sky_Addons_Pro\Modules\AdvancedTooltip;

use Elementor\Controls_Manager;
use Sky_Addons_Pro;
use Sky_Addons_Pro\Base\Module_Base;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined('ABSPATH') ) {
    exit;
}

/**
 * Module Class
 * ad = advanced
 */

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        $this->add_actions();
    }

    public function get_name() {
        return 'sky-advanced-tooltip';
    }

    public function register_section($element) {
        $element->start_controls_section(
            'section_sky_addons_pro_advanced_tooltip_controls', [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__('Advanced Tooltip', 'sky-elementor-addons-pro') . sky_addons_pro_get_icon(),
            ]
        );
        $element->end_controls_section();
    }

    public function register_controls($widget, $args) {

        $widget->add_control(
            'sa_ad_tooltip_enable', [
                'label'              => esc_html__('Enable', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $widget->start_controls_tabs('sa_ad_tooltip_tabs');

        $widget->start_controls_tab(
            'sa_ad_tooltip_settings_tab', [
                'label'     => esc_html__('Settings', 'sky-elementor-addons-pro'),
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_content', [
                'label'              => esc_html__('Content', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXTAREA,
                'rows'               => 10,
                'default'            => esc_html__('I\'m Tooltip text.', 'sky-elementor-addons-pro'),
                'placeholder'        => esc_html__('Type your content here', 'sky-elementor-addons-pro'),
                'dynamic'            => ['active' => true],
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_placement', [
                'label'              => esc_html__('Placement', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'top',
                'options'            => [
                        'top'          => esc_html__('Top (Default)', 'sky-elementor-addons-pro'),
                        'top-start'    => esc_html__('Top-start', 'sky-elementor-addons-pro'),
                        'top-end'      => esc_html__('Top-end', 'sky-elementor-addons-pro'),
                        //right
                        'right'        => esc_html__('Right', 'sky-elementor-addons-pro'),
                        'right-start'  => esc_html__('Right-start', 'sky-elementor-addons-pro'),
                        'right-end'    => esc_html__('Right-end', 'sky-elementor-addons-pro'),
                        //bottom
                        'bottom'       => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'bottom-start' => esc_html__('Bottom-start', 'sky-elementor-addons-pro'),
                        'bottom-end'   => esc_html__('Bottom-end', 'sky-elementor-addons-pro'),
                        //left
                        'left'         => esc_html__('Left', 'sky-elementor-addons-pro'),
                        'left-start'   => esc_html__('Left-start', 'sky-elementor-addons-pro'),
                        'left-end'     => esc_html__('Left-end', 'sky-elementor-addons-pro'),
                        //auto
                        'auto'         => esc_html__('Auto', 'sky-elementor-addons-pro'),
                        'auto-start'   => esc_html__('Auto-start', 'sky-elementor-addons-pro'),
                        'auto-end'     => esc_html__('Auto-end', 'sky-elementor-addons-pro'),
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_offset_toggle', [
                'label'              => esc_html__('Offset', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::POPOVER_TOGGLE,
                'label_off'          => esc_html__('Default', 'sky-elementor-addons-pro'),
                'label_on'           => esc_html__('Custom', 'sky-elementor-addons-pro'),
                'return_value'       => 'yes',
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->start_popover();

        $widget->add_control(
            'sa_ad_tooltip_offset_x', [
                'label'              => esc_html__('Offset X', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min'  => -1000,
                                'step' => 2,
                                'max'  => 1000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'        => 'yes',
                        'sa_ad_tooltip_offset_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_offset_y', [
                'label'              => esc_html__('Offset Y', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min'  => -1000,
                                'step' => 2,
                                'max'  => 1000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'        => 'yes',
                        'sa_ad_tooltip_offset_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->end_popover();


        $widget->add_control(
            'sa_ad_tooltip_delay_toggle', [
                'label'              => esc_html__('Delay', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::POPOVER_TOGGLE,
                'label_off'          => esc_html__('Default', 'sky-elementor-addons-pro'),
                'label_on'           => esc_html__('Custom', 'sky-elementor-addons-pro'),
                'return_value'       => 'yes',
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->start_popover();

        $widget->add_control(
            'sa_ad_tooltip_delay_show', [
                'label'              => esc_html__('Show Delay (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min' => 0,
                                'max' => 5000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'       => 'yes',
                        'sa_ad_tooltip_delay_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_delay_hide', [
                'label'              => esc_html__('Hide Delay (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min' => 0,
                                'max' => 5000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'       => 'yes',
                        'sa_ad_tooltip_delay_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->end_popover();

        $widget->add_control(
            'sa_ad_tooltip_follow_cursor', [
                'label'              => esc_html__('Follow Cursor', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_arrow', [
                'label'              => esc_html__('Show Arrow', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_animation', [
                'label'              => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'fade',
                'options'            => [
                        'fade'                 => esc_html__('Fade (Default', 'sky-elementor-addons-pro'),
                        //shift-away
                        'shift-away'           => esc_html__('Shift Away', 'sky-elementor-addons-pro'),
                        'shift-away-subtle'    => esc_html__('Shift Away Subtle', 'sky-elementor-addons-pro'),
                        'shift-away-extreme'   => esc_html__('Shift Away Extreme', 'sky-elementor-addons-pro'),
                        //shift-toward
                        'shift-toward'         => esc_html__('Shift Toward', 'sky-elementor-addons-pro'),
                        'shift-toward-subtle'  => esc_html__('Shift Toward Subtle', 'sky-elementor-addons-pro'),
                        'shift-toward-extreme' => esc_html__('Shift Toward Extreme', 'sky-elementor-addons-pro'),
                        //scale
                        'scale'                => esc_html__('Scale', 'sky-elementor-addons-pro'),
                        'scale-subtle'         => esc_html__('Scale Subtle', 'sky-elementor-addons-pro'),
                        'scale-extreme'        => esc_html__('Scale Extreme', 'sky-elementor-addons-pro'),
                        //perspective
                        'perspective'          => esc_html__('Perspective', 'sky-elementor-addons-pro'),
                        'perspective-subtle'   => esc_html__('Perspective Subtle', 'sky-elementor-addons-pro'),
                        'perspective-extreme'  => esc_html__('Perspective Extreme', 'sky-elementor-addons-pro'),
                        //extra
                        'fill'                 => esc_html__('Animate Fill', 'sky-elementor-addons-pro'),
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_anim_duration_toggle', [
                'label'              => esc_html__('Animation Duration', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::POPOVER_TOGGLE,
                'label_off'          => esc_html__('Default', 'sky-elementor-addons-pro'),
                'label_on'           => esc_html__('Custom', 'sky-elementor-addons-pro'),
                'return_value'       => 'yes',
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->start_popover();

        $widget->add_control(
            'sa_ad_tooltip_anim_duration_show', [
                'label'              => esc_html__('Show (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min' => 0,
                                'max' => 5000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'               => 'yes',
                        'sa_ad_tooltip_anim_duration_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_anim_duration_hide', [
                'label'              => esc_html__('Hide (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                        'px' => [
                                'min' => 0,
                                'max' => 5000,
                        ],
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable'               => 'yes',
                        'sa_ad_tooltip_anim_duration_toggle' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->end_popover();


        $widget->add_control(
            'sa_ad_tooltip_hide_on_click', [
                'label'              => esc_html__('Hide On Click', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'true',
                'options'            => [
                        'true'   => esc_html__('Yes (Default)', 'sky-elementor-addons-pro'),
                        'false'  => esc_html__('No', 'sky-elementor-addons-pro'),
                        'toggle' => esc_html__('Toggle', 'sky-elementor-addons-pro'),
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_hide_on_click_note', [
                'label'           => esc_html__('', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Determines if the Tooltip hides upon clicking the reference or outside of the tippy. The behavior can depend upon the trigger events used.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'condition'       => [
                        'sa_ad_tooltip_enable' => 'yes',
                ],
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_interactive', [
                'label'              => esc_html__('Interactive?', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_interactive_note', [
                'label'           => esc_html__('', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Determines if the Tooltip has interactive content inside of it, so that it can be hovered over and clicked inside without hiding.<strong>It\'s will only appear on preview mode. Sometimes it\'s not working on small element.</strong>', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                        'sa_ad_tooltip_enable' => 'yes',
                ],
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_trigger', [
                'label'              => esc_html__('Trigger', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '',
                'options'            => [
                        ''      => esc_html__('Hover (Default)', 'sky-elementor-addons-pro'),
                        'click' => esc_html__('Click', 'sky-elementor-addons-pro'),
                ],
                'condition'          => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_trigger_custom', [
                'label'              => esc_html__('Custom Trigger Elements?', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'condition'          => [
                        'sa_ad_tooltip_enable'         => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_trigger_custom_selector', [
                'label'              => esc_html__('Custom Trigger Selector', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXT,
                'placeholder'        => esc_html__('#trigger-id, .trigger-class', 'sky-elementor-addons-pro'),
                'dynamic'            => ['active' => true],
                'label_block'        => true,
                'condition'          => [
                        'sa_ad_tooltip_enable'         => 'yes',
                        'sa_ad_tooltip_trigger_custom' => 'yes'
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_trigger_custom_note', [
                'label'           => '',
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('The element(s) that the trigger event listeners are added to. Allows you to separate the Tooltip positioning from its trigger source.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                        'sa_ad_tooltip_enable'         => 'yes',
                        'sa_ad_tooltip_trigger_custom' => 'yes'
                ],
            ]
        );

        $widget->end_controls_tab();

        $widget->start_controls_tab(
            'sa_ad_tooltip_style_tab', [
                'label'     => esc_html__('Style', 'sky-elementor-addons-pro'),
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_responsive_control(
            'sa_ad_tooltip_max_width', [
                'label'      => esc_html__('Max Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                        'px' => [
                                'min' => 0,
                                'max' => 1000,
                        ],
                ],
                'selectors'  => [
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]' => 'max-width: calc({{SIZE}}{{UNIT}} - 10px) !important;',
                ],
                'condition'  => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_responsive_control(
            'sa_ad_tooltip_alignment', [
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
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_color', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]' => 'color: {{VALUE}}',
                ],
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'sa_ad_tooltip_background',
                'label'     => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'     => ['classic', 'gradient'],
                'selector'  => '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]',
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_responsive_control(
            'sa_ad_tooltip_padding', [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"] .tippy-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Border::get_type(), [
                'name'      => 'sa_ad_tooltip_border',
                'label'     => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector'  => '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]',
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_responsive_control(
            'sa_ad_tooltip_border_radius', [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );


        $widget->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'      => 'sa_ad_tooltip__typography',
                'label'     => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector'  => '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]',
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'      => 'sa_ad_tooltip_text_shadow',
                'label'     => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector'  => '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]',
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'      => 'sa_ad_tooltip_box_shadow',
                'label'     => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector'  => '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"]',
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes'
                ],
            ]
        );

        $widget->add_control(
            'sa_ad_tooltip_arrow_color', [
                'label'     => esc_html__('Arrow Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                        '.tippy-box[data-theme="sa-ad-tippy-{{ID}}"] .tippy-arrow' => 'color: {{VALUE}}',
                ],
                'condition' => [
                        'sa_ad_tooltip_enable' => 'yes',
                        'sa_ad_tooltip_arrow'  => 'yes',
                ],
            ]
        );


        $widget->end_controls_tab();

        $widget->end_controls_tabs();
    }

    public function widget_advanced_tooltip_before_render($widget) {
        $settings = $widget->get_settings_for_display();
        if ( $settings[ 'sa_ad_tooltip_enable' ] == 'yes' ) {
            wp_enqueue_script('popper');
            wp_enqueue_script('tippyjs');
            wp_enqueue_style('tippy');
        }
    }

    protected function add_actions() {

        add_action(
            'elementor/element/common/_section_style/after_section_end', [
                $this,
                'register_section'
        ]);

        add_action(
            'elementor/element/common/section_sky_addons_pro_advanced_tooltip_controls/before_section_end', [
                $this,
                'register_controls'
            ], 10, 2);

        add_action('elementor/frontend/widget/before_render', [$this, 'widget_advanced_tooltip_before_render'], 10, 1);
    }

}
