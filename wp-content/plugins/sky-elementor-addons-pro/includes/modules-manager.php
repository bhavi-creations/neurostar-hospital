<?php

namespace Sky_Addons_Pro;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/**
 * Managers class
 */
final class Managers {

    private $_modules = null;


    const WIDGETS_DB_KEY = 'sky_addons_inactive_widgets';
    const EXTENSIONS_DB_KEY = 'sky_addons_inactive_extensions';

    /**
     * Get Inactive Widgets
     *
     * @return array
     */
    public static function get_inactive_widgets() {
        return get_option(self::WIDGETS_DB_KEY, []);
    }

    /**
     * Get Inactive Extensions
     *
     * @return array
     */
    public static function get_inactive_extensions() {
        return get_option(self::EXTENSIONS_DB_KEY, []);
    }

    /**
     * Module default Activation check
     *
     * @param [type] $module_id
     * @return boolean
     */
    private function is_module_active($module_id) {
        $module_data = $this->get_module_data($module_id);
        $inactive_widgets  = self::get_inactive_widgets();

        if (!$inactive_widgets) {
            return $module_data['default_activation'];
        } else {
            if (!in_array($module_id, $inactive_widgets)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Load Style
     *
     * @param [type] $module_id
     * @return boolean
     */
    private function has_module_style($module_id) {

        $module_data = $this->get_module_data($module_id);

        if (isset($module_data['has_style'])) {
            return $module_data['has_style'];
        } else {
            return false;
        }
    }

    /**
     * Get Module Data
     *
     * @param [type] $module_id
     * @return string
     */
    private function get_module_data($module_id) {
        return isset($this->_modules[$module_id]) ? $this->_modules[$module_id] : false;
    }

    public function __construct() {
        $modules = [];
        $modules[] = 'advanced-counter';
        $modules[] = 'breadcrumbs';
        $modules[] = 'dark-mode';
        $modules[] = 'flow-slider';
        $modules[] = 'hover-video';
        $modules[] = 'pace-slider';
        $modules[] = 'pricing-table';
        $modules[] = 'remote-arrows';
        $modules[] = 'remote-pagination';
        $modules[] = 'remote-thumbs';

        $modules[] = 'bar-chart';
        $modules[] = 'line-chart';
        $modules[] = 'polar-chart';
        $modules[] = 'radar-chart';
        $modules[] = 'pie-chart';

        if (function_exists('sky_addons_core')) {
            $modules[] = 'review-carousel';
            $modules[] = 'testimonial-carousel';
        }

        $modules[] = 'video-gallery';

        /**
         * Extensions list
         */

        if (!in_array('advanced-tooltip', self::get_inactive_extensions())) {
            $modules[] = 'advanced-tooltip';
        }

        if (!in_array('confetti-effects', self::get_inactive_extensions())) {
            $modules[] = 'confetti-effects';
        }

        if (!in_array('particles', self::get_inactive_extensions())) {
            $modules[] = 'particles';
        }

        /**
         * Fetch all modules data
         */
        foreach ($modules as $module) {
            $this->_modules[$module] = require SKY_ADDONS_PRO_MODULES_PATH . $module . '/module.info.php';
        }

        $direction_suffix = is_rtl() ? '-rtl' : '';

        foreach ($this->_modules as $module_id => $module_data) {

            if (!$this->is_module_active($module_id)) {
                continue;
            }

            $class_name = str_replace('-', ' ', $module_id);
            $class_name = str_replace(' ', '', ucwords($class_name));
            $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

            if ($this->has_module_style($module_id)) {
                wp_register_style('sa-' . $module_id, SKY_ADDONS_PRO_URL . 'assets/css/sa-' . $module_id . $direction_suffix . '.css', [], SKY_ADDONS_PRO_VERSION);
            }

            $class_name::instance();
        }
    }
}
