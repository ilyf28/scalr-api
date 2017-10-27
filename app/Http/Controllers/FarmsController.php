<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class FarmsController extends Controller
{
    protected $_client;

    public function __construct()
    {
        $this->_client = new Client(['verify' => false]);
    }

    public function listFarms(Request $request)
    {
        try {
            $envId = '1';   // hard coding
            $api_uri = '/api/v1beta0/user/'.$envId.'/farms/';
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

                return view('farms.list', ['farms' => $result]);
            } else {
            }
        } catch (Exception $e) {
        }
    }

    public function createFarm(Request $request)
    {
        return view('farms.create');
    }

    public function storeFarm(Request $request)
    {
        try {
            $name = $request->name;
            $description = $request->description;
            $launchOrder = $request->launchOrder;
            $timezone = $request->timezone;
            $projectId = env('SCALR_PROJECT_ID');
            $teamsId = env('SCALR_TEAMS_ID');
            $payload = array(
                "description" => $description,
                "launchOrder" => $launchOrder,
                "name" => $name,
                "project" => array(
                    "id" => $projectId
                ),
                "teams" => array(
                    array("id" => $teamsId)
                ),
                "timezone" => $timezone
            );

            $envId = '1';   // hard coding
            $api_uri = '/api/v1beta0/user/'.$envId.'/farms/';
            $api_key_id = env('SCALR_API_KEY_ID');
            $api_secret_key = env('SCALR_API_SECRET_KEY');
            $body = json_encode($payload);
            $method = 'POST';
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
                ],
                'json' => $payload
            ]);

            if ($response->getStatusCode() === 201) {
                $result = json_decode($response->getBody());
                dd($result);

                return view('farms.list', ['farms' => $result]);
            } else {
            }
        } catch (Exception $e) {
        }
    }
}
