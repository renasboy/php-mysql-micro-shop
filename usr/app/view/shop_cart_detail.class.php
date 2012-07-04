<?php
namespace app\view;

class shop_cart_detail extends \app\view {

    protected $_top = 'cart';

    protected $_view = 'shop_cart_detail';

    protected $_subs = [];

    protected $_css = [
        '/css/product_box.css',
        '/css/shop_cart_detail.css'
    ];

    protected $_js = [];

    public function execute () {
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
