<?php
namespace app\controller;

class shop_form extends \app\simple_controller {

    protected $_default_input   = [
        'payment'               => null,
        'name'                  => null,
        'email'                 => null,
        'address'               => null
    ];

    protected function _validate_input () {

        // get cart data from session
        $cart = $this->_session->get('shop', 'cart');
        if (!$cart) {
            $this->_request->redirect('referer');
        }

        if ($this->_request->method() == 'post') {

            foreach ($cart as $sku => $quantity) {
                $this->_validator->validate('is_entity',    'product', 'sku', $sku);
            }

            $this->_validator->validate('is_in_list',       $this->_input['payment'], ['credit card', 'debit card', 'automatic debit', 'transference']);
            $this->_validator->validate('is_text',          $this->_input['name']);
            $this->_validator->validate('is_email',         $this->_input['email']);
            $this->_validator->validate('is_text',          $this->_input['address']);

            if ($this->_validator->error()) {
                $this->_error->bad_request('shop form validation failed:' . $this->_validator->error());
            }
        }
    }

    protected function _execute () {

        // get cart data from session
        $cart = $this->_session->get('shop', 'cart');

        if ($cart === null) {
            $cart = [];
        }

        $this->_view->set('cart', $cart);

        // if the form is submitted save order
        if ($this->_request->method() == 'post') {
            
            $input  = [
                'payment'   => $this->_input['payment'],
                'status'    => 'pre',
                'name'      => $this->_input['name'],
                'address'   => $this->_input['address'],
                'email'     => $this->_input['email'],
            ];

            $shop_id        = $this->_api_client->save('/shop/null', $input);
            if (!$shop_id) {
                $this->_logger->error('Failed to save order');
                $this->_request->redirect('/shop');
            }

            // get product data for insertion
            foreach ($cart as $sku => $quantity) {
                $product_input      =    [
                    'sku'           => $sku,
                    'offset_start'  => 0,
                    'offset_end'    => 1,
                ];

                $product                = $this->_api_client->get('/product', $product_input)[0];
                $input['product_id']    = [
                    'product_id'        => $product->id,
                    'quantity'          => $quantity
                ];
                $result             = $this->_api_client->save('/shop/' . $shop_id, $input);
                if (!$result) {
                    $this->_logger->error('Failed to save product to order');
                    $this->_request->redirect('/shop');
                }

            }
            
            $input['status']    = 'ordered';
            $result             = $this->_api_client->save('/shop/' . $shop_id, $input);
            
            // success, send mail and do all stuff

            $this->_session->set('shop', 'cart', []);
            $this->_request->redirect('/thankyou');
        }
    }
}
