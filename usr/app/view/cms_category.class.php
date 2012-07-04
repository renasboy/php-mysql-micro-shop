<?php
namespace app\view;

class cms_category extends \app\view {

    protected $_view = 'cms_category';

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
    }
}
