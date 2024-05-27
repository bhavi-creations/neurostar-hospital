<?php

namespace Sky_Addons_Pro\Modules\DarkMode\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Dark_Mode extends Widget_Base
{

    public function get_name()
    {
        return 'sky-dark-mode';
    }

    public function get_title()
    {
        return esc_html__('Dark Mode', 'sky-elementor-addons-pro');
    }

    public function get_icon()
    {
        return 'sky-icon-dark-mode';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords()
    {
        return ['sky', 'pro', 'nightmode', 'darkmode', 'dark'];
    }

    public function get_script_depends()
    {
        return ['darkmode'];
    }

    public function is_reload_preview_required()
    {
        return true;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_dark_mode_layout',
            [
                'label' => esc_html__('Layout', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'dark_mode_default_mode',
            [
                'label'   => esc_html__('Default', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'light',
                'options' => [
                    'light' => esc_html__('Light', 'sky-elementor-addons-pro'),
                    'dark'  => esc_html__('Dark', 'sky-elementor-addons-pro'),
                    'auto'  => esc_html__('Auto Night (Alpha Version)', 'sky-elementor-addons-pro'),
                ],
                'frontend_available' => true,
                'render_type'        => 'template',
            ]
        );

        $this->add_control(
            'dark_mode_style',
            [
                'label'   => esc_html__('Select Style', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => esc_html__('Default', 'sky-elementor-addons-pro'),
                    'bulb'     => esc_html__('Bulb', 'sky-elementor-addons-pro'),
                    'dot'      => esc_html__('Dot', 'sky-elementor-addons-pro'),
                    'switcher' => esc_html__('Switcher', 'sky-elementor-addons-pro'),
                ],
                'frontend_available' => true,
                'render_type'        => 'template',
            ]
        );

        $this->add_control(
            'dark_mode_left_text',
            [
                'label'              => esc_html__('Left Side Text', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('Light', 'sky-elementor-addons-pro'),
                'frontend_available' => true,
                'condition'          => [
                    'dark_mode_style' => 'switcher'
                ]
            ]
        );
        $this->add_control(
            'dark_mode_right_text',
            [
                'label'              => esc_html__('Right Side Text', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('Dark', 'sky-elementor-addons-pro'),
                'frontend_available' => true,
                'condition'          => [
                    'dark_mode_style' => 'switcher'
                ]
            ]
        );

        $this->add_responsive_control(
            'dark_mode_toggle_size',
            [
                'label'          => esc_html__('Toggle Size', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', 'em'],
                'range'          => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                    ],
                ],
                'render_type'    => 'ui',
                'selectors'      => [
                    '.darkmode-toggle'        => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                    '.darkmode-layer--button:not(.darkmode-layer--expanded)' => 'width: calc({{SIZE}}{{UNIT}} - 2px) !important; height: calc({{SIZE}}{{UNIT}} - 2px) !important;',
                ],
                'condition'          => [
                    'dark_mode_style!' => 'switcher'
                ]
            ]
        );

        $this->add_control(
            'dark_mode_toggle_position',
            [
                'label'                => esc_html__('Toggle Position', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::SELECT,
                'label_block'          => false,
                'default' => 'bottom-right',
                'options' => [
                    'top-right'    => esc_html__('Top Right', 'sky-elementor-addons-pro'),
                    'top-left'     => esc_html__('Top Left', 'sky-elementor-addons-pro'),
                    'bottom-right' => esc_html__('Bottom Right', 'sky-elementor-addons-pro'),
                    'bottom-left'  => esc_html__('Bottom Left', 'sky-elementor-addons-pro'),
                ],
                'style_transfer'       => true,
                'selectors'            => [
                    'body .darkmode-toggle, body .darkmode-layer' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top-right'    => 'right:32px !important; bottom:unset !important; top:32px !important; left:unset !important;',
                    'top-left'     => 'right:unset !important; bottom:unset !important; top:32px !important; left:32px !important;',
                    'bottom-right' => 'right:32px !important; bottom:32px !important; top:unset !important; left:unset !important;',
                    'bottom-left'  => 'right:unset !important; bottom:32px !important; top:unset !important; left:32px !important;',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'dark_mode_offset_popover',
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
            'dark_mode_horizontal_offset',
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
                        'min'  => -100,
                        'max'  => 100,
                    ],
                ],
                'render_type'    => 'ui',
                'condition'      => [
                    'dark_mode_offset_popover' => 'yes'
                ],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer' => '--sa-horizontal-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dark_mode_vertical_offset',
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
                        'min'  => -100,
                        'max'  => 100,
                    ],
                ],
                'render_type'    => 'ui',
                'condition'      => [
                    'dark_mode_offset_popover' => 'yes'
                ],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer' => '--sa-vertical-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'dark_mode_mix_color',
            [
                'label' => esc_html__('Mix Color', 'sky-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'dark_mode_background_color',
            [
                'label' => esc_html__('Background', 'sky-elementor-addons-pro'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional',
            [
                'label' => esc_html__('Additional', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'dark_mode_time',
            [
                'label'     => esc_html__('Animation Time (ms)', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 2000,
                        'min'  => 100,
                    ],
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'dark_mode_save_in_cookies',
            [
                'label'     => esc_html__('Save In Cookies', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'dark_mode_auto_match_theme',
            [
                'label'     => esc_html__('Auto Match OsTheme', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'dark_mode_ignore_elements',
            [
                'label'       => esc_html__('Ignore Elements', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => '.class-name, .class-img',
                'dynamic'     => [
                    'active' => true,
                ],
                'frontend_available' => true,
                'render_type'        => 'none'
            ]
        );

        $this->add_control(
            'dark_mode_ignore_elements_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('Note: Input the Class/ID names where you don’t want to apply the dark mode.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

            ]
        );

        $this->end_controls_section();

        //start style part

        $this->start_controls_section(
            'section_dark_mode_toggle_style',
            [
                'label'     => esc_html__('Toggle', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dark_mode_style!' => 'switcher'
                ]
            ]
        );

        $this->start_controls_tabs('tabs_toggle_style');

        $this->start_controls_tab(
            'toggle_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'dark_mode_button_color_dark',
            [
                'label'     => esc_html__('Button Color Dark', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'toggle_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'dark_mode_button_color_light',
            [
                'label'     => esc_html__('Button Color Light', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dark_mode_text_style',
            [
                'label' => esc_html__('Text', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'      => [
                    'dark_mode_style' => 'switcher'
                ]
            ]
        );

        $this->add_responsive_control(
            'switcher_side_text_spacing',
            [
                'label'          => esc_html__('Side Text Spacing', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 50,
                ],
                'tablet_default' => [
                    'size' => 50,
                ],
                'mobile_default' => [
                    'size' => 50,
                ],
                'range'          => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                    ],
                ],
                'render_type'    => 'ui',
                'selectors' => [
                    'body' => '--sa-dark-mode-switcher-text-spacing: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '.sa-dark-mode-switcher .darkmode-toggle:before, .sa-dark-mode-switcher .darkmode-toggle:after',
            ]
        );

        $this->start_controls_tabs('tabs_text_style');

        $this->start_controls_tab(
            'text_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'left_text_color',
            [
                'label'     => esc_html__('Left Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.sa-dark-mode-switcher .darkmode-toggle:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_text_color',
            [
                'label'     => esc_html__('Right Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.sa-dark-mode-switcher .darkmode-toggle:after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'text_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'left_text_color_active',
            [
                'label'     => esc_html__('Left Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.sa-dark-mode-switcher .darkmode-toggle.darkmode-toggle--white:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_text_color_active',
            [
                'label'     => esc_html__('Right Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.sa-dark-mode-switcher .darkmode-toggle.darkmode-toggle--white:after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_switcher_style',
            [
                'label' => esc_html__('Switcher', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'      => [
                    'dark_mode_style' => 'switcher'
                ]
            ]
        );

        $this->add_responsive_control(
            'switcher_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    'body.sa-dark-mode-switcher .darkmode-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_switcher_style');

        $this->start_controls_tab(
            'switcher_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'slider_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('S L I D E R', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'switcher_color',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => 'body.sa-dark-mode-switcher .darkmode-toggle .sa-dark-mode-slider:before',
            ]
        );


        $this->add_control(
            'switcher_bg_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('B A C K G R O U N D', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'switcher_slider_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => 'body.sa-dark-mode-switcher .darkmode-toggle .sa-dark-mode-slider',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'switcher_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'slider_heading_active',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('S L I D E R', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'switcher_color_active',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => 'body.sa-dark-mode-switcher .darkmode-toggle--white .sa-dark-mode-slider:before',
            ]
        );

        $this->add_control(
            'switcher_bg_heading_active',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('B A C K G R O U N D', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'switcher_slider_background_active',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => 'body.sa-dark-mode-switcher .darkmode-toggle--white  .sa-dark-mode-slider',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function render()
    {
?>
        <div>
            <?php
            if (sky_editor_mode()) :
                echo wp_kses_post(__('<div class="sa-border sa-rounded sa-p-3 sa-text-center"><strong>Dark Mode Widget</strong> Placed Here, this text will not visible in FrontEnd of your website.</div>', 'sky-elementor-addons-pro'));
            endif;
            ?>
        </div>
<?php
    }
}
