<?php
namespace app\controller;

class product_detail extends \app\simple_controller {

    protected $_default_input   = [
        'category'              => null,
        'sku'                   => null,
    ];

    protected function _validate_input () {

        $this->_validator->validate('is_entity', 'category', 'seo', $this->_input['category']);
        $this->_validator->validate('is_entity', 'product' , 'sku', $this->_input['sku']);

        if ($this->_validator->error()) {
            $this->_error->not_found('product not found: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        $this->_view->set('category',   $this->_input['category']);
        $this->_view->set('sku',        $this->_input['sku']);
    }
}
