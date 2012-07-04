<?php
namespace app\controller;

class product_overview extends \app\simple_controller {

    protected $_default_input   = [
        'category'              => null,
        'page'                  => 1,
        'filter'                => []
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_page',          $this->_input['page']);

        $this->_validator->validate('is_entity', 'category', 'seo', $this->_input['category']);

        if ($this->_input['filter']) {
            $this->_validator->validate('is_filter',    $this->_input['filter'], ['product']);
        }

        if ($this->_validator->error()) {
            $this->_error->bad_request('product overview validation failed:' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $this->_view->set('page',   $this->_input['page']);
        $this->_view->set('category',   $this->_input['category']);
        $this->_view->set('filter', $this->_filter('product'));
    }
}
