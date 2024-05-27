<?php

namespace Sky_Addons_Pro\Modules\RemoteThumbs\Widgets;

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Remote_Thumbs extends Widget_Base {

    public function get_name() {
        return 'sky-remote-thumbs';
    }

    public function get_title() {
        return esc_html__('Remote Thumbs', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-remote-thumbs';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords() {
        return ['remote', 'pagination', 'thumbs', 'slider', 'carousel', 'sky'];
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
            'image',
            [
                'label'   => esc_html__('Choose Image', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
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
                        'image'   => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image'   => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image'   => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image'   => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '<img src="{{{ image.url }}}" style="height: 46px; width: auto;">',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumbnail_size',
                'default' => 'medium',
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
                ],
                'selectors'            => [
                    '{{WRAPPER}} .sa-remote-thumbs' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'default'        => 'display: flex;',
                    'column'         => 'display: inline-flex; flex-direction: column;',
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
                    '{{WRAPPER}} .sa-remote-thumbs' => '{{VALUE}};',
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
                    '{{WRAPPER}} .sa-remote-thumbs' => 'grid-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .sa-remote-thumbs' => 'position: relative; z-index: 99; -webkit-transform: translate(var(--sky-h-offset, 0), var(--sky-v-offset, 0)) rotate(var(--sky-rotate, 0)); transform: translate(var(--sky-h-offset, 0), var(--sky-v-offset, 0)) rotate(var(--sky-rotate, 0))'
                ],
                'condition'      => [
                    'offset_popover' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_thumb_style',
            [
                'label'     => esc_html__('Thumbs', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumb_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '4',
                    'right'    => '4',
                    'bottom'   => '4',
                    'left'     => '4',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-item img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'thumb_border',
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
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#eaeaea',
                    ],
                ],
                'selector' => '{{WRAPPER}} .sa-item img',
            ]
        );

        $this->add_responsive_control(
            'thumb_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '50',
                    'right'    => '50',
                    'bottom'   => '50',
                    'left'     => '50',
                    'unit'     => '%',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('thumb_tabs');

        $this->start_controls_tab(
            'thumb_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_responsive_control(
            'img_width',
            [
                'label'      => esc_html__('Width', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-remote-thumbs .sa-item img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-remote-thumbs .sa-item img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-remote-thumbs' => 'height: calc(10px + {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'thumb_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666',
                'selectors' => [
                    '{{WRAPPER}} .sa-item'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'thumb_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-item img',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'thumb_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thumb_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'thumb_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-item:hover'       => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-item:hover svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'thumb_bg_hover',
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
                'selector' => '{{WRAPPER}} .sa-item:hover img',
            ]
        );

        $this->add_control(
            'thumb_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#E0528D',
                'selectors' => [
                    '{{WRAPPER}} .sa-item:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'thumb_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'thumb_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-item:hover',
            ]
        );

        $this->add_control(
            'thumb_hover_animation',
            [
                'label' => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'thumb_tab_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_responsive_control(
            'img_width_active',
            [
                'label'      => esc_html__('Width', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-remote-thumbs .sa-item.sa-active img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height_active',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-remote-thumbs .sa-item.sa-active img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-remote-thumbs' => 'height: calc(10px + {{SIZE}}{{UNIT}})!important;',
                ],
            ]
        );

        $this->add_control(
            'thumb_color_active',
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
                'name'           => 'thumb_bg_active',
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
                'selector' => '{{WRAPPER}} .sa-item.sa-active img',
            ]
        );

        $this->add_control(
            'thumb_border_color_active',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#E0528D',
                'selectors' => [
                    '{{WRAPPER}} .sa-item.sa-active' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'thumb_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'thumb_box_shadow_active',
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
                    '{{WRAPPER}} .sa-item img'           => 'height: 55px; width:55px; transition: all 300ms ease-in-out;',
                    '{{WRAPPER}} .sa-item.sa-active img' => 'height: 65px; width:65px;'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_thumbs() {
        $settings = $this->get_settings_for_display();
        $btn_anim = '';
        if ($settings['thumb_hover_animation']) {
            $btn_anim = ' elementor-animation-' . $settings['thumb_hover_animation'];
        }

        if ($settings['item_list']) :
            foreach ($settings['item_list'] as $index => $item) :

                $this->add_render_attribute(
                    [
                        'remote-item' . $index => [
                            'class'      => 'sa-item sa-d-flex sa-align-items-center sa-justify-content-center sa-link ' . esc_html($btn_anim),
                            'data-index' => $index
                        ],
                    ]
                );
?>
                <a <?php $this->print_render_attribute_string('remote-item' . $index); ?>>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail_size', 'image'); ?>
                </a>
        <?php
            endforeach;
        endif;
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = 'sa-remote-thumbs-' . $this->get_id();

        $this->add_render_attribute(
            [
                'remote-thumbs' => [
                    'id'            => $id,
                    'class'         => 'sa-remote-thumbs sa-d-flex sa-align-items-center',
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
        <div <?php echo $this->get_render_attribute_string('remote-thumbs'); ?>>
            <?php
            $this->render_thumbs();
            ?>
        </div>
<?php
    }
}
