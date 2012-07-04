<?php
namespace app\view;

class cms_shop extends \app\view {

    protected $_view = 'cms_shop';

    protected $_subs = [];

    protected $_css = [];

    protected $_js = [];

    public function execute () {
        // get shops using the API
        $shops = $this->_api_client->get('/shop', [ 'products' => true ]);

        // set returned value to the view
        $this->set('shops', $shops);
    }
}
