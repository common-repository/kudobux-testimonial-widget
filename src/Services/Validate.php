<?php

namespace Kudobuzz\Services;

class Validate
{
    /**
     * Validate email field
     *
     * @return void
     */
    public function email($request)
    {
        if (array_key_exists('email', $request)) {
            $email = $request['email'];
            
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode([
                    'errors' => (object) [
                        'error' => 'Validation error',
                        'message' => 'Email is not valid'
                    ]
                ]);
    
                wp_die();
            }
        }  
    }
}