<?php

namespace Kudobuzz\Services;

class Response 
{
    /**
     * Send json representation of response
     *
     * @param array|exception $response
     * @return void
     */
    public function json($response)
    {
        echo json_encode($this->simplify($response));
        wp_die();
    }

    /**
     * Simplify response
     *
     * @param array|exception $response
     * @return array
     */
    private function simplify($response)
    {
        if (isset($response->data) || isset($response->data->access_token) || isset($response->msg)) {
            return [
                'data' => [
                    'status' => 'Success',
                    'msg' => $response->type ??  '',
                    'authUrl' => $response->authUrl ?? ''
                ]
            ];
        }

        if (isset($response->error) || isset($response->errors)) {
            return [
                'errors' => [
                    'title' => $response->errors[0]->title,
                    'msg' => $response->errors[0]->detail[0]->msg
                ]
            ];
        }

        if ($response instanceof Exception) {
            return [
                'errors' => [
                    'msg' => 'An error occurred, please try again.'
                ]
            ];
        }

        if (strpos($response, 'error')) {
            return [
                'errors' => [
                    'msg' => 'An error occurred, please try again.'
                ]
            ];
        }
    }
}
