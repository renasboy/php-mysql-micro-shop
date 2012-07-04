<?php
namespace app\controller;

class cms_form extends \app\simple_controller {

    protected $_default_input   = [
        'payment'               => null,
        'name'                  => null,
        'address'               => null
    ];

    protected function _validate_input () {
        // TODO add authentication
    }

    protected function _execute () {
    }
}
