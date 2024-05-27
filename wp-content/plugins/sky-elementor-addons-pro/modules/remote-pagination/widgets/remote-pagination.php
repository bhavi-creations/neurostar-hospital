<?php

namespace Sky_Addons_Pro\Modules\RemotePagination\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Remote_Pagination extends Widget_Base {

    public function get_name() {
        return 'sky-remote-pagination';
    }

    public function get_title() {
        return esc_html__('Remote Pagination', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-remote-pagination';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords() {
        return ['remote', 'pagination', 'slider', 'carousel', 'sky'];
    }

    public function get_style_depends() {
        return [
            'elementor-icons-fa-solid',
        ];
    }

    public function is_reload_preview_required() {
        return true;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'remote_selector',
            [
                'label'       => esc_html__('Remote ID', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'remote_selector_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('The unique ID of Carousel / Slider. Must be sure the Element is developed with Swiper. Note: If you place both elements in the same section, the system will automatically detect the element.', 'sky-elementor-addons-pro'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

            ]
        );

        $this->add_control(
            'loop_status',
            [
                'label'     => esc_html__('Slider Loop On?', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label'     => esc_html__('Show Arrows', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label'     => esc_html__('Previous Icon', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::ICONS,
                'condition' => [
                    'show_arrows' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label'     => esc_html__('Next Icon', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::ICONS,
                'condition' => [
                    'show_arrows' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_html__('Items', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_number',
            [
                'label'   => esc_html__('Number / Text', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('1', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'item_list',
            [
                'label'   => esc_html__('Item List', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'item_number' => esc_html__('1', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'item_number' => esc_html__('2', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'item_number' => esc_html__('3', 'sky-elementor-addons-pro'),
                    ],
                ],
                'title_field' => '{{{ item_number }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_common',
            [
                'label' => esc_html__('Common', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'layout',
            [
                'label'   => esc_html__('Layout', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'default'    => [
                        'title' => esc_html__('Default', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-justify-center-h',
                    ],
                    'column'  => [
                        'title' => esc_html__('Column', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-justify-center-v',
                    ],
                    'column-reverse'  => [
                        'title' => esc_html__('Column Reverse', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-align-start-h',
                    ],
                ],
                'selectors'            => [
                    '{{WRAPPER}} .sa-remote-pagination' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'default'        => 'display: flex;',
                    'column'         => 'display: inline-flex; flex-direction: column;',
                    'column-reverse' => 'display: inline-flex; flex-direction: column-reverse;',
                ]
            ]
        );

        $this->add_responsive_control(
            'alignment',
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
                    'space-between' => [
                        'title' => esc_html__('Space Between', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__('Space Around', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                ],
                'selectors'            => [
                    '{{WRAPPER}} .sa-remote-pagination' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left'          => 'justify-content: left;',
                    'center'        => 'justify-content: center;',
                    'right'         => 'justify-content: right;',
                    'space-between' => 'justify-content: space-between;',
                    'space-around'  => 'justify-content: space-around;'
                ]
            ]
        );

        $this->add_responsive_control(
            'grid_gap',
            [
                'label'       => esc_html__('Column Gap', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em'],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 16,
                ],
                'tablet_default' => [
                    'unit'    => 'px',
                    'size'    => 12,
                ],
                'mobile_default' => [
                    'unit'    => 'px',
                    'size'    => 12,
                ],
                'selectors'   => [
                    '{{WRAPPER}} .sa-remote-pagination' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__('Icon Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-icon-wrap+.sa-text, {{WRAPPER}} .sa-text+.sa-icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'offset_popover',
            [
                'label'        => esc_html__('Offset', 'sky-elementor-addons'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__('Default', 'sky-elementor-addons'),
                'label_on'     => esc_html__('Custom', 'sky-elementor-addons'),
                'return_value' => 'yes',
            ]
        );


        $this->start_popover();

        $this->add_responsive_control(
            'horizontal_offset',
            [
                'label'          => esc_html__('Horizontal Offset', 'sky-elementor-addons'),
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
                    'offset_popover' => 'yes'
                ],
                'selectors'      => [
                    '{{WRAPPER}} ' => '--sky-h-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_offset',
            [
                'label'          => esc_html__('Vertical Offset', 'sky-elementor-addons'),
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
                    'offset_popover' => 'yes'
                ],
                'selectors'      => [
                    '{{WRAPPER}}' => '--sky-v-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'media_rotate',
            [
                'label'          => esc_html__('Rotate', 'sky-elementor-addons'),
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
                    'offset_popover' => 'yes'
                ],
                'render_type'    => 'ui',
                'selectors'      => [
                    '{{WRAPPER}}' => '--sky-rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'css_output',
            [
                'type'      => Controls_Manager::HIDDEN,
                'default'   => '1',
                'selectors' => [
                    '{{WRAPPER}} .sa-remote-pagination' => 'position: relative; z-index: 99; -webkit-transform: translate(var(--sky-h-offset, 0), var(--sky-v-offset, 0)) rotate(var(--sky-rotate, 0)); transform: translate(var(--sky-h-offset, 0), var(--sky-v-offset, 0)) rotate(var(--sky-rotate, 0))'
                ],
                'condition'      => [
                    'offset_popover' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination_style',
            [
                'label'     => esc_html__('Pagination', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
            [
                'label'      => esc_html__('Icon Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Text Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '0.8',
                    'right'    => '1.2',
                    'bottom'   => '0.8',
                    'left'     => '1.2',
                    'unit'     => 'em',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-slider-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'pagination_border',
                'label'          => esc_html__('Border', 'sky-elementor-addons-pro'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top'      => '1',
                            'right'    => '1',
                            'bottom'   => '1',
                            'left'     => '1',
                            'unit'     => 'px',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => '#eaeaea',
                    ],
                ],
                'selector' => '{{WRAPPER}} .sa-slider-navigation',
            ]
        );

        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '.25',
                    'right'    => '.25',
                    'bottom'   => '.25',
                    'left'     => '.25',
                    'unit'     => 'em',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-slider-navigation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('pagination_tabs');

        $this->start_controls_tab(
            'pagination_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .sa-slider-navigation'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'pagination_bg',
                'label'          => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'          => ['classic', 'gradient'],
                // 'fields_options' => [
                //     'background' => [
                //         'default' => 'classic',
                //     ],
                //     'color' => [
                //         'default' => '#8441A4',
                //     ],
                // ],
                'selector' => '{{WRAPPER}} .sa-slider-navigation',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pagination_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-slider-navigation',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pagination_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-slider-navigation',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pagination_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-slider-navigation:hover'       => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-slider-navigation:hover svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'pagination_bg_hover',
                'label'          => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#E0528D',
                    ],
                ],
                'selector' => '{{WRAPPER}} .sa-slider-navigation:hover',
            ]
        );

        $this->add_control(
            'pagination_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#E0528D',
                'selectors' => [
                    '{{WRAPPER}} .sa-slider-navigation:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pagination_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-slider-navigation:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pagination_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-slider-navigation:hover',
            ]
        );

        $this->add_control(
            'pagination_hover_animation',
            [
                'label' => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_tab_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'pagination_color_active',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-item.sa-active'       => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-item.sa-active svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'pagination_bg_active',
                'label'          => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#E0528D',
                    ],
                ],
                'selector' => '{{WRAPPER}} .sa-item.sa-active',
            ]
        );

        $this->add_control(
            'pagination_border_color_active',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#E0528D',
                'selectors' => [
                    '{{WRAPPER}} .sa-item.sa-active' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pagination_text_shadow_active',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-item.sa-active',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pagination_box_shadow_active',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-item.sa-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'css_output_2',
            [
                'type'      => Controls_Manager::HIDDEN,
                'default'   => '1',
                'selectors' => [
                    '{{WRAPPER}} .sa-slider-navigation' => 'line-height:1.25; transition: all 300ms ease-in-out; min-widthX: 55px;'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_pagination($btn_anim = '') {
        $settings = $this->get_settings_for_display();

        if ($settings['item_list']) :
            foreach ($settings['item_list'] as $index => $item) :

                $this->add_render_attribute(
                    [
                        'remote-item' . $index => [
                            'class'      => 'sa-slider-navigation sa-item sa-d-flex sa-align-items-center sa-justify-content-center sa-link ' . esc_html($btn_anim),
                            'data-index' => $index
                        ],
                    ]
                );
?>
                <a <?php $this->print_render_attribute_string('remote-item' . $index); ?>>
                    <?php echo wp_kses_post($item['item_number']); ?>
                </a>
        <?php
            endforeach;
        endif;
    }

    protected function render_navigation() {
        $settings = $this->get_settings_for_display();

        $btn_anim = '';
        if ($settings['pagination_hover_animation']) {
            $btn_anim = ' elementor-animation-' . $settings['pagination_hover_animation'];
        }
        ?>

        <?php if ('yes' === $settings['show_arrows']) : ?>
            <a class="sa-slider-navigation sa-prev sa-d-flex sa-align-items-center sa-justify-content-center sa-link <?php echo esc_html($btn_anim); ?>">
                <span class="sa-icon-wrap">
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
                </span>
            </a>
        <?php endif; ?>

        <?php
        $this->render_pagination($btn_anim);
        ?>

        <?php if ('yes' === $settings['show_arrows']) : ?>
            <a class="sa-slider-navigation sa-next sa-d-flex sa-align-items-center sa-link <?php echo esc_html($btn_anim); ?>">
                <span class="sa-icon-wrap">
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
                </span>
            </a>
        <?php endif; ?>
    <?php
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = 'sa-remote-pagination-' . $this->get_id();

        $this->add_render_attribute(
            [
                'remote-pagination' => [
                    'id'            => $id,
                    'class'         => 'sa-remote-pagination sa-d-flex',
                    'data-settings' => [
                        wp_json_encode(
                            [
                                'id'         => '#' . $id,
                                'selector'   => !empty($settings['remote_selector']) ? '#' . $settings['remote_selector'] : '',
                                'loopStatus' => ('yes' === $settings['loop_status']) ? true : false,
                            ]
                        ),
                    ],
                ],
            ]
        );

        if (sky_editor_mode()) {
            remote_swiper_widget_notice($id . '-notice');
        }

    ?>
        <div <?php echo $this->get_render_attribute_string('remote-pagination'); ?>>
            <?php
            $this->render_navigation();
            ?>
        </div>
<?php
    }
}
