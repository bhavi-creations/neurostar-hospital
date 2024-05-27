<?php

namespace Sky_Addons_Pro\Modules\PricingTable;

use Sky_Addons_Pro\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'pricing-table';
    }

    public function get_widgets() {
        return [
                'Pricing_Table',
        ];
    }

}
