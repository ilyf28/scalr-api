<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class SessionController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client(['verify' => false]);
    }

    public function currentAuthenticatedUser(Request $request)
    {
        try {
            $api_uri = '/api/v1beta0/session/';
            $api_key_id = env('SCALR_API_KEY_ID');
            $api_secret_key = env('SCALR_API_SECRET_KEY');
            $body = '';
            $method = 'GET';
            $query = '';
            $date = date('c');
            $request = array(
                $method,
                $date,
                $api_uri,
                $query,
                $body
            );
            $signature = 'V1-HMAC-SHA256 ' . base64_encode(hash_hmac('sha256', implode("\n", $request), $api_secret_key, true));

            $response = $this->_client->request($method, env('SCALR_DOMAIN').$api_uri, [
                'headers' => [
                    'X-Scalr-Key-Id' => $api_key_id,
                    'X-Scalr-Date' => $date,
                    'X-Scalr-Debug' => '1',
                    'X-Scalr-Signature' => $signature
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody());

                return view('session', ['session' => $result]);
            } else {
            }
        } catch (Exception $e) {
        }
    }
}
