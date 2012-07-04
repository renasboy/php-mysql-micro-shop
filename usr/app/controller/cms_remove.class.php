<?php
namespace app\controller;

class cms_remove extends \app\simple_controller {

    protected $_default_input   = [
        'entity'                => null,
        'id'                    => null
    ];

    protected function _validate_input () {
#        // get authenthication from session object
#        $auth = $this->_session->get('auth', 'privileges');
#
#        // if not authenticated send to error
#        if (!$auth|| !in_array($auth, ['admin'])) {
#            $this->_error->unauthorized('unauthorized attempt to use cms save');
#        }

#        // check for http request method to be post
#        if ($this->_request->method() != 'post') {
#            $this->_error->bad_request('bad request for cms save with method other than post');
#        }

        // validate available cms entity in list
        $this->_validator->validate('is_in_list', $this->_input['entity'], ['category', 'product']);

        // do validation according to entity
        switch ($this->_input['entity']) {
            case 'category':
                $this->_validator->validate('is_entity', 'category', 'seo', $this->_input['id']);
            break;

            case 'product':
                $this->_validator->validate('is_entity', 'product', 'sku', $this->_input['id']);
            break;
        }


        if ($this->_validator->error()) {
            $this->_error->bad_request('bad request for cms save: ' . $this->_validator->error());
        }
    }

    protected function _execute () {

        // save according to entity
        switch ($this->_input['entity']) {
            case 'category':
                $result = $this->_api_client->delete('/category/' . $this->_input['id'], []);
            break;

            case 'product':
                $result = $this->_api_client->delete('/product/' . $this->_input['id'], []);
            break;
        }

        if (!$result) {
            $this->_logger->error('failed on cms remove: ' . $this->_api_client->error()['message']);
            return false;
        }

        $this->_request->redirect('/cms');
    }
}
