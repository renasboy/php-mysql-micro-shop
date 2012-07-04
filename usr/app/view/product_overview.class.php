<?php
namespace app\view;

class product_overview extends \app\view {

    protected $_view = 'product_overview';

    protected $_subs = [];

    protected $_css = [
        '/css/form.css',
        '/css/product_filter.css',
        '/css/product_box.css',
        '/css/product_overview.css'
    ];

    protected $_js = [];

    public function execute () {

        $category   = $this->_api_client->get('/category/' . $this->get('category'), [])[0];

        $page   = $this->get('page');
        $filter = $this->get('filter');
        if ($filter === null) {
            $filter = [];
        }

        $input  = [
            'category_id'   => $category->id,
            'offset_start'  => $page * 20 - 20,
            'offset_end'    => 20
        ] + $filter;

        $products = $this->_api_client->get('/product', $input);

        $this->set('products', $products);
    }
}
