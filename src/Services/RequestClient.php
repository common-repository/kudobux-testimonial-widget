<?php

namespace Kudobuzz\Services;

class RequestClient
{
    /**
     * Curl
     *
     * @var curl
     */
    private $curl;
    private $api_base_url;

    /**
     * RequestClient constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->curl = curl_init();
        $this->api_base_url = env('APP_URL');
    }

    /**
     * Make post request to endpoint
     *
     * @param string $url
     * @param array $payload
     * @return void
     */
    public function make_request($path, $method = 'GET', $payload = null, $headers = [])
    {
        $url = $this->api_base_url . $path;
        $this->set_options($url, $method, $headers);
        
        if ($payload) {
            $this->build_query($payload);
        }

        return $this->execute();
    }

    /**
     * Set curl options
     *
     * @param string $url
     * @return void
     */
    private function set_options($url, $method, $headers)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 5000);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        
        if ($method === 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, 1);
        }elseif($method === 'PUT'){
            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
        }
    }

    /**
     * Build query 
     *
     * @param array $payload
     * @return void
     */
    private function build_query($payload)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($payload));
    }

    /**
     * Execute curl request
     *
     * @return void
     */
    private function execute()
    {
        $response = curl_exec($this->curl);
        curl_close($this->curl);

        if (false === $response) {
            throw new Exception(curl_error($this->curl));
        }

        return $response;
    }
    
    /**
     * Set api base_url
     * 
     * @param type $value
     */
    public function set_api_base_url($value){
        $this->api_base_url = $value;
    }
}