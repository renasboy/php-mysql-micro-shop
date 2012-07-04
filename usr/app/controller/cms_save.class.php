<?php
namespace app\controller;

class cms_save extends \app\simple_controller {

    protected $_default_input   = [
        'entity'                => null,
        'id'                    => null,

        'name'                  => null,
        'file'                  => null,

        'category_id'           => null,
        'sku'                   => null,
        'price'                 => null
    ];

    protected function _validate_input () {
#        // get authenthication from session object
#        $auth = $this->_session->get('auth', 'privileges');
#
#        // if not authenticated send to error
#        if (!$auth|| !in_array($auth, ['admin'])) {
#            $this->_error->unauthorized('unauthorized attempt to use cms save');
#        }

        // check for http request method to be post
        if ($this->_request->method() != 'post') {
            $this->_error->bad_request('bad request for cms save with method other than post');
        }

        // validate available cms entity in list
        $this->_validator->validate('is_in_list', $this->_input['entity'], ['category', 'product']);

        // do validation according to entity
        switch ($this->_input['entity']) {
            case 'category':
                $this->_validator->validate('is_text', $this->_input['name']);
                $this->_validator->validate('is_image', $this->_input['file']);

                // generate seo out of name, seo is the permalink
                $this->_input['seo']    = $this->_validator->seo($this->_input['name']);

                // if editing validate id
                if ($this->_input['id']) {
                    $this->_validator->validate('is_entity', 'category', 'id', $this->_input['id']);
                }
            break;

            case 'product':
                $this->_validator->validate('is_text', $this->_input['name']);
                $this->_validator->validate('is_entity', 'category', 'id',  $this->_input['category_id']);
                $this->_validator->validate('is_text', $this->_input['sku']);
                // TODO validate unique SKU
                $this->_validator->validate('is_text', $this->_input['price']);
                $this->_validator->validate('is_image', $this->_input['file']);

                // generate seo out of name, seo is the permalink
                $this->_input['seo']    = $this->_validator->seo($this->_input['name']);

                // if editing validate id
                if ($this->_input['id']) {
                    $this->_validator->validate('is_entity', 'product', 'id', $this->_input['id']);
                }
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

                // if there is an image to be uploaded
                if ($this->_input['file']) {
                    $file    = sprintf('category/%s-%s.%s', $this->_input['seo'], $this->_request->time(), pathinfo($this->_input['file']['name'], PATHINFO_EXTENSION));
                    $name   = $this->_conf->get('image_root') . '/' . $file;
                    if (!move_uploaded_file($this->_input['file']['tmp_name'], $name)) {
                        $this->_logger->error('failed to move uploaded file');
                        return false;
                    }
                    $this->_input['file'] = $file;
                }        

                $input  = [
                    'name'      => $this->_input['name'],
                    'seo'       => $this->_input['seo'],
                    'img'       => $this->_input['file']
                ];
                $result = $this->_api_client->save('/category/' . $this->_input['seo'], $input);
            break;

            case 'product':

                // if there is an image to be uploaded
                if ($this->_input['file']) {
                    $file    = sprintf('product/%s-%s.%s', $this->_input['seo'], $this->_request->time(), pathinfo($this->_input['file']['name'], PATHINFO_EXTENSION));
                    $name   = $this->_conf->get('image_root') . '/' . $file;
                    if (!move_uploaded_file($this->_input['file']['tmp_name'], $name)) {
                        $this->_logger->error('failed to move uploaded file');
                        return false;
                    }
                    $this->_input['file'] = $file;
                }

                $input  = [
                    'name'          => $this->_input['name'],
                    'seo'           => $this->_input['seo'],
                    'category_id'   => $this->_input['category_id'],
                    'sku'           => $this->_input['sku'],
                    'price'         => $this->_input['price'],
                    'img'           => $this->_input['file']
                ];

                $result = $this->_api_client->save('/product/' . $this->_input['sku'], $input);
            break;
        }

        if (!$result) {
            $this->_logger->error('failed on cms save: ' . $this->_api_client->error()['message']);
            return false;
        }

        $this->_request->redirect('/cms');
    }
}
