<?php

use Dotenv\Dotenv;
use Kudobuzz\Services\Request;
use Kudobuzz\Services\RequestClient;
use Kudobuzz\Services\Response;
use Kudobuzz\Services\Sentry;
use GuzzleHttp\Client;

if (!function_exists('loadEnv')){
    function loadEnv() {
        $dotenv =  Dotenv::create(dirname(__DIR__, 2));
        $dotenv->load();
    }
}

if (!function_exists('createBusiness')){
     function createBusiness(array $details)
    {
        $guzzle = new Client();
        try {
            $path = 'users/external_platform';

            $payload = [
                'email' => $details['email'],
                'external_id' => $details['domain'],
                'platform' => 'wordpress',
                'domain' => $details['domain'],
                'shop_domain' => $details['domain'],
                'token' => md5($details['domain']),
                'client_id' => env('CLIENT_APP_ID'),
                'client_secret' => env('CLIENT_APP_SECRET')
            ];

            $response = $guzzle->post( env('APP_URL').$path, ['json' => $payload])
                ->getBody()
                ->getContents();
            $response = json_decode($response);
            $response->type = 'new_business';

        } catch (\Exception $e) {
            $response = $e->getMessage();
            reportException($e, [
                'action' => 'fetching_business',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine()
            ]);
        }
        return $response;
    }
}

if (!function_exists('getBusiness')){
    function getBusiness(string $siteUrl)
    {
        $guzzle = new Client();
        $admin_email = get_bloginfo('admin_email');
        try {
            $path = 'users/external_platform';

            $data = [
                'email' =>  $admin_email,
                'client_id' =>  env('CLIENT_APP_ID'),
                'client_secret' => env('CLIENT_APP_SECRET')
            ];
            $query = http_build_query($data);

            $response = $guzzle->get(env('APP_URL').$path.'?'.$query)
                ->getBody()
                ->getContents();

            $response = json_decode($response);
            $response->type = 'old_business';

        } catch (\Exception $e) {
            $response = $e->getMessage();
            reportException($e, [
                'action' => 'fetching_business',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine()
            ]);
        }

        return $response;
    }
}

if (!function_exists('getWidget')) {
    function getWidget()
    {
        $guzzle = new Client();

        $business_id = get_option('kudobuzz_business_id');
        $user_id = get_option('kudobuzz_id');

        if (!empty($business_id) && !empty($user_id)) {
            try {
                $path = "script?business_id=" . $business_id . "&user_id=" . $user_id;

                $response = $guzzle->get(env('WIDGET_URL') . $path)
                    ->getBody()
                    ->getContents();
                $result = json_decode($response);
                return $result->data->script;

            } catch (Exception $e) {
                reportException($e, [
                    'action' => 'get_js_code',
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'code' => $e->getCode(),
                    'line' => $e->getLine(),
                    'platform' => 'wordpress',
                    'email' => wp_get_current_user()->user_email,
                    'url' => get_site_url(),
                ]);
            }
        }
    }
}

if (!function_exists('getBusinessByEmail')) {
    function getBusinessByEmail()
    {
        try {
            $guzzle = new Client();
            $admin_email = get_bloginfo('admin_email');

            $response = $guzzle->get(env('APP_URL').'users/external_platform', [
                "query" => [
                    "email" => $admin_email,
                    "client_id" => env('CLIENT_APP_ID'),
                    "client_secret" => env('CLIENT_APP_SECRET')
                ]
            ])->getBody()
                ->getContents();
            $result = json_decode($response);


            return $result->data;

        } catch (Exception $e) {
            reportException($e, [
                'action' => 'get_js_code',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'platform' => 'wordpress',
                'email' => $admin_email,
                'url' => get_site_url(),
            ]);
        }
    }
}

if (!function_exists('env')) {
    function env($variable) {
        return getenv($variable);
    }
}

if (! function_exists('request')) {
    function request() {
        return new Request();
    }
}

if (! function_exists('resquestClient')) {
    function requestClient() {
        return new RequestClient();
    }
}

if (! function_exists('response')) {
    function response() {
        return new Response();
    }
}

if (! function_exists('reportException')) {
    function reportException($e, $params = []) {
        $sentry = Sentry::getInstance();

        $sentry->reportException($e, $params);
    }
}

if (!function_exists('storage')){
    function storage(){
        return Storage();
    }
}

if (!function_exists('get_dashboard_auth_url')) {
    function get_dashboard_auth_url($business_id, $access_token) {
        return env('DASHBOARD_URL').'external-auth?bid='. $business_id .'&t='. $access_token;
    }
}
