<?php

namespace Sky_Addons_Pro\Modules\VideoGallery;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'video-gallery';
    }

    public function get_widgets() {
        return [
                'Video_Gallery',
        ];
    }

}
