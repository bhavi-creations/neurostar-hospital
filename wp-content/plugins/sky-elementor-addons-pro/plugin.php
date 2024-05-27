<?php

namespace Sky_Addons_Pro;

use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Main class plugin -> Sky_Addons_Pro
 */
class Sky_Addons_Pro_Plugin
{

    /**
     * @var Plugin -> Sky_Addons_Pro
     */
    private static $_instance;

    /**
     * @var Manager
     */
    private $_modules_manager;

    /**
     * Localize
     * @var array
     */
    private $_localize_settings = [];

    /**
     * Get the version
     * @return string
     */
    public function get_version()
    {
        return SKY_ADDONS_PRO_VERSION;
    }

    /**
     * Throw error on object clone
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object therefore, we don't want the object to be cloned.
     *
     * @since 1.0.0
     * @return void
     */
    public function __clone()
    {
        // Cloning instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'sky-elementor-addons-pro'), '1.0.0');
    }

    /**
     * Disable unserializing of the class
     *
     * @since 1.0.0
     * @return void
     */
    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'sky-elementor-addons-pro'), '1.0.0');
    }

    /**
     * @return Plugin
     */
    public static function elementor()
    {
        return Plugin::$instance;
    }

    /**
     * @return Plugin -> Sky_Addons_Pro
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function _includes()
    {
        require_once __DIR__ . '/includes/functions.php';

        require SKY_ADDONS_PRO_PATH . 'includes/modules-manager.php';
        require SKY_ADDONS_PRO_PATH . 'includes/utils.php';

        if (function_exists('sky_addons_core')) {
            require_once sky_addons_core()->traits_dir . 'global-swiper-controls.php';
        }

        require_once SKY_ADDONS_PRO_PATH . '/traits/global-chart.php';
        require_once SKY_ADDONS_PRO_PATH . '/traits/global-plyr.php';
    }

    public function autoload($class)
    {
        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $filename = strtolower(
            preg_replace(
                ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'],
                [
                    '', '$1-$2', '-', DIRECTORY_SEPARATOR
                ],
                $class
            )
        );
        $filename = SKY_ADDONS_PRO_PATH . $filename . '.php';

        if (is_readable($filename)) {
            include($filename);
        }
    }

    public function get_localize_settings()
    {
        return $this->_localize_settings;
    }

    public function add_localize_settings($setting_key, $setting_value = null)
    {
        if (is_array($setting_key)) {
            $this->_localize_settings = array_replace_recursive($this->_localize_settings, $setting_key);

            return;
        }

        if (!is_array($setting_value) || !isset($this->_localize_settings[$setting_key]) || !is_array($this->_localize_settings[$setting_key])) {
            $this->_localize_settings[$setting_key] = $setting_value;

            return;
        }

        $this->_localize_settings[$setting_key] = array_replace_recursive($this->_localize_settings[$setting_key], $setting_value);
    }

    public function enqueue_styles()
    {
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_enqueue_style(
            'sky-elementor-addons-pro',
            SKY_ADDONS_PRO_URL . 'assets/css/sky-addons-pro' . $direction_suffix . '.css',
            [],
            Sky_Addons_Pro_Plugin::instance()->get_version()
        );
    }

    public function enqueue_styles_backend()
    {
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_enqueue_style(
            'sky-elementor-addons-pro-icons',
            SKY_ADDONS_PRO_URL . 'assets/css/sky-editor-pro' . $direction_suffix . '.css',
            [],
            Sky_Addons_Pro_Plugin::instance()->get_version()
        );
    }

    public function enqueue_scripts()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_script(
            'sky-elementor-addons-pro-js',
            SKY_ADDONS_PRO_URL . 'assets/js/sky-addons-pro' . $suffix . '.js',
            [
                'jquery', 'elementor-frontend'
            ],
            Sky_Addons_Pro_Plugin::instance()->get_version(),
            true
        );


        if (Sky_Addons_Pro_Plugin::elementor()->preview->is_preview_mode() || Sky_Addons_Pro_Plugin::elementor()->editor->is_edit_mode()) {
            // todo check if activate modules
            wp_enqueue_script('tippyjs');
            wp_enqueue_script('particles');
            wp_enqueue_script('sa-confetti-effects');
        }

        wp_localize_script(
            'sky-elementor-addons-pro-js',
            'Sky_Addons_ProFrontendConfig',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('sky-elementor-addons-pro-js'),
            ]
        );
    }

    public function register_site_scripts()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        wp_register_script('popper', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/popper' . $suffix . '.js', [], '2.10.1', true);
        wp_register_script('tippyjs', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/tippy-bundle.umd' . $suffix . '.js', [], '6.3.1', true);

        wp_register_script('countUp', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/countUp' . $suffix . '.js', [], '2.0.4', true);
        wp_register_script('particles', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/particles' . $suffix . '.js', [], '2.0.0', true);
        wp_register_script('darkmode', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/darkmode' . $suffix . '.js', [], 'v1.5.7', true);
        wp_register_script('sa-confetti-effects', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/confetti.browser' . $suffix . '.js', [], 'v1.6.0', true);
        wp_register_script('chart', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/chart' . $suffix . '.js', [], 'v3.9.1', true);
        wp_register_script('plyr', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/js/plyr' . $suffix . '.js', [], '3.7.2', true);
    }

    public function register_site_styles()
    {
        $direction_suffix = is_rtl() ? '.rtl' : '';
        wp_register_style('tippy', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/css/tippy-animation' . $direction_suffix . '.css', [], '6.3.1');
        wp_register_style('plyr', SKY_ADDONS_PRO_ASSETS_URL . 'vendor/css/plyr' . $direction_suffix . '.css', [], '6.3.1');
    }

    public function enqueue_editor_scripts()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_style('sky-widget-icons-pro', SKY_ADDONS_PRO_ASSETS_URL . 'css/sky-widget-icons-pro.css', [], '1.0.0');
    }

    public function load_admin_scripts()
    {
        wp_enqueue_script('sky-admin-js-pro', SKY_ADDONS_PRO_ASSETS_URL . 'admin/sky-admin-pro.js', ['jquery'], '1.0.0', true);
        wp_enqueue_style('sky-admin-css-pro', SKY_ADDONS_PRO_ASSETS_URL . 'admin/sky-admin-pro.css', [], '1.0.0');
        wp_enqueue_style('sky-widget-icons-pro', SKY_ADDONS_PRO_ASSETS_URL . 'css/sky-widget-icons-pro.css', [], '1.0.0');
    }

    public function elementor_init()
    {
        $this->_modules_manager = new Managers();

        \Elementor\Plugin::instance()->elements_manager->add_category(
            'sky-elementor-addons-pro',
            [
                'title' => esc_html__('Sky Addons Pro', 'sky-elementor-addons-pro'),
                'icon'  => 'font',
            ],
            1
        );
    }

    public static function sky_addons_pro_file()
    {
        return SKY_ADDONS_PRO__FILE__;
    }

    public static function sky_addons_pro_url()
    {
        return trailingslashit(plugin_dir_url(self::sky_addons_pro_file()));
    }

    public static function sky_addons_pro_dir()
    {
        return trailingslashit(plugin_dir_path(self::sky_addons_pro_file()));
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {
        require_once __DIR__ . '/includes/functions.php';
        require_once sky_addons_pro_core()->base_dir . '/base.php';
        require_once sky_addons_pro_core()->includes_dir . 'license-manager.php';

        if (is_admin()) {
            require_once sky_addons_pro_core()->includes_dir . 'admin.php';
        } else {
            //TODO for frontEnd
        }
    }

    protected function add_actions()
    {
        add_action('elementor/init', [$this, 'elementor_init']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'], 998);


        add_action('elementor/frontend/before_enqueue_scripts', [$this, 'enqueue_scripts'], 998);

        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_styles_backend'], 991);


        add_action('elementor/frontend/before_register_styles', [$this, 'register_site_styles']);
        add_action('elementor/frontend/before_register_scripts', [$this, 'register_site_scripts']);

        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
        add_action('admin_enqueue_scripts', [$this, 'load_admin_scripts']);

        $this->init_plugin();
    }

    /**
     * Plugin-> Sky_Addons_Pro constructor.
     */
    private function __construct()
    {
        spl_autoload_register([$this, 'autoload']);

        $this->_includes();
        $this->add_actions();
    }
}

/**
 * Initializes the main plugin
 * 
 */
function sky_elementor_addons_pro()
{
    if (!defined('SKY_ADDONS_PRO_TEST')) {
        Sky_Addons_Pro_Plugin::instance();
    }
}

// kick-off the plugin
sky_elementor_addons_pro();
