<?php
namespace app\view;

class shop_form extends \app\view {

    protected $_top = 'cart';

    protected $_view = 'shop_form';

    protected $_subs = [];

    protected $_css = [
        '/css/form.css',
        '/css/shop_form.css'
    ];

    protected $_js = [];

    public function execute () {

        // get shopping cart info first
        $cart = $this->get('cart');

        $products = [];
        foreach ($cart as $sku => $quantity) {
            $input  = [
                'sku'           => $sku,
                'offset_start'  => 0,
                'offset_end'    => 1
            ];

            $product            = $this->_api_client->get('/product', $input)[0];
            $product->quantity  = $quantity;
            $products[]         = $product;
        }

        $this->set('products', $products);
    }
}
