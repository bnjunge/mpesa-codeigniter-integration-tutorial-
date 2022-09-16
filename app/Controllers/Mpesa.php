<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Mpesa extends BaseController
{
    private $client, $base_url;
    function __construct()
    {
        $this->base_url = "https://0d26-102-135-169-122.eu.ngrok.io";
        $this->client = \Config\Services::curlrequest();
    }

    public function getIndex()
    {
        echo "Welcome to Mpesa Tutorials";
    }


    public function getExpress()
    {
        $endpoint = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $BusinessShortCode = 174379;
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $Timestamp = date('YmdHis');
        $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = '1';
        $PartyA = '254716437799';
        $PartyB = '174379';
        $PhoneNumber = '254716437799';
        $CallBackURL = $this->base_url . '/payment/stk';
        $AccountReference = 'test';
        $TransactionDesc = 'just a payment from CI';

        $body = compact(
            'BusinessShortCode',
            'Timestamp',
            'Password',
            'TransactionType',
            'Amount',
            'PartyA',
            'PartyB',
            'PhoneNumber',
            'CallBackURL',
            'AccountReference',
            'TransactionDesc'
        );

        $response = $this->client->request(
            'post',
            $endpoint,
            array(
                'headers' => array('authorization' => 'Bearer ' . $this->getAccess_token()),
                'json' => $body,
                'http_errors' => false
            )
        );

        return $this->response->setJSON($response->getBody());
    }


    public function register_urls()
    {
        $endpoint = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        $data = array(
            'ValidationURL' => $this->base_url . '/payment/callback',
            'ConfirmationURL' => $this->base_url . '/payment/pay-validate',
            'ResponseType' => 'Completed',
            'ShortCode' => '600999'
        );

        $response = $this->client->request(
            'post',
            $endpoint,
            array(
                'headers' => array('authorization' => 'Bearer ' . $this->getAccess_token()),
                'json' => $data,
                'http_errors' => false
            )
        );

        return $this->response->setJSON($response->getBody());
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

        return json_decode($response->getBody())->access_token;
    }
}
