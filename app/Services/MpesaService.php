<?php

namespace App\Services;

use GuzzleHttp\Client;

class MpesaService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $shortCode;
    protected $passkey;
    protected $env;
    protected $baseUrl;

    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->shortCode = env('MPESA_SHORTCODE');
        $this->passkey = env('MPESA_PASSKEY');
        $this->env = env('MPESA_ENV');
        $this->baseUrl = env('MPESA_BASE_URL');
    }

    public function getAccessToken()
    {
        $client = new Client();
        $response = $client->request('GET', $this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials', [
            'auth' => [$this->consumerKey, $this->consumerSecret]
        ]);

        $body = json_decode($response->getBody());
        return $body->access_token;
    }

    public function stkPushRequest($amount, $phoneNumber, $accountReference, $transactionDesc)
    {
        $accessToken = $this->getAccessToken();
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortCode . $this->passkey . $timestamp);

        $client = new Client();
        $response = $client->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json'
            ],
            'json' => [
                'BusinessShortCode' => $this->shortCode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phoneNumber,
                'PartyB' => $this->shortCode,
                'PhoneNumber' => $phoneNumber,
                'CallBackURL' => env('MPESA_CALLBACK_URL'),
                'AccountReference' => $accountReference,
                'TransactionDesc' => $transactionDesc,
            ]
        ]);

        return json_decode($response->getBody());
    }
}
