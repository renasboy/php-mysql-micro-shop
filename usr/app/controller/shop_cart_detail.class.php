<?php
namespace app\controller;

class shop_cart_detail extends \app\simple_controller {

    protected $_default_input   = [];

    protected function _validate_input () {}

    protected function _execute () {
        $cart = $this->_session->get('shop', 'cart');

        if ($cart === null) {
            $cart = [];
        }

        $this->_view->set('cart', $cart);
    }
}
