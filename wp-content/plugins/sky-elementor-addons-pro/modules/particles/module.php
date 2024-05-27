<?php

namespace Sky_Addons_Pro\Modules\Particles;

use Sky_Addons_Pro;
use Elementor\Controls_Manager;
use Sky_Addons_Pro\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        $this->add_actions();
    }

    public function get_name() {
        return 'sky-particles';
    }

    public function register_section($element) {
        $tabs = Controls_Manager::TAB_CONTENT;

        if ('section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name()) {
            $tabs = Controls_Manager::TAB_STYLE;
        }

        $element->start_controls_section(
            'section_sky_addons_pro_particles_controls',
            [
                'tab'   => $tabs,
                'label' => esc_html__('Particles Effects', 'sky-elementor-addons-pro') . sky_addons_pro_get_icon(),
            ]
        );

        $element->end_controls_section();
    }

    public function register_controls($widget, $args) {

        $widget->add_control(
            'sa_particles_enable',
            [
                'label'              => esc_html__('Enable', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'frontend_available' => true,
                'prefix_class'       => 'sa-particles-',
            ]
        );

        $widget->add_control(
            'sa_particles_style',
            [
                'label'              => esc_html__('Style', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'polygon',
                'options'            => [
                    'polygon' => esc_html__('Polygon', 'sky-elementor-addons-pro'),
                    'nasa'    => esc_html__('Nasa', 'sky-elementor-addons-pro'),
                    'bubble'  => esc_html__('Bubble', 'sky-elementor-addons-pro'),
                    'snow'    => esc_html__('Snow', 'sky-elementor-addons-pro'),
                    'custom'  => esc_html__('Custom', 'sky-elementor-addons-pro'),
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_move_direction',
            [
                'label'              => esc_html__('Move Direction', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'bottom',
                'options'            => [
                    'none'         => esc_html__('None', 'sky-elementor-addons-pro'),
                    'top'          => esc_html__('Top', 'sky-elementor-addons-pro'),
                    'top-right'    => esc_html__('Top-right', 'sky-elementor-addons-pro'),
                    'right'        => esc_html__('Right', 'sky-elementor-addons-pro'),
                    'bottom-right' => esc_html__('Bottom-right', 'sky-elementor-addons-pro'),
                    'bottom'       => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                    'bottom-left'  => esc_html__('Bottom-left', 'sky-elementor-addons-pro'),
                    'left'         => esc_html__('Left', 'sky-elementor-addons-pro'),
                    'top-left'     => esc_html__('Top-left', 'sky-elementor-addons-pro'),
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                    'sa_particles_style'  => ['snow', 'bubble'],
                    'sa_particles_style!' => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_color',
            [
                'label'              => esc_html__('Particles Color', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::COLOR,
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                    'sa_particles_style!' => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_opacity',
            [
                'label'              => esc_html__('Particle Opacity', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1,
                    ],
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                    'sa_particles_style!' => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_customize',
            [
                'label'              => esc_html__('Additional Customize', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'separator'          => 'before',
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                    'sa_particles_style!' => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_number',
            [
                'label'              => esc_html__('Particle Quantity', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 400,
                        'step' => 5,
                    ],
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable'    => 'yes',
                    'sa_particles_customize' => 'yes',
                    'sa_particles_style!'    => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_size',
            [
                'label'              => esc_html__('Particle Size', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable'    => 'yes',
                    'sa_particles_customize' => 'yes',
                    'sa_particles_style!'    => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_move_speed',
            [
                'label'              => esc_html__('Move Speed', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable'    => 'yes',
                    'sa_particles_customize' => 'yes',
                    'sa_particles_style!'    => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_interactive',
            [
                'label'              => esc_html__('Enable Interactivity', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable'    => 'yes',
                    'sa_particles_customize' => 'yes',
                    'sa_particles_style!'    => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_custom_json',
            [
                'label'              => esc_html__('Custom Particles', 'plugin-domain'),
                'type'               => Controls_Manager::CODE,
                'language'           => 'html',
                'rows'               => 20,
                'render_type'        => 'template',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                    'sa_particles_style'  => 'custom',
                ],
            ]
        );

        $widget->add_control(
            'sa_particles_z_index',
            [
                'label'   => esc_html__('Z-index', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::NUMBER,
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_particles_enable' => 'yes',
                ],
            ]
        );
    }

    public function _before_render($widget) {
        $settings = $widget->get_settings_for_display();
        if ($settings['sa_particles_enable'] == 'yes') {
            wp_enqueue_script('particles');
        }
    }

    protected function add_actions() {

        //section
        add_action('elementor/element/section/section_background/after_section_end', [
            $this, 'register_section'
        ]);
        add_action('elementor/element/section/section_sky_addons_pro_particles_controls/before_section_end', [
            $this, 'register_controls'
        ], 10, 2);
        add_action('elementor/frontend/section/before_render', [$this, '_before_render'], 10, 1);

        //container
        add_action('elementor/element/container/section_background/after_section_end', [
            $this, 'register_section'
        ]);
        add_action('elementor/element/container/section_sky_addons_pro_particles_controls/before_section_end', [
            $this, 'register_controls'
        ], 10, 2);
        add_action('elementor/frontend/container/before_render', [$this, '_before_render'], 10, 1);
    }
}
