<?php

namespace Sky_Addons_Pro\Modules\PricingTable\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Pricing_Table extends Widget_Base {

    public function get_name() {
        return 'sky-pricing-table';
    }

    public function get_title() {
        return esc_html__('Pricing Table', 'sky-elementor-addons-pro');
    }

    public function get_icon() {
        return 'sky-icon-pricing-table';
    }

    public function get_categories() {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords() {
        return ['sky', 'pricing', 'table', 'plan', 'pricingtable', 'price', 'pricelist'];
    }

    public function get_style_depends() {
        return [
            'elementor-icons-fa-solid',
            'tippy',
        ];
    }

    public function get_script_depends() {
        return ['popper', 'tippyjs'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_pricing_table_header',
            [
                'label' => esc_html__('Header', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Basic', 'sky-elementor-addons-pro'),
                'placeholder' => esc_html__('Type package name', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => sky_title_tags(),
            ]
        );

        $this->add_control(
            'show_sub_title',
            [
                'label'     => esc_html__('Show Sub Title', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                // 'default' => 'yes',
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => esc_html__('Sub Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'default' => 'This is Basic Plan',
                'placeholder' => esc_html__('Type your sub title here', 'sky-elementor-addons-pro'),
                'dynamic'     => ['active' => true],
                'condition'   => [
                    'show_sub_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'sub_title_tag',
            [
                'label'     => esc_html__('Sub Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h6',
                'options'   => sky_title_tags(),
                'condition' => [
                    'show_sub_title' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_media',
            [
                'label' => esc_html__('Image / Icon', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_pricing_media',
            [
                'label'     => esc_html__('Show Image / Icon', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'pricing_media_type',
            [
                'label'          => esc_html__('Media Type', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-check',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
                'condition' => [
                    'show_pricing_media' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'pricing_media_image',
            [
                'label'     => esc_html__('Choose Image', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_pricing_media' => 'yes',
                    'pricing_media_type' => 'image',
                ],
                'dynamic'   => ['active' => true],

            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'pricing_media_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default'   => 'medium_large',
                'separator' => 'none',
                'condition' => [
                    'show_pricing_media' => 'yes',
                    'pricing_media_type' => 'image',
                ]
            ]
        );

        $this->add_control(
            'pricing_icon',
            [
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'default'     => [
                    'value'   => 'fas fa-rocket',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_pricing_media' => 'yes',
                    'pricing_media_type' => 'icon'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_pricing_table_pricing',
            [
                'label' => esc_html__('Pricing', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_pricing',
            [
                'label'   => esc_html__('Show Price', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pricing_currency_symbol',
            [
                'label'     => esc_html__('Currency Symbol', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dollar',
                'options'   => [
                    ''             => esc_html__('None', 'sky-elementor-addons-pro'),
                    'dollar'       => '&#36; ' . esc_html__('Dollar', 'sky-elementor-addons-pro'),
                    'baht'         => '&#3647; ' . esc_html__('Baht', 'sky-elementor-addons-pro'),
                    'euro'         => '&#128; ' . esc_html__('Euro', 'sky-elementor-addons-pro'),
                    'franc'        => '&#8355; ' . esc_html__('Franc', 'sky-elementor-addons-pro'),
                    'guilder'      => '&fnof; ' . esc_html__('Guilder', 'sky-elementor-addons-pro'),
                    'lira'         => '&#8356; ' . esc_html__('Lira', 'sky-elementor-addons-pro'),
                    'krona'        => 'kr ' . esc_html__('Krona', 'sky-elementor-addons-pro'),
                    'peseta'       => '&#8359 ' . esc_html__('Peseta', 'sky-elementor-addons-pro'),
                    'peso'         => '&#8369; ' . esc_html__('Peso', 'sky-elementor-addons-pro'),
                    'pound'        => '&#163; ' . esc_html__('Pound Sterling', 'sky-elementor-addons-pro'),
                    'real'         => 'R$ ' . esc_html__('Real', 'sky-elementor-addons-pro'),
                    'ruble'        => '&#8381; ' . esc_html__('Ruble', 'sky-elementor-addons-pro'),
                    'rupee'        => '&#8360; ' . esc_html__('Rupee', 'sky-elementor-addons-pro'),
                    'indian_rupee' => '&#8377; ' . esc_html__('Rupee (Indian)', 'sky-elementor-addons-pro'),
                    'bdt'          => '&#2547;' . esc_html__('BDT', 'sky-elementor-addons-pro'),
                    'shekel'       => '&#8362; ' . esc_html__('Shekel', 'sky-elementor-addons-pro'),
                    'yen'          => '&#165; ' . esc_html__('Yen/Yuan', 'sky-elementor-addons-pro'),
                    'won'          => '&#8361; ' . esc_html__('Won', 'sky-elementor-addons-pro'),
                    'custom'       => esc_html__('Custom', 'sky-elementor-addons-pro'),
                ],
                'condition' => [
                    'show_pricing' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pricing_currency_symbol_custom',
            [
                'label'       => esc_html__('Custom Symbol', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'condition'   => [
                    'show_pricing' => 'yes',
                    'pricing_currency_symbol' => 'custom',
                ]
            ]
        );

        $this->add_control(
            'pricing_price',
            [
                'label'       => esc_html__('Price', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => '99',
                'condition'   => [
                    'show_pricing' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'price_currency_format',
            [
                'label'   => __('Currency Format', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ',' => '1.234,56 (Default)',
                    ''  => '1,234.56',
                ],
                'default'     => ',',
                'condition'   => [
                    'show_pricing' => 'yes',
                    'pricing_price!' => '',
                ]
            ]
        );



        // $this->add_control(
        //     'pricing_postfix',
        //     [
        //         'label'       => esc_html__('Price Postfix', 'sky-elementor-addons-pro'),
        //         'type'        => Controls_Manager::TEXT,
        //         'dynamic'     => ['active' => true],
        //         'default'     => '.99',
        //         'condition'   => [
        //             'show_pricing' => 'yes',
        //             'pricing_price!' => '',
        //         ]
        //     ]
        // );

        $this->add_control(
            'show_pricing_prefix',
            [
                'label'   => esc_html__('Show Price Prefix', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        /**
         * custom_attributes
         */

        $this->add_control(
            'add_custom_attributes_price',
            [
                'label'     => esc_html__('Advanced Attributes', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'custom_attributes_price',
            [
                'label'       => esc_html__('Custom Attributes', 'sky-elementor-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('data-id|id-100', 'sky-elementor-addons'),
                'description' => esc_html__('Set custom attributes for the link element. Separate attribute keys from values using the | (pipe) character. Separate key-value pairs with a || (double pipe).', 'sky-elementor-addons'),
                'dynamic'     => ['active' => true],
                'condition'   => ['add_custom_attributes_price' => 'yes'],
            ]
        );

        $this->add_control(
            'pricing_sale_show',
            [
                'label'     => esc_html__('Sale Price', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
                'condition' => [
                    'show_pricing' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'pricing_original_price',
            [
                'label'       => esc_html__('Original Price', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'condition'   => [
                    'show_pricing' => 'yes',
                    'pricing_sale_show' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'pricing_period',
            [
                'label'       => esc_html__('Period', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'   => esc_html__('/ mo', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'show_pricing' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'pricing_period_display_position',
            [
                'label'     => esc_html__('Display Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'inline',
                'options'   => [
                    'inline' => esc_html__('Inline', 'sky-elementor-addons-pro'),
                    'bottom' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                ],
                'condition' => [
                    'pricing_period!' => '',
                ],
                'prefix_class'   => 'sa-pricing-period-position-',
            ]
        );

        $this->add_responsive_control(
            'pricing_period_display_alignment',
            [
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
                ],
                'condition' => [
                    'pricing_period!' => '',
                    'pricing_period_display_position' => 'bottom',
                ],
                'selectors' => [
                    '{{WRAPPER}}.sa-pricing-period-position-bottom .sa-period' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        /**
         * style - position control -- TODO
         */

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_features',
            [
                'label'     => esc_html__('Features', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('tabs_features_content');

        $repeater->start_controls_tab(
            'tab_features_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'features_media_type',
            [
                'label'          => esc_html__('Media Type', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'   => [
                        'title' => esc_html__('Icon', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-check',
                    ],
                    'image'  => [
                        'title' => esc_html__('Image', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-image',
                    ],
                    //  was number
                ],
                'default'        => 'icon',
                'toggle'         => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'condition'   => [
                    'features_media_type' => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label'     => esc_html__('Choose Image', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'features_media_type' => 'image'
                ],
                'dynamic'   => ['active' => true],
            ]
        );

        /**
         * was number control
         */

        $repeater->add_control(
            'list_title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('List Title', 'sky-elementor-addons-pro'),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'list_title_tail',
            [
                'label'       => esc_html__('Title Tail', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'list_text',
            [
                'label'       => esc_html__('Text', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_link',
            [
                'label'         => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com', 'sky-elementor-addons-pro'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                ],
                'dynamic'       => ['active' => true],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_features_tooltip',
            [
                'label' => esc_html__('Tooltip', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'list_tooltip_title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_tooltip_text',
            [
                'label'       => esc_html__('Text', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tooltip_placement',
            [
                'label'     => esc_html__('Tooltip Placement', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'top',
                'options'   => [
                    'top'    => esc_html__('Top', 'sky-elementor-addons-pro'),
                    'right'  => esc_html__('Right', 'sky-elementor-addons-pro'),
                    'bottom' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                    'left'   => esc_html__('Left', 'sky-elementor-addons-pro'),
                    'auto'   => esc_html__('Auto', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'features_list',
            [
                'label'       => esc_html__('Feature List', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'list_title' => esc_html__('List Title #1', 'sky-elementor-addons-pro'),
                        'list_text'  => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons-pro'),
                        'list_icon'  =>
                        [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid'
                        ],
                    ],
                    [
                        'list_title' => esc_html__('List Title #2', 'sky-elementor-addons-pro'),
                        'list_text'  => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons-pro'),
                        'list_icon'  =>
                        [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid'
                        ],
                    ],
                    [
                        'list_title' => esc_html__('List Title #3', 'sky-elementor-addons-pro'),
                        'list_text'  => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons-pro'),
                        'list_icon'  =>
                        [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid'
                        ],
                    ],
                    [
                        'list_title' => esc_html__('List Title #4', 'sky-elementor-addons-pro'),
                        'list_text'  => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons-pro'),
                        'list_icon'  =>
                        [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid'
                        ],
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->add_control(
            'show_tail',
            [
                'label'   => esc_html__('Show Tail', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_text',
            [
                'label' => esc_html__('Show Text', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_tooltip',
            [
                'label' => esc_html__('Show Tooltip', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'features_media_position',
            [
                'label'                => esc_html__('Media Position', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
                    'left'   => [
                        'title' => esc_html__('Left', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'style_transfer'       => true,
                'toggle'               => true,
                'default'              => 'left',
                'render_type'              => 'template',
                'selectors'            => [
                    '{{WRAPPER}} .sa-list-wrapper' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'flex-direction: column; align-items: initial;',
                    'bottom' => 'flex-direction: column-reverse; align-items: initial;',
                    'left'   => 'flex-direction: initial; align-items: center;',
                    'right'  => 'flex-direction: row-reverse; align-items: initial;',
                ]
            ]
        );


        $this->add_responsive_control(
            'content_alignment',
            [
                'label'                => esc_html__('Content Alignment', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
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
                'style_transfer'       => true,
                'default'              => 'center',
                'selectors'            => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-list-ul .sa-link'                        => '{{VALUE}};',
                    '{{WRAPPER}} .sa-pricing-table-features .sa-list-ul .sa-media-wrapper' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left'   => 'justify-content: flex-start; text-align: left;',
                    'center' => 'justify-content: center; text-align: center;',
                    'right'  => 'justify-content: flex-end; text-align: right;'
                ]
            ]
        );


        $this->add_control(
            'features_title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => sky_title_tags(),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_pricing_table_footer',
            [
                'label'     => esc_html__('Footer', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'footer_button_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('B U T T O N', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => esc_html__('Button Text', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Choose Plan', 'sky-elementor-addons-pro'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'         => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com', 'sky-elementor-addons-pro'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                ],
                'dynamic'       => ['active' => true],
            ]
        );

        $this->add_control(
            'button_full_width',
            [
                'label'     => esc_html__('Full Width', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_alignment',
            [
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
                'condition' => [
                    'button_full_width' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-card .sa-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'          => esc_html__('Icon Position', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'before' => [
                        'title' => esc_html__('Before', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'after'  => [
                        'title' => esc_html__('After', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'        => 'after',
                'toggle'         => false,
                'condition'      => [
                    'button_icon[value]!' => ''
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'      => esc_html__('Icon Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'condition'  => [
                    'button_icon[value]!' => ''
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button-icon-before .sa-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-button-icon-after .sa-button-icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_css_id',
            [
                'label' => esc_html__('Button ID', 'sky-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'title' => esc_html__('Add your custom id WITHOUT the Pound key. e.g: my-id', 'sky-elementor-addons'),
                'description' => sprintf(
                    esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'sky-elementor-addons'),
                    '<code>',
                    '</code>'
                ),
                'separator' => 'before',
            ]
        );

        /**
         * custom_attributes
         */

        $this->add_control(
            'add_custom_attributes',
            [
                'label'     => esc_html__('Advanced Attributes', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'custom_attributes',
            [
                'label'       => esc_html__('Custom Attributes', 'sky-elementor-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('data-id|id-100', 'sky-elementor-addons'),
                'description' => esc_html__('Set custom attributes for the link element. Separate attribute keys from values using the | (pipe) character. Separate key-value pairs with a || (double pipe).', 'sky-elementor-addons'),
                'dynamic'     => ['active' => true],
                'condition'   => ['add_custom_attributes' => 'yes'],
            ]
        );

        $this->add_control(
            'footer_text_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('F O O T E R  T E X T', 'sky-elementor-addons-pro'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'footer_text',
            [
                'label'   => esc_html__('Text', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is footer text.', 'sky-elementor-addons-pro'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_ribbon',
            [
                'label'     => esc_html__('Ribbon', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_ribbon',
            [
                'label' => esc_html__('Show Ribbon', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ribbon_text',
            [
                'label'   => esc_html__('Text', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Popular Plan', 'sky-elementor-addons-pro'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'condition' => [
                    'show_ribbon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ribbon_style',
            [
                'label'     => esc_html__('Select Style', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style_1',
                'options'   => [
                    'style_1'    => esc_html__('Style 1', 'sky-elementor-addons-pro'),
                ],
                'condition' => [
                    'show_ribbon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ribbon_style1_position',
            [
                'label'     => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => esc_html__('Left', 'sky-elementor-addons-pro'),
                    'right' => esc_html__('Right', 'sky-elementor-addons-pro'),
                ],
                'condition' => [
                    'show_ribbon' => 'yes',
                    'ribbon_style' => 'style_1',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_custom_layout',
            [
                'label' => esc_html__('Custom Layout', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'select_layout',
            [
                'label'     => esc_html__('Select Layout', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default' => 'none',
                'options'   => [
                    'none'     => esc_html__('None', 'sky-elementor-addons-pro'),
                    'media'   => esc_html__('Icon / Image', 'sky-elementor-addons-pro'),
                    'header'   => esc_html__('Header', 'sky-elementor-addons-pro'),
                    'pricing'  => esc_html__('Pricing', 'sky-elementor-addons-pro'),
                    'features' => esc_html__('Features', 'sky-elementor-addons-pro'),
                    'footer'   => esc_html__('Footer', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $this->add_control(
            'layout_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'select_layout' => 'media',
                    ],
                    [
                        'select_layout' => 'header',
                    ],
                    [
                        'select_layout' => 'pricing',
                    ],
                    [
                        'select_layout' => 'features',
                    ],
                    [
                        'select_layout' => 'footer',
                    ],
                ],
                'title_field' => '{{{ select_layout }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_pricing_table_common_style',
            [
                'label' => esc_html__('Common', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pricing_common_alignment',
            [
                'label'                => esc_html__('Alignment', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
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
                'style_transfer'       => true,
                'toggle'               => false,
                'default'              => 'center',
                'selectors'            => [
                    '{{WRAPPER}} .elementor-widget-container'                  => '{{VALUE}};',
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link'          => '{{VALUE}};',
                    '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left'   => 'text-align: left; justify-content: left;',
                    'center' => 'text-align: center; justify-content: center;',
                    'right'  => 'text-align: right; justify-content: right;'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tooltip',
            [
                'label' => esc_html__('Tooltip Settings', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_tooltip' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tooltip_animation',
            [
                'label'   => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'shift-away',
                'options' => [
                    'shift-away'   => esc_html__('Shift-Away', 'sky-elementor-addons-pro'),
                    'shift-toward' => esc_html__('Shift-Toward', 'sky-elementor-addons-pro'),
                    'scale'        => esc_html__('Scale', 'sky-elementor-addons-pro'),
                    'perspective'  => esc_html__('Perspective', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $this->add_control(
            'tooltip_offset_popover',
            [
                'label' => esc_html__('Offset', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::POPOVER_TOGGLE,
            ]
        );


        $this->start_popover();

        $this->add_control(
            'tooltip_x_offset',
            [
                'label'          => esc_html__('X Offset', 'sky-elementor-addons-pro'),
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
                'condition'      => [
                    'tooltip_offset_popover' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tooltip_y_offset',
            [
                'label'          => esc_html__('Y Offset', 'sky-elementor-addons-pro'),
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
                'condition'      => [
                    'tooltip_offset_popover' => 'yes'
                ],
            ]
        );

        $this->end_popover();


        $this->add_control(
            'tooltip_arrow',
            [
                'label'   => esc_html__('Show Arrow', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tooltip_trigger_on_click',
            [
                'label'       => esc_html__('Trigger on Click', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('By default tooltip will show on hover, if you will activate this option tooltip will show on click.', 'sky-elementor-addons-pro'),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_header_style',
            [
                'label' => esc_html__('Header', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'header_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-header',
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'header_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-header',
            ]
        );

        $this->add_responsive_control(
            'header_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'header_title_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Title', 'sky-elementor-addons-pro'),
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => esc_html__('Bottom Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-header .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-header .sa-title',
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->start_controls_tabs(
            'tabs_title_style',
            [
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-header .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-header .sa-title',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-header .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-header .sa-title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'header_sub_title_heading',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Sub Title', 'sky-elementor-addons-pro'),
                'separator' => 'before',
                'condition' => [
                    'sub_title!'     => '',
                    'show_sub_title' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-header .sa-sub-title',
                'condition' => [
                    'sub_title!'     => '',
                    'show_sub_title' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('tabs_sub_title_style', [
            'condition' => [
                'sub_title!'     => '',
                'show_sub_title' => 'yes'
            ]
        ]);

        $this->start_controls_tab(
            'tab_sub_title_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-header .sa-sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'sub_title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-header .sa-sub-title',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_sub_title_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'sub_title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-header .sa-sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'sub_title_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-header .sa-sub-title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_media_style',
            [
                'label' => esc_html__('Image / Icon', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pricing_media' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_media_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-pricing-table-media .sa-media-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_media_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}' => '--sa-media-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_media_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-media img, {{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_media_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-media img, 
                            {{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap',
            ]
        );

        $this->add_responsive_control(
            'pricing_media_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-media img, 
                            {{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_media_number_icon_heading',
            [
                'label'     => esc_html__('Icon', 'sky-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('pricing_media_tabs');

        $this->start_controls_tab(
            'pricing_media_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons'),
            ]
        );


        $this->add_control(
            'pricing_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'pricing_media_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pricing_media_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-media img, 
                            {{WRAPPER}} .sa-pricing-table-media .sa-icon-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pricing_media_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'pricing_icon_color_hover',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'pricing_media_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-media .sa-icon-wrap' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-media .sa-icon-wrap svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pricing_icon_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-media .sa-icon-wrap',
            ]
        );

        $this->add_control(
            'pricing_media_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-pricing-table-media .sa-icon-wrap' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pricing_media_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_pricing_style',
            [
                'label' => esc_html__('Pricing', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_pricing' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pricing_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-pricing',
            ]
        );

        $this->add_responsive_control(
            'pricing_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_price_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('P R I C E', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'pricing_price!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_price_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_price_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-currency' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_price_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-currency' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_price_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-currency',
                'condition'   => [
                    'pricing_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pricing_price_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-currency',
                'condition'   => [
                    'pricing_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_postfix_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('P O S T F I X', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'price_currency_format' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_postfix_position',
            [
                'label'     => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'  => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'   => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'price_currency_format' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-postfix' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'justify-content:  flex-start;',
                    'middle' => 'justify-content: space-around;',
                    'bottom' => 'justify-content: flex-end;'
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_postfix_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-postfix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_postfix_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-postfix' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'price_currency_format' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_postfix_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-postfix' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'price_currency_format' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_postfix_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-postfix',
                'condition'   => [
                    'price_currency_format' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pricing_postfix_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-postfix',
                'condition'   => [
                    'price_currency_format' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_prefix_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('P R E F I X', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'show_pricing_prefix' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_prefix_position',
            [
                'label'     => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'  => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'   => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'show_pricing_prefix' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-prefix' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'justify-content:  flex-start;',
                    'middle' => 'justify-content: space-around;',
                    'bottom' => 'justify-content: flex-end;'
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_prefix_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_prefix_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-prefix' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'show_pricing_prefix' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_prefix_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-prefix' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'show_pricing_prefix' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_prefix_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-prefix',
                'condition'   => [
                    'show_pricing_prefix' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pricing_prefix_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-prefix',
                'condition'   => [
                    'show_pricing_prefix' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_original_price_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('O R I G I N A L - P R I C E', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_original_price_position',
            [
                'label'     => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'  => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'   => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-original-price' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'justify-content:  flex-start;',
                    'middle' => 'justify-content: space-around;',
                    'bottom' => 'justify-content: flex-end;'
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_original_price_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-original-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_original_price_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-original-price' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_original_price_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-original-price' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_original_price_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-original-price',
                'condition'   => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pricing_original_price_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-original-price',
                'condition'   => [
                    'pricing_sale_show' => 'yes',
                    'pricing_original_price!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_period_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('P E R I O D', 'sky-elementor-addons-pro'),
                'condition'   => [
                    'pricing_period!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_period_position',
            [
                'label'     => esc_html__('Position', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'  => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'   => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'pricing_period!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-period' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top'    => 'justify-content:  flex-start;',
                    'middle' => 'justify-content: space-around;',
                    'bottom' => 'justify-content: flex-end;'
                ]
            ]
        );

        $this->add_responsive_control(
            'pricing_period_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_period_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-period' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_period!' => '',
                ],
            ]
        );

        $this->add_control(
            'pricing_period_color_hover',
            [
                'label'     => esc_html__('Hover Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .sa-period' => 'color: {{VALUE}}',
                ],
                'condition'   => [
                    'pricing_period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_period_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-period',
                'condition'   => [
                    'pricing_period!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'pricing_period_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-period',
                'condition'   => [
                    'pricing_period!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_pricing_adv_design',
            [
                'label'        => esc_html__('Advanced Design', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'separator'    => 'before',
            ]
        );

        $this->add_responsive_control(
            'pricing_adv_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pricing_adv_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-wrap-parent',
                'condition' => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_adv_size',
            [
                'label'      => esc_html__('Background Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'description' => esc_html__('Please use to make the Height and Width of the background the same.', 'sky-elementor-addons-pro'),
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-wrap-parent' => 'height:  calc({{SIZE}}{{UNIT}} - 2px); width: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_adv_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-wrap-parent',
                'condition' => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_adv_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-wrap-parent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pricing_adv_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-wrap-parent',
                'condition' => [
                    'show_pricing_adv_design' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_pricing_table_features_style',
            [
                'label' => esc_html__('Features', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'features_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features',
            ]
        );

        $this->add_responsive_control(
            'features_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('L I S T', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_responsive_control(
            'list_alignment',
            [
                'label'                => esc_html__('Alignment', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
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
                'style_transfer'       => true,
                'default'              => 'left',
                'selectors'            => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-list-ul' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left'   => 'text-align: left;',
                    'center' => 'text-align: center;',
                    'right'  => 'text-align: right;'
                ],
                'condition'            => [
                    'list_layout' => 'inline'
                ]
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label'      => esc_html__('Space Between', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--list-space-between: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'min_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'list_divider',
            [
                'label'       => esc_html__('Divider', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'list_divider_style',
            [
                'label'     => esc_html__('Divider Style', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'solid',
                'options'   => [
                    'none'   => esc_html__('None', 'sky-elementor-addons-pro'),
                    'solid'  => esc_html__('Solid', 'sky-elementor-addons-pro'),
                    'dashed' => esc_html__('Dashed', 'sky-elementor-addons-pro'),
                    'dotted' => esc_html__('Dotted', 'sky-elementor-addons-pro'),
                    'double' => esc_html__('Double', 'sky-elementor-addons-pro'),
                ],
                'condition'  => [
                    'list_divider' => 'yes'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--list-divider-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_divider_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'condition'  => [
                    'list_divider' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--list-divider-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_divider_thickness',
            [
                'label'      => esc_html__('Thickness', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'condition'  => [
                    'list_divider' => 'yes'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--list-divider-thickness: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('list_tabs');

        $this->start_controls_tab(
            'list_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'list_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-link',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'list_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-link',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'list_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'list_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'features_media_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('M E D I A', 'sky-elementor-addons-pro'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_media_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--media-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_media_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features' => '--tidy-media-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_media_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-pricing-table-features  .sa-media-wrapper .sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'features_media_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper .sa-icon-wrap',
            ]
        );

        $this->add_responsive_control(
            'features_media_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper .sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_media_icon_heading',
            [
                'label'     => esc_html__('I C O N', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('features_media_tabs');

        $this->start_controls_tab(
            'features_media_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );


        $this->add_control(
            'features_media_icon_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper .sa-icon-wrap' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper .sa-icon-wrap *'                       => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'features_media_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-pricing-table-features .sa-media-wrapper .sa-icon-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'features_media_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'features_media_icon_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover .sa-media-wrapper .sa-icon-wrap' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-pricing-table-features  .sa-link:hover .sa-media-wrapper .sa-icon-wrap *'                                      => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'features_media_icon_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover .sa-media-wrapper .sa-icon-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'features_title_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('T I T L E', 'sky-elementor-addons-pro'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label'      => esc_html__('Bottom Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'features_title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'features_title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title',
            ]
        );

        $this->add_control(
            'features_title_tail_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('T A I L', 'sky-elementor-addons-pro'),
                'separator' => 'before',
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'features_title_tail_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_title_tail_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail',
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'features_title_tail_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'features_title_tail_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail',
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );


        $this->add_responsive_control(
            'features_title_tail_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'features_title_tail_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail',
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'features_title_tail_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'features_title_tail_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-title-tail',
                'condition' => [
                    'show_tail' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'features_text_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('T E X T', 'sky-elementor-addons-pro'),
                'separator' => 'before',
                'condition' => [
                    'show_text' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-features .sa-text',
                'condition' => [
                    'show_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'features_text_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'features_text_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-features .sa-link:hover .sa-text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_text' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_pricing_table_footer_style',
            [
                'label' => esc_html__('Footer', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'footer_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-footer',
            ]
        );

        $this->add_responsive_control(
            'footer_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'footer_button_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('B U T T O N', 'sky-elementor-addons-pro'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'button_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'button_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-button:hover',
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__('Animation', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'footer_text_heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('F O O T E R  T E X T', 'sky-elementor-addons-pro'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'footer_text_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-pricing-table-footer .sa-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'footer_text_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-footer .sa-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'footer_text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-footer .sa-text',
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'footer_text_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-footer .sa-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tooltip_style',
            [
                'label' => esc_html__('Tooltip', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_tooltip' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'tooltip_max_width',
            [
                'label'       => esc_html__('Width', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em'],
                'range'       => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'selectors'   => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'max-width: calc({{SIZE}}{{UNIT}} - 10px) !important;',
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'tooltip_alignment',
            [
                'label'     => esc_html__('Alignment', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
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
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'tooltip_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
            ]
        );

        $this->add_responsive_control(
            'tooltip_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tooltip_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
            ]
        );

        $this->add_responsive_control(
            'tooltip_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tooltip_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
            ]
        );

        $this->start_controls_tabs('tooltip_tabs');

        $this->start_controls_tab(
            'tooltip_tab_normal',
            [
                'label' => esc_html__('Title', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'tooltip_title_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content .sa-tippy-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tooltip_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content .sa-tippy-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tooltip_tab_hover',
            [
                'label' => esc_html__('Text', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'tooltip_text_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tooltip_text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tooltip_heading_arrow',
            [
                'label'     => esc_html__('A R R O W - S T Y L E', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tooltip_arrow_color',
            [
                'label'     => esc_html__('Arrow Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_ribbon_style',
            [
                'label'           => esc_html__('Ribbon', 'sky-elementor-addons-pro'),
                'tab'             => Controls_Manager::TAB_STYLE,
                'condition'       => [
                    'show_ribbon' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ribbon_fold_part',
            [
                'label'          => esc_html__('Fold Part', 'sky-elementor-addons-pro'),
                'size_units' => ['px', 'em'],
                'type'           => Controls_Manager::SLIDER,
                'range'          => [
                    'px' => [
                        'min'  => 1,
                        'step' => .5,
                        'max'  => 20,
                    ],
                ],
                'condition'      => [
                    'show_ribbon'  => 'yes',
                    'ribbon_style' => 'style_1',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-widget-container' => '--sa-d: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ribbon_vertical_spacing',
            [
                'label'          => esc_html__('Vertical Spacing', 'sky-elementor-addons-pro'),
                'size_units' => ['px', 'em'],
                'type'           => Controls_Manager::SLIDER,
                'range'          => [
                    'px' => [
                        'min'  => 1,
                        'step' => .5,
                        'max'  => 20,
                    ],
                ],
                'condition'      => [
                    'show_ribbon'  => 'yes',
                    'ribbon_style' => 'style_1',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-widget-container' => '--sa-p: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ribbon_spacing',
            [
                'label'          => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'size_units' => ['px', 'em'],
                'type'           => Controls_Manager::SLIDER,
                'range'          => [
                    'px' => [
                        'min'  => 0,
                        'step' => .5,
                        'max'  => 100,
                    ],
                ],
                'condition'      => [
                    'show_ribbon'  => 'yes',
                    'ribbon_style' => 'style_1',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-widget-container' => '--sa-s: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-pricing-table-ribbon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ribbon_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'exclude'  => ['image'],
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-pricing-table-ribbon',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ribbon_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-pricing-table-ribbon',
            ]
        );

        $this->end_controls_section();
    }

    private function sky_get_currency_symbol($symbol_name) {
        $symbols = [
            'dollar'       => '&#36;',
            'baht'         => '&#3647;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'lira'         => '&#8356;',
            'krona'        => 'kr',
            'peseta'       => '&#8359',
            'peso'         => '&#8369;',
            'pound'        => '&#163;',
            'real'         => 'R$',
            'ruble'        => '&#8381;',
            'rupee'        => '&#8360;',
            'indian_rupee' => '&#8377;',
            'bdt'          => '&#2547;',
            'shekel'       => '&#8362;',
            'yen'          => '&#165;',
            'won'          => '&#8361;',
        ];
        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render_pricing_media() {
        $settings = $this->get_settings_for_display();
        if ('yes' !== $settings['show_pricing_media']) {
            return;
        }
?>
        <div class="sa-pricing-table-media">
            <?php if (!empty($settings['pricing_media_image']['url']) && $settings['pricing_media_type'] == 'image') : ?>
                <figure class="sa-header-figure sa-media-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'pricing_media_thumbnail', 'pricing_media_image'); ?>
                </figure>
            <?php endif; ?>
            <?php if (!empty($settings['pricing_icon']['value']) && $settings['pricing_media_type'] == 'icon') : ?>
                <figure class="sa-header-figure sa-icon-wrap">
                    <?php
                    Icons_Manager::render_icon($settings['pricing_icon'], [
                        'aria-hidden' => 'true',
                    ]);
                    ?>
                </figure>
            <?php endif; ?>
        </div>
    <?php
    }
    protected function render_pricing_header() {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="sa-pricing-table-header sa-mb-4">
            <?php
            if (!empty($settings['title'])) {
                $this->add_render_attribute('title', 'class', 'sa-title sa--title sa--text-title sa-mt-0 sa-mb-1 sa-fs-4');
                $this->add_inline_editing_attributes('title', 'none');

                printf(
                    '<%1$s %2$s>%3$s</%1$s>',
                    Utils::validate_html_tag($settings['title_tag']),
                    $this->get_render_attribute_string('title'),
                    wp_kses_post($settings['title'])
                );
            }

            if ($settings['show_sub_title'] == 'yes' && !empty($settings['sub_title'])) {
                $this->add_render_attribute('sub_title', 'class', 'sa--text-sub-title sa--sub-title sa-sub-title sa-mt-0 sa-mb-1 sa-fs-6');
                $this->add_inline_editing_attributes('sub_title', 'none');

                printf(
                    '<%1$s %2$s>%3$s</%1$s>',
                    Utils::validate_html_tag($settings['sub_title_tag']),
                    $this->get_render_attribute_string('sub_title'),
                    wp_kses_post($settings['sub_title'])
                );
            }
            ?>
        </div>
    <?php
    }

    protected function render_pricing_footer() {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="sa-pricing-table-footer">
            <?php

            $this->add_render_attribute('link_attr', 'class', 'sa-button sa-d-inline-block sa-text-decoration-none sa-py-3 sa-px-4 sa-rounded');
            $this->add_render_attribute('link_attr', 'class', ($settings['button_full_width'] == 'yes') ? 'sa-d-block' : '');

            if ('yes' == $settings['add_custom_attributes'] && !empty($settings['custom_attributes'])) {
                /**
                 * Custom URL attributes should come as a string of ||-delimited key|value pairs
                 */
                $attributes =  Utils::parse_custom_attributes($settings['custom_attributes'], '||');

                if ($attributes) {
                    $this->add_render_attribute('link_attr', $attributes);
                }
            }

            if (!empty($settings['button_css_id'])) {
                $this->add_render_attribute('link_attr', 'id', esc_html($settings['button_css_id']));
            }


            if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('link_attr', $settings['link']);
            } else {
                $this->add_render_attribute('link_attr', 'href', 'javascript:void(0);');
            }

            if ($settings['button_hover_animation']) {
                $this->add_render_attribute('link_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
            }

            if (!empty($settings['button_text'])) :
                $this->add_render_attribute('link_attr', 'class', 'sa-button-icon-' . $settings['button_icon_position']);
            endif;

            ?>
            <a <?php echo $this->get_render_attribute_string('link_attr'); ?>>
                <?php
                if (!empty($settings['button_icon']['value']) && $settings['button_icon_position'] == 'before') {
                    Icons_Manager::render_icon($settings['button_icon'], [
                        'aria-hidden' => 'true',
                        'class'       => 'sa-button-icon'
                    ]);
                }

                if (!empty($settings['button_text'])) :
                    $this->add_render_attribute('button_text', 'class', 'sa-button-text');
                    $this->add_inline_editing_attributes('button_text', 'none');

                    printf(
                        '<span %1$s>%2$s</span>',
                        $this->get_render_attribute_string('button_text'),
                        esc_html($settings['button_text'])
                    );

                endif;
                if (!empty($settings['button_icon']['value']) && $settings['button_icon_position'] == 'after') {
                    Icons_Manager::render_icon($settings['button_icon'], [
                        'aria-hidden' => 'true', 'class'       => 'sa-button-icon'
                    ]);
                }
                ?>
            </a>
            <?php
            ?>

            <?php if (!empty($settings['footer_text'])) : ?>
                <div class="sa-text sa-mt-3">
                    <?php
                    echo wp_kses_post($settings['footer_text']);
                    ?>
                </div>
            <?php endif; ?>

        </div>
    <?php
    }
    protected function render_pricing_features() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('features-attr', 'class', [
            'sa-pricing-table-features sa-mb-4  sa-py-3',
            'sa-media-position--' . esc_attr($settings['features_media_position']),
            'sa-separator--' . esc_attr($settings['list_divider'])
        ], true);

    ?>
        <div <?php echo $this->get_render_attribute_string('features-attr'); ?>>
            <ul class="sa-list-ul sa-list-style-none sa-m-0 sa-p-0">
                <?php
                foreach ($settings['features_list'] as $index => $item) {
                    $tippy_class = (!empty($item['list_tooltip_title']) || !empty($item['list_tooltip_text'])) && 'yes' == $settings['show_tooltip'] ? ' sa-tippy-tooltip' : '';
                    $this->add_render_attribute('feature-link-attr', 'class', 'sa-link sa-list-wrapper sa-d-flex sa-align-items-center sa-py-1 sa-text-decoration-none' . $tippy_class, true);
                    $tag = 'div';
                    if (!empty($item['list_link']['url'])) {
                        $this->add_render_attribute('feature-link-attr', 'href', esc_url($item['list_link']['url']), true);

                        if ($item['list_link']['is_external']) {
                            $this->add_render_attribute('feature-link-attr', 'target', '_blank', true);
                        }

                        if ($item['list_link']['nofollow']) {
                            $this->add_render_attribute('feature-link-attr', 'rel', 'nofollow', true);
                        }
                        $tag = 'a';
                    } else {
                        $this->remove_render_attribute('feature-link-attr', 'target', '', true);
                        $this->remove_render_attribute('feature-link-attr', 'rel', '', true);
                        $this->remove_render_attribute('feature-link-attr', 'href', '', true);
                        $tag = 'div';
                    }

                    /**
                     * tooltip
                     */
                    if ((!empty($item['list_tooltip_title']) || !empty($item['list_tooltip_text'])) && 'yes' == $settings['show_tooltip']) :
                        $this->add_render_attribute('tooltip-attr' . $index, 'class', 'sa-tippy-tooltip');
                        $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy', '', true);

                        $tooltip_content = !empty($item['list_tooltip_title']) ? '<span class="sa-tippy-title sa-d-block sa-fw-bold mb-1 sa-fw-5">' . wp_kses_post($item['list_tooltip_title']) . '</span>' : '';
                        $tooltip_content .= !empty($item['list_tooltip_text']) ? wp_kses_post($item['list_tooltip_text']) : '';

                        $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-content', $tooltip_content, true);

                        if ($item['tooltip_placement']) {
                            $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-placement', esc_attr($item['tooltip_placement']), true);
                        }

                        if ($settings['tooltip_animation']) {
                            $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-animation', esc_attr($settings['tooltip_animation']), true);
                        }

                        if ($settings['tooltip_offset_popover'] == 'yes') {
                            if ($settings['tooltip_x_offset']['size'] or $settings['tooltip_y_offset']['size']) {
                                $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-offset', '[' . $settings['tooltip_x_offset']['size'] . ',' . $settings['tooltip_y_offset']['size'] . ']', true);
                            }
                        }

                        if ($settings['tooltip_arrow'] == 'yes') {
                            $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-arrow', 'true', true);
                        } else {
                            $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-arrow', 'false', true);
                        }

                        if ($settings['tooltip_trigger_on_click'] == 'yes') {
                            $this->add_render_attribute('tooltip-attr' . $index, 'data-tippy-trigger', 'click', true);
                        }

                    endif;

                    $tail = !empty($item['list_title_tail']) && ($settings['show_tail'] == 'yes') ? ' sa-w-100'  : '';

                ?>
                    <li class="sa-list-item">
                        <<?php echo esc_attr($tag); ?> <?php echo $this->get_render_attribute_string('feature-link-attr'); ?> <?php echo $this->get_render_attribute_string('tooltip-attr' . $index); ?>>
                            <?php if (!empty($item['features_media_type'])) : ?>
                                <div class="sa-me-3 sa-media-wrapper sa-align-items-center sa-d-flex">
                                <?php endif; ?>

                                <?php if ($item['features_media_type'] == 'icon' && !empty($item['list_icon']['value'])) : ?>

                                    <div class="sa-icon-wrap sa-text-center sa-align-items-center sa-d-flex">
                                        <?php
                                        Icons_Manager::render_icon($item['list_icon'], [
                                            'aria-hidden' => 'true'
                                        ]);
                                        ?>
                                    </div>

                                <?php elseif ($item['features_media_type'] == 'image' && !empty($item['list_image']['url'])) : ?>

                                    <div class="sa-img-wrap sa-d-inline-block sa-align-items-center sa-d-flex">
                                        <?php
                                        if ($item['list_image']['id']) {
                                            print(wp_get_attachment_image(
                                                $item['list_image']['id'],
                                                'full',
                                                false,
                                                [
                                                    'alt'   => esc_html($item['list_title'])
                                                ]
                                            ));
                                        } else {
                                            printf('<img src="%1$s" alt="%2$s">', $item['list_image']['url'], esc_html($item['list_title']));
                                        }
                                        ?>
                                    </div>

                                <?php else : ?>

                                <?php endif; ?>

                                <?php if (!empty($item['features_media_type'])) : ?>
                                </div>
                            <?php endif; ?>

                            <div class="sa-content-wrapper <?php echo esc_attr($tail); ?>">
                                <?php
                                if (!empty($item['list_title'])) :
                                    printf('<%s class="sa--title sa--text-title sa-title sa-mt-0 sa-mb-0"> %s </%s>', Utils::validate_html_tag($settings['features_title_tag']), wp_kses_post($item['list_title']), Utils::validate_html_tag($settings['features_title_tag']));
                                endif;

                                if (!empty($item['list_text']) && ($settings['show_text'] == 'yes')) : ?>
                                    <div class="sa--text sa--text-info sa-text">
                                        <?php echo wp_kses_post($item['list_text']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($item['list_title_tail']) && ($settings['show_tail'] == 'yes')) : ?>
                                <div class="sa-title-tail">
                                    <?php echo wp_kses_post($item['list_title_tail']); ?>
                                </div>
                            <?php endif; ?>

                        </<?php echo esc_attr($tag); ?>>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php
    }

    protected function render_pricing_pricing() {
        $settings = $this->get_settings_for_display();
        $symbol = '';
        if ($settings['show_pricing'] != 'yes') {
            return;
        }

        if (!empty($settings['pricing_currency_symbol'])) {
            if ('custom' !== $settings['pricing_currency_symbol']) {
                $symbol = $this->sky_get_currency_symbol($settings['pricing_currency_symbol']);
            } else {
                $symbol = $settings['pricing_currency_symbol_custom'];
            }
        }

        $currency_format = empty($settings['price_currency_format']) ? '.' : $settings['price_currency_format'];
        $price           = explode($currency_format, $settings['pricing_price']);
        $intpart         = $price[0];
        $fraction        = '';
        if (2 === count($price)) {
            $fraction = $price[1];
        }

        $this->add_render_attribute('pricing-parent', 'class', 'sa-pricing-wrap-parent sa-justify-content-center');
        // if($settings['pricing_adv_square'] == 'yes'){
        //     $this->add_render_attribute('pricing-parent', 'class', 'sa-adv-square');
        // }


        $this->add_render_attribute('price_attr', 'class', 'sa-currency');

        if ('yes' == $settings['add_custom_attributes_price'] && !empty($settings['custom_attributes_price'])) {
            /**
             * Custom URL attributes should come as a string of ||-delimited key|value pairs
             * By default delimiter is (,) but we set it ||
             */
            $attributes = Utils::parse_custom_attributes($settings['custom_attributes_price'], '||');

            if ($attributes) {
                $this->add_render_attribute('price_attr', $attributes);
            }
        }

    ?>
        <div class="sa-pricing-table-pricing sa-mb-4">
            <div <?php echo $this->get_render_attribute_string('pricing-parent'); ?>>
                <div class="sa-pricing-wrap">
                    <?php if ('yes' == $settings['pricing_sale_show'] && !empty($settings['pricing_original_price'])) : ?>
                        <span class="sa-original-price">
                            <?php echo esc_html($symbol) . esc_html($settings['pricing_original_price']); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ('yes' == $settings['show_pricing_prefix']) : ?>
                        <span class="sa-prefix"><?php echo esc_html($symbol); ?></span>
                    <?php endif; ?>
                    <span class="sa-price">
                        <?php if (!empty($settings['pricing_price']) && !empty($intpart)) : ?>
                            <span <?php echo $this->get_render_attribute_string('price_attr'); ?>>
                                <?php echo esc_html($intpart); ?>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($fraction) && ('' != $fraction)) : ?>
                            <span class="sa-postfix"><?php echo esc_html($fraction); ?></span>
                        <?php endif; ?>
                    </span>

                    <?php if (!empty($settings['pricing_period'])) : ?>
                        <span class="sa-period"><?php echo esc_html($settings['pricing_period']); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }
    protected function render_ribbon() {
        $settings = $this->get_settings_for_display();
        if ('yes' != $settings['show_ribbon']) {
            return;
        }

    ?>
        <?php
        if ('style_1' == $settings['ribbon_style']) :
            $ribbon_style1_pos = $settings['ribbon_style1_position'] == 'left' ? ' sa-ribbon-left-top' : ' sa-ribbon-right-top';
            $this->add_render_attribute(
                'ribbon_style1',
                'class',
                [
                    'sa-pricing-table-ribbon sa-text-uppercase',
                    $ribbon_style1_pos
                ],
                true
            );
        ?>
            <span <?php echo $this->get_render_attribute_string('ribbon_style1'); ?>>
                <?php echo wp_kses_post($settings['ribbon_text']); ?>
            </span>

        <?php endif; ?>
    <?php
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = 'sa-pricing-table-' . $this->get_id();

        $this->add_render_attribute(
            [
                'pricing-table' => [
                    'class'          => 'sa-pricing-table',
                ]
            ]
        );
    ?>
        <div <?php echo $this->get_render_attribute_string('pricing-table'); ?>>

            <?php

            $this->render_ribbon();

            foreach ($settings['layout_list'] as $item) {
                if ('none' !== $item['select_layout']) :
                    switch ($item['select_layout']) {
                        case 'media':
                            $this->render_pricing_media();
                            break;
                        case 'header':
                            $this->render_pricing_header();
                            break;
                        case 'pricing':
                            $this->render_pricing_pricing();
                            break;
                        case 'features':
                            $this->render_pricing_features();
                            break;
                        case 'footer':
                            $this->render_pricing_footer();
                            break;

                        default:
                            esc_html_e('Doing something wrong!', 'sky-elementor-addons-pro');
                            break;
                    }
                endif;
            }

            ?>

        </div>

<?php
    }
}
