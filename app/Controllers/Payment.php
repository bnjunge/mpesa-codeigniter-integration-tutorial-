<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Payment extends BaseController
{
    public function __construct()
    {
        helper('to_array');

    }


    public function index()
    {
        echo "Hello";
    }


    function postStk(){
        $data = $this->request->getJSON();
        $this->response->setStatusCode(200)->setJSON(['ResponseCode' => 0]);
    }

    function callback() {
        $data = $this->request->getJSON();

        return $this->response->setJSON( $data );
    }

    function pay_validate() {
        return $this->response->setJSON(array(
            'ResponseCode' => 0
        ));
    }
}
