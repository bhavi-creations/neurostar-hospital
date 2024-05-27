<?php

namespace Sky_Addons_Pro\Modules\PolarChart;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'polar-chart';
    }

    public function get_widgets() {
        return [
            'Polar_Chart',
        ];
    }
}
