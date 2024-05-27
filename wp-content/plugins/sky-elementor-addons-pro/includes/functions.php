<?php
defined('ABSPATH') || exit;

use Sky_Addons_Pro\Sky_Addons_Pro_Plugin;

/**
 * Core Directory and URL path
 */
if (!function_exists('sky_addons_pro_core')) {

    function sky_addons_pro_core() {
        $obj                = new \stdClass();
        $obj->templates_dir = \Sky_Addons_Pro\Sky_Addons_Pro_Plugin::sky_addons_pro_dir() . 'includes/views/';
        $obj->includes_dir  = \Sky_Addons_Pro\Sky_Addons_Pro_Plugin::sky_addons_pro_dir() . 'includes/';
        $obj->classes_dir   = \Sky_Addons_Pro\Sky_Addons_Pro_Plugin::sky_addons_pro_dir() . 'classes/';
        $obj->base_dir      = \Sky_Addons_Pro\Sky_Addons_Pro_Plugin::sky_addons_pro_dir() . 'base/';            // only pro
        $obj->images        = \Sky_Addons_Pro\Sky_Addons_Pro_Plugin::sky_addons_pro_url() . 'assets/images/';
        return $obj;
    }
}

/**
 * Sky Addons Icon
 */
if (!function_exists('sky_addons_pro_get_icon')) {
    function sky_addons_pro_get_icon() {
        return '<img src="' . sky_addons_pro_core()->images . 'sky-logo-color.svg" class="sky-ctrl-section-icon" alt="Sky Addons" title="Sky Addons">';
    }
}

/**
 * Title Tags
 * 
 * @return array
 */

if (!function_exists('sky_title_tags')) {
    function sky_title_tags() {

        $title_tags = [
            'h1'   => 'H1',
            'h2'   => 'H2',
            'h3'   => 'H3',
            'h4'   => 'H4',
            'h5'   => 'H5',
            'h6'   => 'H6',
            'div'  => 'div',
            'span' => 'span',
            'p'    => 'p',
        ];

        return $title_tags;
    }
}

/**
 * Check you are in Editor
 * 
 */

if (!function_exists('sky_editor_mode')) {
    function sky_editor_mode() {
        if (Sky_Addons_Pro_Plugin::elementor()->preview->is_preview_mode() || Sky_Addons_Pro_Plugin::elementor()->editor->is_edit_mode()) {
            return true;
        }
        return false;
    }
}



/**
 * Disable unserializing of the class
 *
 * @since 1.0.0
 * @return void
 */
if (!function_exists('sky_template_modify_link')) {
    function sky_template_modify_link($template_id) {
        if (Sky_Addons_Pro_Plugin::elementor()->editor->is_edit_mode()) {

            $final_url = add_query_arg(['elementor' => ''], get_permalink($template_id));

            $output = sprintf('<a class="sa-elementor-template-modify-link" href="%s" title="%s" target="_blank"><i class="eicon-edit"></i></a>', esc_url($final_url), esc_html__('Edit Template', 'sky-elementor-addons-pro'));

            return $output;
        }
    }
}

/**
 * @return array of elementor template
 */
if (!function_exists('sky_elementor_template_settings')) {
    function sky_elementor_template_settings() {

        $templates = Sky_Addons_Pro_Plugin::elementor()->templates_manager->get_source('local')->get_items();
        $types     = [];

        if (empty($templates)) {
            $template_settings = ['0' => esc_html__('Template Not Found!', 'sky-elementor-addons-pro')];
        } else {
            $template_settings = ['0' => esc_html__('Select Template', 'sky-elementor-addons-pro')];

            foreach ($templates as $template) {
                $template_settings[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']]             = $template['type'];
            }
        }

        return $template_settings;
    }
}

/**
 * @return array of anywhere templates
 */
if (!function_exists('sky_anywhere_template_settings')) {
    function sky_anywhere_template_settings() {

        if (post_type_exists('ae_global_templates')) {
            $anywhere = get_posts(array(
                'fields'         => 'ids', // Only get post IDs
                'posts_per_page' => -1,
                'post_type'      => 'ae_global_templates',
            ));

            $anywhere_settings = ['0' => esc_html__('Select Template', 'sky-elementor-addons-pro')];

            foreach ($anywhere as $key => $value) {
                $anywhere_settings[$value] = get_the_title($value);
            }
        } else {
            $anywhere_settings = ['0' => esc_html__('AE Plugin Not Installed', 'sky-elementor-addons-pro')];
        }

        return $anywhere_settings;
    }
}

/**
 * Notice will be show if the swiper elements not found
 * Used remote swiper widgets
 */

if (!function_exists('remote_swiper_widget_notice')) {
    function remote_swiper_widget_notice($id = '') {
?>
        <div class="sa-notice sa-p-2 sa-mb-3 sa-border sa-rounded sa-d-inline-block sa-d-none" id="<?php echo esc_html($id); ?>">
            <?php
            esc_html_e('Sorry, the Slider / Carousel element cannot be found automatically or by your ID. It may not be compatible with Swiper.', 'sky-elementor-addons-pro');
            ?>
        </div>
<?php
    }
}
