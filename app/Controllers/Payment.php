<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\CLI\CLI;

class Payment extends BaseController
{
    public function index()
    {
        //
    }


    function postStk(){
        $data = $this->request->getJSON();
        $this->response->setStatusCode(200)->setJSON(['ResponseCode' => 0]);
    }
}
