<?php
namespace app\controller;

class shop_cart extends \app\simple_controller {

    protected $_default_input   = [
        'action'                => null,
        'sku'                   => null
    ];

    protected function _validate_input () {
        // validate available cart action 
        $this->_validator->validate('is_in_list', $this->_input['action'], ['add', 'del']);

        // validate existing sku
        $this->_validator->validate('is_entity', 'product', 'sku', $this->_input['sku']);

        if ($this->_validator->error()) {
            $this->_error->bad_request('bad request for cart: ' . $this->_validator->error());
        }
    }

    protected function _execute () {
        
        $cart = $this->_session->get('shop', 'cart');

        if ($cart === null) {
            $cart = [];
        }

        switch ($this->_input['action']) {

            case 'add':
                if (!array_key_exists($this->_input['sku'], $cart)) {
                    $cart[$this->_input['sku']] = 0;
                }
                $cart[$this->_input['sku']]++;
            break;

            case 'del':
                if (array_key_exists($this->_input['sku'], $cart)) {
                    $cart[$this->_input['sku']]--;

                    if ($cart[$this->_input['sku']] == 0) {
                        unset($cart[$this->_input['sku']]);
                    }
                }
            break;
        }

        $this->_session->set('shop', 'cart', $cart);

        $this->_request->redirect('/cart');
    }
}
