<?php
namespace app\view;

class top_cms extends \app\view {

    protected $_view     = 'top_cms';

    protected $_subs    = [
        'header_cms'    => null,
        'footer_cms'    => null
    ];

    protected $_js = [];

    protected $_css = [
        '/css/default.css',
        '/css/btn.css',
        '/css/box.css'
    ];

    public function execute () {
        $all_css    = $this->css();
        if ($this->_conf->get('css_cache')) {
            $all_css   = [ $this->_helper->pack_css($all_css) ];
        }
        $this->set('css',   $all_css);

        $all_js     = $this->js();
        if ($this->_conf->get('js_cache')) {
            $all_js   = [ $this->_helper->pack_js($all_js) ] ;
        }
        $this->set('js',    $all_js);
    }
}
