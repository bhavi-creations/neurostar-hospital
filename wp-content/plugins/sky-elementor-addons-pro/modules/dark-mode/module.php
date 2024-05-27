<?php

namespace Sky_Addons_Pro\Modules\DarkMode;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

        // This is here for extensibility purposes - go to town and make things happen!
    }

    public function get_name() {
        return 'dark-mode';
    }

    public function get_widgets() {
        return [
                'Dark_Mode',
        ];
    }

}
