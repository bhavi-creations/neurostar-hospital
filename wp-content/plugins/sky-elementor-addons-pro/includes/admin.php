<?php

namespace Sky_Addons_Pro\Admin;

defined('ABSPATH') || exit;

/**
 * The Admin class
 */
class Sky_Addons_Pro_Admin {

    const WIDGETS_DB_KEY = 'sky_addons_inactive_widgets';
    const EXTENSIONS_DB_KEY = 'sky_addons_inactive_extensions';
    const API_DB_KEY = 'sky_addons_api';

    private function __construct() {
        add_action('admin_menu', [$this, 'admin_menu'], 999);
    }

    public static function get_inactive_widgets() {
        return get_option(self::WIDGETS_DB_KEY, []);
    }
    public static function get_inactive_extensions() {
        return get_option(self::EXTENSIONS_DB_KEY, []);
    }
    public static function get_saved_api() {
        return get_option(self::API_DB_KEY, []);
    }

    public function admin_menu() {
        $parent_slug = 'sky-elementor-addons';
        $capability  = 'manage_options';

        remove_submenu_page($parent_slug, $parent_slug . '#pro');

        /**
         * White Label Feature Added
         */

        if (!defined('SKY_ADDONS_L_H')) {

            add_submenu_page($parent_slug, esc_html__('License', 'sky-elementor-addons-pro'), esc_html__('License', 'sky-elementor-addons-pro'), $capability, $parent_slug . '-license', [
                $this, 'admin_settings'
            ]);
        }
    }

    public function admin_settings() {
        if (is_readable(sky_addons_pro_core()->templates_dir . 'admin/license.php')) {
            require_once sky_addons_pro_core()->templates_dir . 'admin/license.php';
        }
    }

    static function option_init_check($option_names = []) {
        $default = [];
        foreach ($option_names as $option_name) {
            $option_value = get_option($option_name, []);
            if ($option_value) {
                $default[$option_name] = true;
            } else {
                $default[$option_name] = false;
            }
        }
        return $default;
    }

