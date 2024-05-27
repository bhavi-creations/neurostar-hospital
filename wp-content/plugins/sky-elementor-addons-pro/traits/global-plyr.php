<?php

namespace Sky_Addons_Pro\Traits;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

trait Global_Plyr {

    /**
     * Markup for Online Video Platform
     *
     * @param string $provider
     * @param string $embed_id
     * @return void
     */

    protected function video_markup_online_platform($id, $provider = 'youtube', $embed_id = 'bTqVqk7FSmY') {
        printf(
            '<div id="%1$s" crossorigin data-plyr-provider="%2$s" data-plyr-embed-id="%3$s"></div>',
            $id,
            $provider,
            $embed_id
        );
?>

    <?php
    }

    /**
     * Markup for HTML5 Video
     *
     * @param string $poster_url
     * @param string $video_url
     * @return void
     */

    protected function video_markup_html5($id, $poster_url = '', $video_url = '') {
        //http://localhost:8012/sky-alpha/wp-content/uploads/2022/10/pexels-samad-ismayilov-735552.jpg
        //https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4
    ?>
        <video id="<?php echo esc_attr($id); ?>" playsinline controls data-poster="<?php echo esc_attr($poster_url); ?>">
            <source src="<?php echo esc_attr($video_url); ?>" type="video/mp4" />
        </video>
<?php
    }
}
