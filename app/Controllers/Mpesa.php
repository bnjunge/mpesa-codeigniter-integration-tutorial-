<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Mpesa extends BaseController
{
    private $client;
    function __construct()
    {
        $this->client = \Config\Services::curlrequest();
        // guzzle
    }

    public function getIndex()
    {
        echo "Welcome to Mpesa Tutorials";
    }

    public function getAccess_token()
    {
        $response = $this->client->request(
            'GET',
            'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            array(
                'auth' => array('L1WFwLyO5sYekeaW6v7ZgJPlifqk818j', 'teLMgeCkju44TNpW'),
                'http_errors' => false
            )
        );

        return $this->response->setJSON($response->getBody());
    }
}
