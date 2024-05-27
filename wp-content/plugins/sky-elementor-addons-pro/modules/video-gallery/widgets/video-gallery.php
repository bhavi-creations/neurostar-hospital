<?php

namespace Sky_Addons_Pro\Modules\VideoGallery\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Embed;
use Elementor\Widget_Base;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Video_Gallery extends Widget_Base
{

    public function get_name()
    {
        return 'sky-video-gallery';
    }

    public function get_title()
    {
        return esc_html__('Video Gallery', 'sky-elementor-addons-pro');
    }

    public function get_icon()
    {
        return 'sky-icon-video-gallery';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons-pro'];
    }

    public function get_keywords()
    {
        return ['sky', 'video', 'gallery', 'youtube', 'vimeo', 'dailymotion'];
    }

    public function get_style_depends()
    {
        return [
            'elementor-icons-fa-solid',
        ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_video_gallery',
            [
                'label' => esc_html__('Video Gallery', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_gallery_layout',
            [
                'label'          => esc_html__('Layout', 'sky-elementor-addons-pro'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'vertical'   => [
                        'title' => esc_html__('Vertical', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-navigation-vertical',
                    ],
                    'horizontal' => [
                        'title' => esc_html__('Horizontal', 'sky-elementor-addons-pro'),
                        'icon'  => 'eicon-navigation-horizontal',
                    ],
                ],
                'style_transfer' => true,
                'toggle'         => false,
                'default'        => 'vertical',
                'prefix_class'   => 'sa-video-gallery-layout-',
                'render_type'    => 'template'
            ]
        );

        $this->add_responsive_control(
            'video_gallery_size',
            [
                'label'       => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em'],
                'range'       => [
                    'px' => [
                        'min' => 400,
                        'max' => 1000,
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .sa-video-gallery' => 'height: {{SIZE}}{{UNIT}}; --sa-video-gallery-size: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('video_tabs');

        $repeater->start_controls_tab(
            'tab_video',
            [
                'label' => esc_html__('Video', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'video_type',
            [
                'label'   => esc_html__('Source', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube'     => esc_html__('YouTube', 'sky-elementor-addons-pro'),
                    'vimeo'       => esc_html__('Vimeo', 'sky-elementor-addons-pro'),
                    'dailymotion' => esc_html__('Dailymotion', 'sky-elementor-addons-pro'),
                    'hosted'      => esc_html__('Self Hosted', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $repeater->add_control(
            'youtube_url',
            [
                'label'       => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__('Enter your URL', 'sky-elementor-addons-pro') . ' (YouTube)',
                'default'     => 'https://youtu.be/aqz-KE-bpKQ',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'youtube',
                ],
            ]
        );

        $repeater->add_control(
            'vimeo_url',
            [
                'label'       => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__('Enter your URL', 'sky-elementor-addons-pro') . ' (Vimeo)',
                'default'     => 'https://vimeo.com/226020936',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $repeater->add_control(
            'dailymotion_url',
            [
                'label'       => esc_html__('Link', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__('Enter your URL', 'sky-elementor-addons-pro') . ' (Dailymotion)',
                'default'     => 'https://www.dailymotion.com/video/x6tqhqb',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'dailymotion',
                ],
            ]
        );

        $repeater->add_control(
            'external_url_set',
            [
                'label'     => esc_html__('External URL', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_type' => 'hosted',
                ],
            ]
        );

        $repeater->add_control(
            'external_url',
            [
                'label'        => esc_html__('URL', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::URL,
                'autocomplete' => false,
                'options'      => false,
                'label_block'  => true,
                'show_label'   => false,
                'dynamic'      => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'media_type'   => 'video',
                'placeholder'  => esc_html__('Enter your URL', 'sky-elementor-addons-pro'),
                'condition'    => [
                    'video_type'       => 'hosted',
                    'external_url_set' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'hosted_url',
            [
                'label'      => esc_html__('Choose File', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::MEDIA,
                'dynamic'    => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition'  => [
                    'video_type'        => 'hosted',
                    'external_url_set!' => 'yes',
                ],
            ]
        );



        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_content',
            [
                'label' => esc_html__('Content', 'sky-elementor-addons-pro'),
            ]
        );


        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('List Title', 'sky-elementor-addons-pro'),
                'label_block' => true,
                'rows'        => 4,
                'dynamic'     => ['active' => true],
            ]
        );

        $repeater->add_control(
            'credit',
            [
                'label'       => esc_html__('Credit / Subtitle', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('John Doe', 'sky-elementor-addons-pro'),
                'label_block' => true,
                'dynamic'     => ['active' => true],
            ]
        );

        $repeater->add_control(
            'add_credit_url',
            [
                'label' => esc_html__('Add Credit URL', 'sky-elementor-addons-pro'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control(
            'credit_url',
            [
                'label'         => esc_html__('Credit URL', 'sky-elementor-addons-pro'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('https://your-link.com', 'sky-elementor-addons-pro'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                ],
                'dynamic'       => ['active' => true],
                'condition'     => ['add_credit_url' => 'yes']
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_poster',
            [
                'label' => esc_html__('Poster', 'sky-elementor-addons-pro'),
            ]
        );

        $repeater->add_control(
            'poster',
            [
                'label'       => esc_html__('Poster', 'sky-elementor-addons-pro'),
                'type'        => Controls_Manager::MEDIA,
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();


        $this->add_control(
            'video_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'separator'   => 'before',
                'default'     => [
                    [
                        'title'  => esc_html__('Youtube Video Title #1', 'sky-elementor-addons-pro'),
                        'credit' => esc_html__('by Sumaiya A\'lia Nassar', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'      => esc_html__('Vimeo Video Title #2', 'sky-elementor-addons-pro'),
                        'credit'     => esc_html__('by Ahmad Fawzan', 'sky-elementor-addons-pro'),
                        'video_type' => 'vimeo'
                    ],
                    [
                        'title'      => esc_html__('Dailymotion Video Title #3', 'sky-elementor-addons-pro'),
                        'credit'     => esc_html__('by Fatin Rushdi ', 'sky-elementor-addons-pro'),
                        'video_type' => 'dailymotion'
                    ],
                    [
                        'title'            => esc_html__('Remote Video Title #4', 'sky-elementor-addons-pro'),
                        'credit'           => esc_html__('by Mike Ross', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'  => esc_html__('Youtube Video Title #5', 'sky-elementor-addons-pro'),
                        'credit' => esc_html__('by John Doe', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'  => esc_html__('Youtube Video Title #6', 'sky-elementor-addons-pro'),
                        'credit' => esc_html__('by Mike Doe', 'sky-elementor-addons-pro'),
                    ],
                    [
                        'title'      => esc_html__('Youtube Video Title #7', 'sky-elementor-addons-pro'),
                        'credit'     => esc_html__('by Michael N. Chiles', 'sky-elementor-addons-pro'),
                        'video_type' => 'dailymotion'
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_player_settings',
            [
                'label' => esc_html__('Player Settings', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'   => esc_html__('Direction', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'sky-elementor-addons-pro'),
                    'vertical'   => esc_html__('Vertical', 'sky-elementor-addons-pro'),
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'   => esc_html__('Loop', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'   => esc_html__('Slide Speed (sec)', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => .5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => .3,
                ],
            ]
        );

        $this->add_control(
            'transition_effect',
            [
                'label'   => esc_html__('Transition Effect', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide'     => esc_html__('Slide', 'sky-elementor-addons-pro'),
                    'fade'      => esc_html__('Fade', 'sky-elementor-addons-pro'),
                    'coverflow' => esc_html__('Coverflow', 'sky-elementor-addons-pro'),
                ],
            ]
        );


        $this->add_control(
            'show_title',
            [
                'label'    => esc_html__('Show Title', 'sky-elementor-addons-pro'),
                'type'     => Controls_Manager::SWITCHER,
                'default'  => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h3',
                'options'   => sky_title_tags(),
                'condition' => [
                    'show_title' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'player_content_position',
            [
                'label'                => esc_html__('Text Position', 'sky-elementor-addons-pro'),
                'type'                 => Controls_Manager::SELECT,
                'label_block'          => false,
                'options'              => [
                    'top-left'      => esc_html__('Top Left', 'sky-elementor-addons-pro'),
                    'top-center'    => esc_html__('Top Center', 'sky-elementor-addons-pro'),
                    'top-right'     => esc_html__('Top Right', 'sky-elementor-addons-pro'),
                    'bottom-left'   => esc_html__('Bottom Left', 'sky-elementor-addons-pro'),
                    'bottom-center' => esc_html__('Bottom Center', 'sky-elementor-addons-pro'),
                    'bottom-right'  => esc_html__('Bottom Right', 'sky-elementor-addons-pro'),
                ],
                'desktop_default'      => 'top-left',
                'tablet_default'       => 'top-left',
                'mobile_default'       => 'top-left',
                'style_transfer'       => true,
                'selectors'            => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-player-content-wrapper' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top-left'      => 'top: 0%; left: 0; transform: translate(0%, 0%);right: auto;',
                    'top-center'    => 'top: 0; left: 50%; transform: translate(-50%, 0%);',
                    'top-right'     => 'top: 0%; right: 0; transform: translate(0%, 0%);left: auto;',
                    'bottom-left'   => 'bottom: 0; left: 0%; transform: translate(0%, 0%);top: auto;',
                    'bottom-center' => 'bottom: 0; left: 50%; transform: translate(-50%, 0%);top: auto;',
                    'bottom-right'  => 'bottom: 0; right: 0%; transform: translate(0%, 0%);top: auto;left:auto;',
                ]
            ]
        );

        $this->add_responsive_control(
            'player_content_alignment',
            [
                'label'     => esc_html__('Text Alignment', 'sky-elementor-addons-pro'),
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
                    '{{WRAPPER}} .sa-video-gallery-player .sa-player-content-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_play_button_on_hover',
            [
                'label'        => esc_html__('Show Play Button On Hover', 'sky-elementor-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'sa-play-button-on-hover-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_playlist_settings',
            [
                'label' => esc_html__('Playlist Settings', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'playlist_loop',
            [
                'label'   => esc_html__('Loop', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'playlist_mouse_wheel',
            [
                'label'   => esc_html__('Mouse Wheel', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'playlist_free_mode',
            [
                'label'   => esc_html__('Free Mode', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'playlist_title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => sky_title_tags(),
            ]
        );

        $this->add_control(
            'playlist_show_scrollbar',
            [
                'label'   => esc_html__('Show Scrollbar', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'playlist_show_navigation',
            [
                'label'   => esc_html__('Show Navigation', 'sky-elementor-addons-pro'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'video_player_style',
            [
                'label' => esc_html__('Video Player', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'poster_overlay',
            [
                'label'     => esc_html__('Poster Overlay', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-wrapper::after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'player_content_padding',
            [
                'label'      => esc_html__('Text Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-player-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'video_title_style',
            [
                'label' => esc_html__('Video Title', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'video_title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'video_title_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'video_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-title',
            ]
        );

        $this->add_responsive_control(
            'video_title_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'video_title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'video_credit_style',
            [
                'label' => esc_html__('Video Credit/Subtitle', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'video_credit_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-credit' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'video_credit_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-credit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'video_credit_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-credit',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'video_credit_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-credit',
            ]
        );

        $this->add_responsive_control(
            'video_credit_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery .sa-player-credit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'video_credit_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery .sa-player-credit',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_play_button_style',
            [
                'label' => esc_html__('Play Button', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'play_button_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery .sa-play-button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'play_button_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-play-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'play_button_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button',
            ]
        );

        $this->add_responsive_control(
            'play_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_play_button_style');

        $this->start_controls_tab(
            'tab_play_button_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'play_button_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-play-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'play_button_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'play_button_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'play_button_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_play_button_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );


        $this->add_control(
            'play_button_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-play-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'play_button_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button:hover',
            ]
        );

        $this->add_control(
            'play_button_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-player .sa-play-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'play_button_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'play_button_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'play_button_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-player .sa-play-button:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_style',
            [
                'label' => esc_html__('Playlist', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'playlist_separator_size',
            [
                'label'      => esc_html__('Separator Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 6,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'playlist_separator_color',
            [
                'label'     => esc_html__('Separator Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'playlist_content_padding',
            [
                'label'      => esc_html__('Text Padding', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('playlist_tabs');

        $this->start_controls_tab(
            'playlist_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'playlist_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}.elementor-widget-sky-video-gallery .elementor-widget-container',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'playlist_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_tab_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'playlist_background_active',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .swiper-slide-thumb-active .sa-playlist-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_img_style',
            [
                'label' => esc_html__('Thumbnail', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'playlist_thumb_width',
            [
                'label'      => esc_html__('Width', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'playlist_thumb_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-thumbnail',
            ]
        );

        $this->add_responsive_control(
            'playlist_thumb_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_title_style',
            [
                'label' => esc_html__('Playlist Title', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'playlist_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-title',
            ]
        );


        $this->start_controls_tabs('playlist_title_tabs');

        $this->start_controls_tab(
            'playlist_title_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_title_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_title_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper:hover .sa-playlist-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_title_tab_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_title_color_active',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .swiper-slide-thumb-active .sa-playlist-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_credit_style',
            [
                'label' => esc_html__('Playlist Credit/Subtitle', 'sky-elementor-addons-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'playlist_credit_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons-pro'),
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-credit',
            ]
        );

        $this->start_controls_tabs('playlist_credit_tabs');

        $this->start_controls_tab(
            'playlist_credit_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_credit_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-credit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_credit_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_credit_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-wrapper:hover .sa-playlist-credit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'playlist_credit_tab_active',
            [
                'label' => esc_html__('Active', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_credit_color_active',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .swiper-slide-thumb-active .sa-playlist-credit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_navigation_style',
            [
                'label'     => esc_html__('Playlist Navigation', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['playlist_show_navigation' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'playlist_navigation_size',
            [
                'label'      => esc_html__('Navigation Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} ' => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('navigation_tabs');

        $this->start_controls_tab(
            'tab_navigation_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_navigation_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' => '--swiper-navigation-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'playlist_navigation_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-prev, {{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-next',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_navigation_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons-pro'),
            ]
        );

        $this->add_control(
            'playlist_navigation_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-prev:hover .sa-swiper-button-prev' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-next:hover .sa-swiper-button-next' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'playlist_navigation_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons-pro'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-prev:hover, {{WRAPPER}} .sa-video-gallery-playlist .sa-playlist-next:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'playlist_scrollbar_style',
            [
                'label'     => esc_html__('Playlist Scrollbar', 'sky-elementor-addons-pro'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['playlist_show_scrollbar' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'playlist_scrollbar_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons-pro'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .swiper-container-vertical > .sa-swiper-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'playlist_scrollbar_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .sa-swiper-scrollbar' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'playlist_scrollbar_drag_color',
            [
                'label'     => esc_html__('Drag Color', 'sky-elementor-addons-pro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-video-gallery-playlist .swiper-scrollbar-drag' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function re_arrange_video_url($video_url = [])
    {
        $video_url = Embed::get_embed_url($video_url, ['autplay' => 1], []);
        return $video_url;
    }

    protected function get_video_thum($video_type, $video_url)
    {
        $thumb_url        = '';
        $video_properties = Embed::get_video_properties($video_url);
        $video_id         = isset($video_properties['video_id']) ? $video_properties['video_id'] : false;

        if ($video_type == 'youtube') {
            $thumb_url = '//img.youtube.com/vi/' . $video_id . '/0.jpg';
        } elseif ($video_type == 'dailymotion') {
            $thumb_url = '//www.dailymotion.com/thumbnail/video/' . $video_id;
        } elseif ($video_type == 'vimeo') {
            $thumb_url = '//vumbnail.com/' . $video_id . '.jpg';
        } else {
            $thumb_url = Utils::get_placeholder_image_src();
        }

        return $thumb_url;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id       = 'sa-video-gallery-' . $this->get_id();
        $this->add_render_attribute(
            [
                'player-settings' => [
                    'class'                  => 'sa-video-gallery',
                    'id'                     => $id,
                    'data-player-settings'   => [
                        wp_json_encode(array_filter([
                            'direction' => $settings["direction"],
                            'loop'      => ($settings['loop'] == 'yes') ? true : false,
                            'speed'     => (!empty($settings['speed']['size'])) ? $settings['speed']['size'] * 1000 : 500,
                            'effect'    => $settings['transition_effect'],
                        ]))
                    ],
                    'data-playlist-settings' => [
                        wp_json_encode(array_filter([
                            'direction'             => $settings['video_gallery_layout'],
                            'slidesPerView'         => 7,
                            'loop'                  => ($settings['playlist_loop'] == 'yes') ? true : false,
                            'mousewheel'            => ($settings['playlist_mouse_wheel'] == 'yes') ? true : false,
                            'freeMode'              => ($settings['playlist_free_mode'] == 'yes') ? true : false,
                            'watchSlidesVisibility' => true,
                            'watchSlidesProgress'   => true,
                            'navigation'            => [
                                'nextEl' => $settings['playlist_show_navigation'] == 'yes' ? "#$id .sa-swiper-button-next" : false,
                                'prevEl' => $settings['playlist_show_navigation'] == 'yes' ? "#$id .sa-swiper-button-prev" : false
                            ],
                            'scrollbar'             => [
                                'el'        => $settings['playlist_show_scrollbar'] == 'yes' ? "#$id .sa-swiper-scrollbar" : false,
                                'draggable' => $settings['playlist_show_scrollbar'] == 'yes' ? true : false
                            ],
                            'breakpoints'           => [
                                '320' => [
                                    'direction'     => "horizontal",
                                    'slidesPerView' => 2
                                ],
                                '500' => [
                                    'direction'     => "horizontal",
                                    'slidesPerView' => 3
                                ],
                                '768' => [
                                    'direction'     => $settings['video_gallery_layout'],
                                    'slidesPerView' => $settings['video_gallery_layout'] == 'horizontal' ? 5 : 7,
                                ]
                            ]
                        ]))
                    ]
                ]
            ]
        );
?>
        <div <?php echo $this->get_render_attribute_string('player-settings'); ?>>

            <div class="sa-video-gallery-player">

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($settings['video_list'] as $index => $item) :

                            $poster = $item['poster']['url'];

                            if ($item['video_type'] == 'youtube') {
                                $video_url = $this->re_arrange_video_url($item['youtube_url']);
                                $poster    = (empty($poster)) ? $this->get_video_thum('youtube', $item['youtube_url']) : $poster;
                            } elseif ($item['video_type'] == 'vimeo') {
                                $video_url = $this->re_arrange_video_url($item['vimeo_url']);
                                $poster    = (empty($poster)) ? $this->get_video_thum('vimeo', $item['vimeo_url']) : $poster;
                            } elseif ($item['video_type'] == 'dailymotion') {
                                $video_url = $this->re_arrange_video_url($item['dailymotion_url']);
                                $poster    = (empty($poster)) ? $this->get_video_thum('dailymotion', $item['dailymotion_url']) : $poster;
                            } elseif ($item['video_type'] == 'hosted') {
                                if ($item['external_url_set'] == 'yes') {
                                    $video_url = $item['external_url']['url'];
                                } else {
                                    $video_url = $item['hosted_url']['url'];
                                }
                                $poster = (empty($poster)) ? $this->get_video_thum('hosted', '') : $poster;
                            } else {
                                $video_url = '';
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="sa-player-wrapper">

                                    <img class="sa-player-poster" src="<?php echo esc_url($poster); ?>" alt="<?php echo esc_attr((isset($item['poster']['alt']) && !empty($item['poster']['alt'])) ? $item['poster']['alt'] : $item['title']); ?>" />
                                    <div class="sa-play-button-wrapper">
                                        <a class="sa-play-button sa-icon-wrap sa-text-decoration-none" href="javascript:void(0);" data-src="<?php echo esc_url($video_url); ?>">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>

                                    <div class="sa-player-content-wrapper">
                                        <?php
                                        if ($settings['show_title'] == 'yes') :
                                            $title_tag     = Utils::validate_html_tag($settings['title_tag']);
                                            $title_content = esc_html($item['title']);
                                            printf('<%s class="sa-player-title sa-m-0">%s</%s>', $title_tag, $title_content, $title_tag);
                                        endif;

                                        if (!empty($item['credit_url']['url'])) {
                                            $target     = $item['credit_url']['is_external'] ? ' target="_blank"' : 'target="_self"';
                                            $nofollow   = $item['credit_url']['nofollow'] ? ' rel="nofollow"' : '';
                                            $credit_url = !empty($item['credit_url']['url']) ? $item['credit_url']['url'] : 'javascript:void(0);';
                                        } else {
                                            $target     = 'target="_self"';
                                            $nofollow   = '';
                                            $credit_url = 'javascript:void(0);';
                                        }
                                        ?>
                                        <a class="sa-player-credit sa-d-inline-block sa-text-decoration-none" <?php echo 'href="' . esc_url($credit_url) . '"' . $target . $nofollow; ?>>
                                            <?php echo esc_html($item['credit']); ?>
                                        </a>
                                    </div>

                                    <div class="sa-video-player">
                                        <iframe src="about:blank" class="sa-player-iframe" allow="autoplay;" frameborder="no" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true"></iframe>
                                    </div>

                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <div class="sa-video-gallery-playlist">
                <div thumbsSlider="" class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($settings['video_list'] as $index => $item) :
                            $poster = $item['poster']['url'];

                            if ($item['video_type'] == 'youtube') {
                                $poster = (empty($poster)) ? $this->get_video_thum('youtube', $item['youtube_url']) : $poster;
                            } elseif ($item['video_type'] == 'vimeo') {
                                $poster = (empty($poster)) ? $this->get_video_thum('vimeo', $item['vimeo_url']) : $poster;
                            } elseif ($item['video_type'] == 'dailymotion') {
                                $poster = (empty($poster)) ? $this->get_video_thum('dailymotion', $item['dailymotion_url']) : $poster;
                            } elseif ($item['video_type'] == 'hosted') {
                                $poster = (empty($poster)) ? $this->get_video_thum('hosted', '') : $poster;
                            } else {
                            }
                        ?>
                            <div class="swiper-slide">
                                <a class="sa-playlist-wrapper sa-text-decoration-none" href="javascript:void(0);">
                                    <div class="sa-playlist-thumbnail">
                                        <img src="<?php echo esc_url($poster); ?>" alt="<?php echo esc_attr((isset($item['poster']['alt']) && !empty($item['poster']['alt'])) ? $item['poster']['alt'] : $item['title']); ?>" />
                                    </div>
                                    <div class="sa-playlist-content span-col-3">
                                        <?php
                                        $title_tag     = Utils::validate_html_tag($settings['playlist_title_tag']);
                                        $title_content = esc_html($item['title']);
                                        printf('<%s class="sa-playlist-title sa-truncate">%s</%s>', $title_tag, $title_content, $title_tag);
                                        ?>
                                        <div class="sa-playlist-credit sa-truncate">
                                            <?php echo esc_html($item['credit']); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($settings['playlist_show_scrollbar'] == 'yes') : ?>
                        <div class="sa-swiper-scrollbar"></div>
                    <?php endif; ?>

                    <?php if ($settings['playlist_show_navigation'] == 'yes') : ?>
                        <div class="sa-playlist-prev">
                            <div class="sa-swiper-button-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
                                    <path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z">
                                </svg>
                            </div>
                        </div>
                        <div class="sa-playlist-next">
                            <div class="sa-swiper-button-next">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
                                    <path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z">
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>


        </div>


<?php
    }
}
