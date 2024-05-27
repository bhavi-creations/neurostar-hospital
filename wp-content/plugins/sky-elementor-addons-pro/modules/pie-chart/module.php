<?php

namespace Sky_Addons_Pro\Modules\PieChart;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'pie-chart';
    }

    public function get_widgets() {
        return [
            'Pie_Chart',
        ];
    }
}
