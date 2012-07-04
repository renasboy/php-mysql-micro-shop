<?php
namespace app\view;

class category_overview extends \app\view {

    protected $_view = 'category_overview';

    protected $_subs = [];

    protected $_css = [
        '/css/form.css',
        '/css/category_box.css',
        '/css/category_overview.css'
    ];

    protected $_js = [];

    public function execute () {
        /*
        $page   = $this->get('page');
        $filter = $this->get('filter');
        if ($filter === null) {
            $filter = [];
        }

        $input  = [
            'offset_start'  => $page * 20 - 20,
            'offset_end'    => 20
        ] + $filter;
        */
        $input = [];

        $categories = $this->_api_client->get('/category', $input);

        $this->set('categories', $categories);
    }
}
