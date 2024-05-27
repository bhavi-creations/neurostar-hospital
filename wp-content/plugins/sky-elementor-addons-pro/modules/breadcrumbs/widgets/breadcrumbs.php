<?php

namespace Sky_Addons_Pro\Modules\Breadcrumbs\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Sky_Addons_Pro\Modules\Breadcrumbs\Module;

if ( !defined('ABSPATH') )
    exit; // Exit if accessed directly

class Breadcrumbs extends Widget_Base {

    public function get_name() {
        return 'sky-breadcrumbs';
    }

    public function get_title() {
        return esc_html__('Breadcrumbs', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-breadcrumbs';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_style_depends() {
        return [
                'elementor-icons-fa-solid',
        ];
    }

    public function get_keywords() {
        return ['sky', 'breadcrumbs', 'crumbs'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_breadcrumbs_layout', [
                'label' => esc_html__('Breadcrumbs', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'alignment', [
                'label'           => esc_html__('Alignment', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::CHOOSE,
                'options'         => [
                        'left'   => [
                                'title' => esc_html__('Left', 'sky-elementor-addons-pro'),
                                'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                                'title' => esc_html__('Center', 'sky-elementor-addons-pro'),
                                'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                                'title' => esc_html__('Right', 'sky-elementor-addons-pro'),
                                'icon'  => 'eicon-text-align-right',
                        ],
                ],
                'toggle'          => false,
                'desktop_default' => 'left',
                'tablet_default'  => 'left',
                'mobile_default'  => 'left',
                'style_transfer'  => true,
                'selectors'       => [
                        '{{WRAPPER}} .sa-breadcrumbs' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'delimiter', [
                'label'       => esc_html__('Delimiter / Separator', 'sky-elementor-addons-pro'),
                'description' => esc_html__('Delimiter between crumbs. You can use any kind of special symboils here. Example: /, -, ~', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'selectors'   => [
                        '{{WRAPPER}} .sa-breadcrumbs>:nth-child(n+2):not(.sa-first-column)::before' => 'content: "{{VALUE}}";',
                ],
            ]
        );


        $this->add_control(
            'hide_on_home_page', [
                'label'     => esc_html__('Hide on Home Page', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'hide_on_home_page_note', [
                'label'           => esc_html__('', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('If you will activated this option (Hide on Home Page), that means the breadcrumbs will not appear on the home page.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
            ]
        );

        $this->add_control(
            'hide_current_page', [
                'label' => esc_html__('Hide Current Page', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'hide_current_page_note', [
                'label'           => esc_html__('', 'sky-elementor-addons-pro'),
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('If you will activated this option (Hide Current Page), that means the breadcrumbs will not show the Current post/page title.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
            ]
        );

        $this->add_control(
            'home_icon', [
                'label'       => esc_html__('Home Page Icon', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::ICONS,
                'recommended' => [
                        'fa-solid' => [
                                'home',
                        ],
                ],
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_breadcrumbs_display_text', [
                'label' => esc_html__('Display Text', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_text_home', [
                'label'       => esc_html__('Home Page', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Site Name', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_blog', [
                'label'       => esc_html__('Blog', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Blog', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_page', [
                'label'       => esc_html__('Page', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Page', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_shop', [
                'label'       => esc_html__('Shop', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Shop', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_category', [
                'label'       => esc_html__('Category', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Category', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_search', [
                'label'       => esc_html__('Search', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Search', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_author', [
                'label'       => esc_html__('Articles by', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Articles by', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_tag', [
                'label'       => esc_html__('Tag', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Tag', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'display_text_error_404', [
                'label'       => esc_html__('Error 404', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Error 404', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'strip_words_on_page', [
                'label'       => esc_html__('Strip Words', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('If you want to remove words from your Current Page Title, you can use this. It\'s only support for Pages with not parent. It\'s case sensitive.', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'strip_words', [
                'label'       => esc_html__('Input your words', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'placeholder' => esc_html__('widgets, test', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
                'condition'   => [
                        'strip_words_on_page' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_breadcrumbs_style', [
                'label' => esc_html__('Breadcrumbs', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'breadcrumbs_crumbs_spacing', [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                        'px' => [
                                'min' => 5,
                                'max' => 50,
                        ],
                ],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'breadcrumbs_padding', [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs > * > *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'breadcrumbs_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *',
            ]
        );

        $this->add_responsive_control(
            'breadcrumbs_border_radius', [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs > * > *' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'     => 'breadcrumbs_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *',
            ]
        );

        $this->start_controls_tabs('breadcrumbs_tabs');

        $this->start_controls_tab(
            'breadcrumbs_tab_normal', [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'breadcrumbs_color', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs > * > *' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'breadcrumbs_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'breadcrumbs_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'breadcrumbs_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'breadcrumbs_tab_hover', [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'breadcrumbs_color_hover', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs > * > *:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'breadcrumbs_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *:hover',
            ]
        );

        $this->add_control(
            'breadcrumbs_border_color_hover', [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs > * > *:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                        'breadcrumbs_border_border!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'breadcrumbs_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'breadcrumbs_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > * > *:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_home_style', [
                'label' => esc_html__('Home', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'home_icon_spacing', [
                'label'      => esc_html__('Home Icon Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                        'px' => [
                                'min' => 5,
                                'max' => 50,
                        ],
                ],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs .sa-home-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'home_icon_size', [
                'label'      => esc_html__('Home Icon Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                        'px' => [
                                'min' => 10,
                                'max' => 50,
                        ],
                ],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs .sa-home-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'home_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home',
            ]
        );

        $this->add_responsive_control(
            'home_border_radius', [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs li .sa-home' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'     => 'home_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home',
            ]
        );

        $this->start_controls_tabs('home_tabs');

        $this->start_controls_tab(
            'home_tab_normal', [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'home_icon_color', [
                'label'     => esc_html__('Home Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs .sa-icon-wrap.sa-home-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'home_color', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs li .sa-home' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'home_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'home_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'home_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'home_tab_hover', [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'home_icon_color_hover', [
                'label'     => esc_html__('Home Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs .sa-home:hover .sa-icon-wrap' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'home_color_hover', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs li .sa-home:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'home_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home:hover',
            ]
        );

        $this->add_control(
            'home_border_color_hover', [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs li .sa-home:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                        'home_border_border!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'home_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'home_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs li .sa-home:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_current_item_style', [
                'label' => esc_html__('Current Item', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'current_item_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*',
            ]
        );

        $this->add_responsive_control(
            'current_item_border_radius', [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs>:last-child>*' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'     => 'current_item_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*',
            ]
        );

        $this->start_controls_tabs('current_item_tabs');

        $this->start_controls_tab(
            'current_item_tab_normal', [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'current_item_color', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs>:last-child>*' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'current_item_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'current_item_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'current_item_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'current_item_tab_hover', [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'current_item_color_hover', [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs>:last-child>*:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'current_item_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*:hover',
            ]
        );

        $this->add_control(
            'current_item_border_color_hover', [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs>:last-child>*:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                        'current_item_border_border!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'     => 'current_item_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'current_item_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs>:last-child>*:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sep_style', [
                'label' => esc_html__('Delimiter / Separator', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sep_color', [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'sep_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before',
            ]
        );

        $this->add_responsive_control(
            'sep_padding', [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'sep_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before',
            ]
        );

        $this->add_responsive_control(
            'sep_border_radius', [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                        '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'     => 'sep_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-breadcrumbs > :nth-child(n+2):not(.sa-first-column)::before',
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $home_icon = '';
        if ( !empty($settings[ 'home_icon' ][ 'value' ]) ) {
            $home_icon = '<span class="sa-icon-wrap sa-home-icon sa-me-2"> <i aria-hidden="true" class="' . $settings[ 'home_icon' ][ 'value' ] . '"></i> </span>';
        }

        $hide_on_home = $settings[ 'hide_on_home_page' ] == 'yes' ? 'yes' : '';
        $hide_current = $settings[ 'hide_current_page' ] == 'yes' ? 'yes' : '';

        $strip_words = (isset($settings[ 'strip_words' ]) && !empty($settings[ 'strip_words' ])) ? explode(',', $settings[ 'strip_words' ]) : '';

        $display_text = [
                'homepage'    => !empty($settings[ 'display_text_home' ]) ? $settings[ 'display_text_home' ] : '',
                'blog'        => !empty($settings[ 'display_text_blog' ]) ? $settings[ 'display_text_blog' ] : '',
                'page'        => !empty($settings[ 'display_text_page' ]) ? $settings[ 'display_text_page' ] : '',
                'shop'        => !empty($settings[ 'display_text_Shop' ]) ? $settings[ 'display_text_Shop' ] : '',
                'category'    => !empty($settings[ 'display_text_category' ]) ? $settings[ 'display_text_category' ] : '',
                'search'      => !empty($settings[ 'display_text_search' ]) ? $settings[ 'display_text_search' ] : '',
                'author'      => !empty($settings[ 'display_text_author' ]) ? $settings[ 'display_text_author' ] : '',
                'tag'         => !empty($settings[ 'display_text_tag' ]) ? $settings[ 'display_text_tag' ] : '',
                'error_404'   => !empty($settings[ 'display_text_error_404' ]) ? $settings[ 'display_text_error_404' ] : '',
                'strip_words' => $strip_words
        ];

        $breadcrumbs  = Module::_sky_breadcrumbs('left', $home_icon, $hide_on_home, $hide_current, $display_text);

        echo wp_kses_post($breadcrumbs);
    }

}
