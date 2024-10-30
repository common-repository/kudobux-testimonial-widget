<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 3/13/19
 * Time: 4:48 PM
 */
namespace Kudobuzz\Services;

use GuzzleHttp\Client;

class KudobuzzClient implements KudobuzzClientInterface
{
    protected $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    public function createBusiness(array $details)
    {
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

            $response = $this->guzzle->post( env('APP_URL').$path, ['json' => $payload])
                ->getBody()
                ->getContents();
            $response = json_decode($response);
            $response->type = 'new_business';

        return $response;
    }

    public function getBusiness(string $siteUrl)
    {
            $path = 'users/external_platform';

            $data = [
                'email' =>  wp_get_current_user()->user_email,
                'client_id' =>  env('CLIENT_APP_ID'),
                'client_secret' => env('CLIENT_APP_SECRET')
            ];
            $query = http_build_query($data);

            $response = $this->guzzle->get(env('APP_URL').$path.'?'.$query)
                ->getBody()
                ->getContents();

            $response = json_decode($response);
            $response->type = 'old_business';

        return $response;
    }

    public function getWidget()
    {
        $business = $this->getBusinessByEmail();

        if (!empty($business));
            $path = "script?business_id=" . $business->businesses[0]->id. "&user_id=" . $business->id;

            $response = $this->guzzle->get(env('WIDGET_URL').$path)
                        ->getBody()
                        ->getContents();
            $result = json_decode($response);

            return $result->data->script;

    }

    public function getBusinessByEmail()
    {

            $response = $this->guzzle->get(env('APP_URL').'users/external_platform', [
                "query" => [
                    "email" => wp_get_current_user()->user_email,
                    "client_id" => env('CLIENT_APP_ID'),
                    "client_secret" => env('CLIENT_APP_SECRET')
                ]
            ])->getBody()
                ->getContents();
            $result = json_decode($response);


            return $result->data;

    }
}