    // dummy list
    static function get_element_list() {
        $inactive_widgets = self::get_inactive_widgets();
        $inactive_extensions = self::get_inactive_extensions();
        $saved_api = self::get_saved_api();

        $widgets_fields                           =  [
            'sky_addons_inactive_widgets'         => [
                [
                    'name'         => 'advanced-accordion',
                    'label'        => esc_html__('Advanced Accordion', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('advanced-accordion', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'advanced-counter',
                    'label'        => esc_html__('Advanced Counter', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('advanced-counter', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'advanced-skill-bars',
                    'label'        => esc_html__('Advanced Skill Bars', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('advanced-skill-bars', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'advanced-slider',
                    'label'        => esc_html__('Advanced Slider', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('advanced-slider', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'breadcrumbs',
                    'label'        => esc_html__('Breadcrumbs', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('breadcrumbs', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'card',
                    'label'        => esc_html__('Card', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('card', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'dual-button',
                    'label'        => esc_html__('Dual Button', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('dual-button', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'image-compare',
                    'label'        => esc_html__('Image Compare', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('image-compare', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'info-box',
                    'label'        => esc_html__('Info Box', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('info-box', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'list-group',
                    'label'        => esc_html__('List Group', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('list-group', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'logo-grid',
                    'label'        => esc_html__('Logo Grid', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('logo-grid', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'momentum-slider',
                    'label'        => esc_html__('Momentum Slider', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('momentum-slider', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'number',
                    'label'        => esc_html__('Number', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('number', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'portion-effect',
                    'label'        => esc_html__('Portion Effect', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('portion-effect', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'reading-progress',
                    'label'        => esc_html__('Reading Progress', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('reading-progress', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'review',
                    'label'        => esc_html__('Review', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('review', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'social-icons',
                    'label'        => esc_html__('Social Icons', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('social-icons', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'step-flow',
                    'label'        => esc_html__('Step Flow', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('step-flow', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'team-member',
                    'label'        => esc_html__('Team Member', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('team-member', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'testimonial',
                    'label'        => esc_html__('Testimonial', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('testimonial', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'tidy-list',
                    'label'        => esc_html__('Tidy List', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('tidy-list', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'video-gallery',
                    'label'        => esc_html__('Video Gallery', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('video-gallery', $inactive_widgets) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                ],


            ],
            'sky_addons_inactive_extensions'      => [
                [
                    'name'         => 'advanced-tooltip',
                    'label'        => esc_html__('Advanced Tooltip', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('advanced-tooltip', $inactive_extensions) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'floating-effects',
                    'label'        => esc_html__('Floating Effects', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('floating-effects', $inactive_extensions) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'particles',
                    'label'        => esc_html__('Particles', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('particles', $inactive_extensions) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                ],
                [
                    'name'         => 'wrapper-link',
                    'label'        => esc_html__('Wrapper Link', 'sky-elementor-addons-pro'),
                    'type'         => 'checkbox',
                    'value'        => !in_array('wrapper-link', $inactive_extensions) ? 'on' : 'off',
                    'default'      => 'on',
                    'video_url'    => '#',
                    'content_type' => 'custom new',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                ],
            ],
            'sky_addons_api'                      => [
                'sky_addons_api_mailchimp_group'  => [
                    [
                        'name'                    => 'mailchimp',
                        'label'                   => esc_html__('Mailchimp', 'sky-elementor-addons-pro'),
                        'placeholder'             => esc_html__('Access Key', 'sky-elementor-addons-pro'),
                        'description'             => esc_html__('Mailchimp Activate the sections and features of this plugin by activating from the following list.', 'sky-elementor-addons-pro'),
                        'type'                    => 'input',
                        'value'                   => !empty($saved_api['mailchimp']) ? $saved_api['mailchimp'] : null,
                        'default'                 => 'on',
                    ]
                ],
                'sky_addons_api_google_map_group' => [
                    [
                        'name'                    => 'google_map_api',
                        'label'                   => esc_html__('Google Map', 'sky-elementor-addons-pro'),
                        'placeholder'             => esc_html__('API Key', 'sky-elementor-addons-pro'),
                        'description'             => esc_html__('Google Map Activate the sections and features of this plugin by activating from the following list.', 'sky-elementor-addons-pro'),
                        'type'                    => 'input',
                        'value'                   => !empty($saved_api['google_map_api']) ? $saved_api['google_map_api'] : null,
                        'default'                 => 'on',
                    ],
                ],
                'sky_addons_api_facebook_group'   => [
                    [
                        'name'                    => 'facebook_page_name',
                        'label'                   => esc_html__('Facebook Page Name', 'sky-elementor-addons-pro'),
                        'placeholder'             => esc_html__('Page Name', 'sky-elementor-addons-pro'),
                        'description'             => esc_html__('Page Name Activate the sections and features of this plugin by activating from the following list.', 'sky-elementor-addons-pro'),
                        'type'                    => 'input',
                        'value'                   => !empty($saved_api['facebook_page_name']) ? $saved_api['facebook_page_name'] : null,
                        'default'                 => 'on',
                    ],
                    [
                        'name'                    => 'facebook_access_token',
                        'label'                   => esc_html__('Facebook Access', 'sky-elementor-addons-pro'),
                        'placeholder'             => esc_html__('Access Token', 'sky-elementor-addons-pro'),
                        'description'             => esc_html__('Access Token Activate the sections and features of this plugin by activating from the following list.', 'sky-elementor-addons-pro'),
                        'type'                    => 'input',
                        'value'                   => !empty($saved_api['facebook_access_token']) ? $saved_api['facebook_access_token'] : null,
                        'default'                 => 'on',
                    ],
                ],
            ],
        ];

        return $widgets_fields;
    }

    public static function init() {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }
}

function sky_addons_pro_admin() {
    return Sky_Addons_Pro_Admin::init();
}

// kick-off the admin class
sky_addons_pro_admin();
