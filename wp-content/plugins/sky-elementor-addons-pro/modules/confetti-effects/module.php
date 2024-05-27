<?php

namespace Sky_Addons_Pro\Modules\ConfettiEffects;

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
        return 'sky-confetti-effects';
    }

    public function register_section($element) {
        $element->start_controls_section(
            'section_sky_addons_pro_confetti_ef_controls',
            [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__('Confetti Effects', 'sky-elementor-addons-pro') . sky_addons_pro_get_icon(),
            ]
        );

        $element->end_controls_section();
    }

    public function register_controls($widget, $args) {

        $widget->add_control(
            'sa_confetti_ef_enable',
            [
                'label'              => esc_html__('Enable', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'frontend_available' => true,
                'prefix_class'       => 'sa-confetti_ef-',
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_type',
            [
                'label'              => esc_html__('Select Effects', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'basic',
                'options'            => [
                    'basic'        => esc_html__('Basic', 'sky-elementor-addons-pro'),
                    'random'       => esc_html__('Random', 'sky-elementor-addons-pro'),
                    'fireworks'    => esc_html__('Fireworks', 'sky-elementor-addons-pro'),
                    'snow'         => esc_html__('Snow', 'sky-elementor-addons-pro'),
                    'school_pride' => esc_html__('School Pride', 'sky-elementor-addons-pro'),
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_anim_dur',
            [
                'label'              => esc_html__('Animation Duration (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 1000,
                        'max'        => 15000,
                        'step'       => 500,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                    'sa_confetti_ef_type'     => [
                        'fireworks',
                        'snow',
                        'school_pride'
                    ],
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_particle_count',
            [
                'label'              => esc_html__('Particle Count', 'sky-elementor-addons-pro'),
                'description'        => esc_html__(' (default: 100): The number of confetti to launch. More is always fun... but be cool, there\'s a lot of math involved.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 1,
                        'max'        => 1000,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );


        $widget->add_control(
            'sa_confetti_ef_angle',
            [
                'label'              => esc_html__('Angle', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 90): The angle in which to launch the confetti, in degrees. 90 is straight up.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 0,
                        'max'        => 360,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                    'sa_confetti_ef_type' => [
                        'random',
                        'school_pride'
                    ]
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_spread',
            [
                'label'              => esc_html__('Spread', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 45): How far off center the confetti can go, in degrees. 45 means the confetti will launch at the defined angle plus or minus 22.5 degrees.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 0,
                        'max'        => 360,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_start_velocity',
            [
                'label'              => esc_html__('Start Velocity', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 45): How fast the confetti will start going, in pixels.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 1,
                        'max'        => 1000,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_decay',
            [
                'label'              => esc_html__('Decay', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 0.9): How quickly the confetti will lose speed. Keep this number between 0 and 1, otherwise the confetti will gain speed. Better yet, just never change it.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'  => .1,
                        'max'  => 1,
                        'step' => .5,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_gravity',
            [
                'label'              => esc_html__('Gravity', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 1): How quickly the particles are pulled down. 1 is full gravity, 0.5 is half gravity, etc., but there are no limits. You can even make particles go up if you\'d like.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'  => .1,
                        'max'  => 1,
                        'step' => .5,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_drift',
            [
                'label'              => esc_html__('Drift', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 0): How much to the side the confetti will drift. The default is 0, meaning that they will fall straight down. Use a negative number for left and positive number for right.', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'  => -100,
                        'max'  => 100,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_origin',
            [
                'label'              => esc_html__('Origin', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::POPOVER_TOGGLE,
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'return_value'       => 'yes',
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->start_popover();

        $widget->add_control(
            'sa_confetti_ef_origin_x',
            [
                'label'              => esc_html__('X', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                    'sa_confetti_ef_origin'   => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_origin_y',
            [
                'label'              => esc_html__('Y', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                    'sa_confetti_ef_origin'   => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $widget->end_popover();

        $widget->add_control(
            'sa_confetti_ef_colors',
            [
                'label'              => esc_html__('Colors', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXTAREA,
                'description'        => 'Input your colors. example: red, #bada55, #ffffff (Colors must be not empty.)',
                'default'            => '#D30C5C, #0EBCDC, #EAED41, #ED5A78, #DF33DF',
                'render_type'        => 'none',
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_shapes',
            [
                'label'              => esc_html__('Shapes', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXTAREA,
                'description'        => 'The possible values are square, circle and star. The default is to use both shapes in an even mix. You can even change the mix by providing a value such as (circle, circle, square, star) to use two third circles and one third squares.',
                'render_type'        => 'none',
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_scalar',
            [
                'label'              => esc_html__('Scalar', 'sky-elementor-addons-pro'),
                'description'        => esc_html__('Number (default: 1): Scale factor for each confetti particle. Use decimals to make the confetti smaller. Go on, try teeny tiny confetti, they are adorable!', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'  => .1,
                        'max'  => 10,
                        'step' => .5,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_trigger_type',
            [
                'label'              => esc_html__('Smart Trigger', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'load'         => esc_html__('Page Load (Default)', 'sky-elementor-addons-pro'),
                    'on_view'      => esc_html__('Elements On View', 'sky-elementor-addons-pro'),
                    'click'        => esc_html__('On Click', 'sky-elementor-addons-pro'),
                    'mouseenter'   => esc_html__('On Mouse Hover', 'sky-elementor-addons-pro'),
                    'ajax_success' => esc_html__('Ajax Success', 'sky-elementor-addons-pro'),
                ],
                'default'            => 'load',
                'render_type'        => 'template',
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_trigger_selector',
            [
                'label'              => esc_html__('Trigger Selector', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::TEXT,
                'description'        => esc_html__('Place your selector. example:- #test-id, .test-class . By default it\'s will set itself.', 'sky-elementor-addons-pro'),
                'dynamic'            => [
                    'active' => true,
                ],
                'render_type'        => 'template',
                'condition'          => [
                    'sa_confetti_ef_enable'     => 'yes',
                    'sa_confetti_ef_trigger_type' => ['click', 'mouseenter'],
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_delay',
            [
                'label'              => esc_html__('Delay Time (ms)', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 10000,
                        'step' => 1000,
                    ],
                ],
                'condition'          => [
                    'sa_confetti_ef_enable'     => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $widget->add_control(
            'sa_confetti_ef_z_index',
            [
                'label'              => esc_html__('Z-Index', 'sky-elementor-addons-pro'),
                'type'               => Controls_Manager::NUMBER,
                'description'        => esc_html__('Elements with a higher index will be placed on top of elements with a lower index.', 'sky-elementor-addons-pro'),
                'frontend_available' => true,
                'render_type'        => 'template',
                'separator'          => 'before',
                'condition'          => [
                    'sa_confetti_ef_enable' => 'yes'
                ],
            ]
        );
    }

    public function _before_render($widget) {
        $settings = $widget->get_settings_for_display();
        if ($settings['sa_confetti_ef_enable'] == 'yes') {
            wp_enqueue_script('sa-confetti-effects');
        }
    }

    protected function add_actions() {


        // section
        add_action(
            'elementor/element/section/section_advanced/after_section_end',
            [
                $this,
                'register_section'
            ]
        );

        add_action(
            'elementor/element/section/section_sky_addons_pro_confetti_ef_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // for section render
        add_action('elementor/frontend/section/before_render', [$this, '_before_render'], 10, 1);


        // widget
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action(
            'elementor/element/common/section_sky_addons_pro_confetti_ef_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // for widget render
        add_action('elementor/frontend/widget/before_render', [$this, '_before_render'], 10, 1);

        // container
        add_action(
            'elementor/element/container/section_layout/after_section_end',
            [
                $this,
                'register_section'
            ]
        );

        add_action(
            'elementor/element/container/section_sky_addons_pro_confetti_ef_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // for section render
        add_action('elementor/frontend/container/before_render', [$this, '_before_render'], 10, 1);
    }
}
