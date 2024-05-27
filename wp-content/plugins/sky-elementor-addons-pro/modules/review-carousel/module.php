<?php

namespace Sky_Addons_Pro\Modules\ReviewCarousel;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'review-carousel';
    }

    public function get_widgets() {
        return [
                'Review_Carousel',
        ];
    }

}
