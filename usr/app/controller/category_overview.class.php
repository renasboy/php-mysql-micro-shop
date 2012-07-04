<?php
namespace app\controller;

class category_overview extends \app\simple_controller {

    protected $_default_input   = [
        'page'                  => 1,
        'filter'                => []
    ];

    protected function _validate_input () {
        $this->_validator->validate('is_page',          $this->_input['page']);

        if ($this->_input['filter']) {
            $this->_validator->validate('is_filter',    $this->_input['filter'], ['category']);
        }

        if ($this->_validator->error()) {
            $this->_error->bad_request('category overview validation failed:' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $this->_view->set('page',   $this->_input['page']);
        $this->_view->set('filter', $this->_filter('category'));
    }
}
