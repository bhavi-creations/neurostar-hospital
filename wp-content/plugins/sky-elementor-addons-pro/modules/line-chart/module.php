<?php

namespace Sky_Addons_Pro\Modules\LineChart;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'line-chart';
    }

    public function get_widgets() {
        return [
            'Line_Chart',
        ];
    }
}
