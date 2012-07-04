<?php
namespace app\view;

class cms_product extends \app\view {

    protected $_view = 'cms_product';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        // get categories using the API
        $input          = [
            'active'    => [0,1]
        ];
        $categories = $this->_api_client->get('/category', $input);

        // set returned value to the view
        $this->set('categories', $categories);

        // get products using the API
        $input          = [
            'active'    => [0,1]
        ];
        $products = $this->_api_client->get('/product', $input);

        // set returned value to the view
        $this->set('products', $products);
    }
}
