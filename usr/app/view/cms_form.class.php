<?php
namespace app\view;

class cms_form extends \app\view {

    protected $_top = 'cms';

    protected $_view = 'cms_form';

    protected $_subs    = [
        'cms_category'  => null,
        'cms_product'   => null,
        'cms_shop'      => null,
    ];

    protected $_css = [
        '/css/form.css',
        '/css/cms_form.css'
    ];

    protected $_js = [];

    public function execute () {}
}
