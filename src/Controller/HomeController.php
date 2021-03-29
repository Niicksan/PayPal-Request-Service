<?php

namespace App\Controller;

use Symfony\Component\HttpClient\NativeHttpClient;

class HomeController
{
    private function payPal($timeout = 20)
    {
        $client = new NativeHttpClient();

        //production endpoint
        //$endpoint = 'https://api-m.paypal.com';

        //testing endpoint
        $endpoint = 'https://api-m.sandbox.paypal.com';

        $client = 'A21AAJxUmKFk5OQ1Sm9y_HaoPUCMgmzNqVKhNStGhChb7bbc4eRKsdAB-b6aBb8ef45g_7qiyb9fMR-uFggB8HBTxEK_jDuHw';
        $secret = 'A21AAJxUmKFk5OQ1Sm9y_HaoPUCMgmzNqVKhNStGhChb7bbc4eRKsdAB-b6aBb8ef45g_7qiyb9fMR-uFggB8HBTxEK_jDuHw';

        $response = $client->request(
            'POST', $endpoint . '/v1/payments/payment',  [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer <Access-Token>',
                ],
                ' auth_bearer:' => ['iasp-dev', 'iasp-dev'],
                //'json' => $params,
                'timeout' => !empty($timeout) && intval($timeout) ? $timeout : 10,
            ]
        );

        $content = $response->toArray();

        // cancels the request/response
        $response->cancel();

        return $content;
    }

}