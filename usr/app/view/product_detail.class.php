<?php
namespace app\view;

class product_detail extends \app\view {

    protected $_view = 'product_detail';

    protected $_subs = [];

    protected $_css = [
        '/css/product_detail.css'
    ];

    protected $_js = [];

    public function execute () {

        $category   = $this->_api_client->get('/category/' . $this->get('category'), [])[0];

        $input  = [
            'category_id'   => $category->id,
            'sku'           => $this->get('sku'),
            'offset_start'  => 0,
            'offset_end'    => 1
        ];

        $product = $this->_api_client->get('/product', $input)[0];
        $this->set('product', $product);
    }
}
