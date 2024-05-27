<?php

namespace Sky_Addons_Pro\Modules\Breadcrumbs;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_name()
    {
        return 'breadcrumbs';
    }

    public function get_widgets()
    {
        return [
            'Breadcrumbs',
        ];
    }

    public static function _sky_breadcrumbs(
        $align,
        $home_icon,
        $show_on_home,
        $hide_current,
        $display_text
    ) {

        $home_icon   = (!empty($home_icon)) ? $home_icon : '';
        /**
         * 1 - show breadcrumbs on the homepage, 0 - don't show
         */
        $showOnHome  = (empty($show_on_home)) ? 1 : 0;
        /**
         * delimiter between crumbs
         */
        $delimiter   = '/';
        /**
         * text for the 'Home' link
         */
        $home        = empty($display_text['homepage']) ? get_bloginfo('name') : $display_text['homepage'];
        $blog        = empty($display_text['blog']) ? get_theme_mod('sky_blog_title', 'Blog') : $display_text['blog'];
        $shop        = empty($display_text['shop']) ? get_theme_mod('sky_woocommerce_title', 'Shop') : $display_text['shop'];
        $forums      = get_theme_mod('sky_bbpress_title', 'Forum');
        /**
         * 1 - show current post/page title in breadcrumbs, 0 - don't show
         */
        $showCurrent = (empty($hide_current)) ? 1 : 0;
        /**
         * tag before the current crumb
         */
        $before      = '<li><span> ';
        /**
         * tag after the current crumb
         */
        $after       = '</span></li>';
        $output      = array();
        $class       = [
            'sa-breadcrumbs', 'sa-d-flex', 'sa-flex-wrap', 'sa-list-style-none',
            'sa-m-0', 'sa-p-0', 'sa-align-items-center'
        ];
        $class[]     = ($align == 'left') ? 'sa-default' : null;
        $class[]     = ($align == 'center') ? 'sa-align-center' : null;
        $class[]     = ($align == 'right') ? 'sa-align-right' : null;
        $class       = implode(' ', $class);
        $homeLink    = home_url('/');

        global $post;
        global $woocommerce;

        if ($woocommerce) {
            $shopLink = get_permalink(wc_get_page_id('shop'));
        }

        $forumLink = get_post_type_archive_link('forum');

        if (is_home() || is_front_page()) {
            if ($showOnHome == 1) {
                $output[] = '<ul class="' . $class . '">
	            <li><a class="sa-home sa-d-flex" href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li><li><span> ' . esc_html($blog) . ' </span></li></ul>';
            }
        } else {
            $output[] = '<ul class="' . $class . '"><li><a class="sa-home sa-d-flex" href="' . esc_url($homeLink) . '">' . $home_icon . esc_html($home) . '</a></li>';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) {
                    $output[] = get_category_parents($thisCat->parent, TRUE, ' ') . '';
                }
                $output[] = $before . empty($display_text['category']) ? esc_html__('Category', 'sky-elementor-addons-pro') : $display_text['category'] . ': ' . esc_html(single_cat_title('', false)) . '' . $after;
            } elseif (is_search()) {
                $output[] = $before . empty($display_text['search']) ? esc_html__('Search', 'sky-elementor-addons-pro') : $display_text['search'] . $after;
            } elseif (is_day()) {
                $output[] = '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li>';
                $output[] = '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a></li>';
                $output[] = $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                $output[] = '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li>';
                $output[] = $before . esc_html(get_the_time('F')) . $after;
            } elseif (is_year()) {
                $output[] = $before . esc_html(get_the_time('Y')) . $after;
            } elseif (class_exists('Woocommerce') && is_shop()) {
                $output[] = '<li><a href="' . esc_url($shopLink) . '">' . esc_html($shop) . '</a></li>';
            } elseif (class_exists('Woocommerce') && is_product()) {
                $output[] = '<li><a href="' . esc_url($shopLink) . '">' . esc_html($shop) . '</a></li> ' . $before . esc_html(get_the_title()) . $after;
            } elseif (class_exists('bbPress') && is_bbpress()) {
                $output[] = '<li><a href="' . esc_url($forumLink) . '">' . esc_html($forums) . '</a></li> ' . $before . esc_html(get_the_title()) . $after . '</a></li>';
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    if ($showCurrent == 1) {
                        $output[] = ' ' . $before . get_the_title() . $after;
                    }
                } else {

                    $cat      = get_the_category();
                    $cat      = $cat[0];
                    $cats     = get_category_parents($cat, TRUE, ' ');
                    if ($showCurrent == 0)
                        $cats     = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    $output[] = '<li>' . $cats . '</li>'; // No need to escape here
                    if ($showCurrent == 1)
                        $output[] = $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                $output[]  = $before . wp_kses_post($post_type->labels->singular_name) . $after;
            } elseif (is_attachment()) {
                if ($showCurrent == 1)
                    $output[] = $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1)
                    //start beta
                    $title = get_the_title();
                $title = empty($display_text['strip_words']) ? $title : str_replace($display_text['strip_words'], "", $title);
                $output[] = $before . $title . $after;
                //end beta
            } elseif (is_page() && $post->post_parent) {
                $parent_id   = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page          = get_post($parent_id);
                    $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></li>';
                    $parent_id     = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    /**
                     * No need to escape here
                     */
                    $output[] = $breadcrumbs[$i];
                }
                if ($showCurrent == 1)
                    //start beta
                    $title = get_the_title();
                $title = empty($display_text['strip_words']) ? $title : str_replace($display_text['strip_words'], "", $title);
                $output[] = $before . $title . $after;
                //end beta
            } elseif (is_tag()) {
                $output[] = $before . empty($display_text['tag']) ? esc_html__('Tag', 'sky-elementor-addons-pro') : $display_text['tag'] . ': ' . esc_html(single_tag_title('', false)) . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                $output[] = $before . empty($display_text['author']) ? esc_html__('Articles by', 'sky-elementor-addons-pro') : $display_text['author'] . ' ' . esc_html($userdata->display_name) . $after;
            } elseif (is_404()) {
                $output[] = $before . empty($display_text['error_404']) ? esc_html__('Error 404', 'sky-elementor-addons-pro') : $display_text['error_404'] . $after;
            }
            if (get_query_var('paged')) {
                $output[] = $before . '(' . empty($display_text['page']) ? esc_html__('Page', 'sky-elementor-addons-pro') : $display_text['page'] . ' ' . esc_html(get_query_var('paged')) . ')' . $after;
            }
            $output[] = '</ul>';
        }

        $output = implode("\n", $output);

        return $output;
    }
}
