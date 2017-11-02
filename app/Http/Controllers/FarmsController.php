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

                return view('farms.create', ['farm' => $result]);
            } else {
            }
        } catch (Exception $e) {
        }
    }

    public function deleteFarm(Request $request)
    {
        return view('farms.delete');
    }

    public function destroyFarm(Request $request)
    {
        try {
            $envId = '1';   // hard coding
            $farmId = $request->farmId;
            $api_uri = '/api/v1beta0/user/'.$envId.'/farms/'.$farmId;
            $api_key_id = env('SCALR_API_KEY_ID');
            $api_secret_key = env('SCALR_API_SECRET_KEY');
            $body = '';
            $method = 'DELETE';
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

            if ($response->getStatusCode() === 204) {
                return view('farms.delete', ['message' => 'Done!']);
            } else {
            }
        } catch (Exception $e) {
        }
    }

    public function launchFarm(Request $request)
    {
        try {
            $farmId = $request->farmId;

            $envId = '1';   // hard coding
            $api_uri = '/api/v1beta0/user/'.$envId.'/farms/'.$farmId.'/actions/launch/';
            $api_key_id = env('SCALR_API_KEY_ID');
            $api_secret_key = env('SCALR_API_SECRET_KEY');
            $body = '';
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
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect('/farms');
            } else {
            }
        } catch (Exception $e) {
        }
    }

    public function terminateFarm(Request $request)
    {
        try {
            $farmId = $request->farmId;

            $envId = '1';   // hard coding
            $api_uri = '/api/v1beta0/user/'.$envId.'/farms/'.$farmId.'/actions/terminate/';
            $api_key_id = env('SCALR_API_KEY_ID');
            $api_secret_key = env('SCALR_API_SECRET_KEY');
            $body = '';
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
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect('/farms');
            } else {
            }
        } catch (Exception $e) {
        }
    }

    public function createFarmRole(Request $request)
    {
        return view('farm-roles.create');
    }

    public function storeFarmRole(Request $request)
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

            $alias = $request->alias;
            $folder = $request->folder;
            $computeResource = $request->computeResource;
            $resourcePool = $request->resourcePool;
            $dataStore = $request->dataStore;
            $hosts = $request->hosts;
            $cloudLocation = 'datacenter-101';
            $cloudPlatform = 'vmware';
            $instanceType = $request->instanceType;
            $roleId = '96542';
            $network = $request->network;

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

                $farmId = $result->data->id;
                $payload = array(
                    "alias" => $alias,
                    "cloudFeatures" => array(
                        "folder" => $folder,
                        "computeResource" => $computeResource,
                        "resourcePool" => $resourcePool,
                        "dataStore" => $dataStore,
                        "hosts" => array($hosts)
                    ),
                    "cloudLocation" => $cloudLocation,
                    "cloudPlatform" => $cloudPlatform,
                    "instanceType" => array(
                        "id" => $instanceType
                    ),
                    "role" => array(
                        "id" => $roleId
                    ),
                    "networking" => array(
                        "networks" => array(
                            array("id" => $network)
                        ),
                        "hostname" => array(
                            "type" => "TemplateHostnameConfiguration",
                            "template" => "ubuntu-sh"
                        )
                    )
                );

                $envId = '1';   // hard coding
                $api_uri = '/api/v1beta0/user/'.$envId.'/farms/'.$farmId.'/farm-roles/';
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
                    
                    $envId = '1';   // hard coding
                    $api_uri = '/api/v1beta0/user/'.$envId.'/farms/'.$farmId.'/actions/launch/';
                    $api_key_id = env('SCALR_API_KEY_ID');
                    $api_secret_key = env('SCALR_API_SECRET_KEY');
                    $body = '';
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
                        ]
                    ]);

                    if ($response->getStatusCode() === 200) {
                        return redirect('/farms');
                    } else {
                    }
                } else {
                }

            } else {
            }
        } catch (Exception $e) {
        }
    }
}
