<?php

namespace Kudobuzz\Services;

class Request 
{
    /**
     * Request
     *
     * @var array
     */
    private $post;

    /**
     * Validate
     *
     * @var object
     */
    private $validate;

    /**
     * Request constructor
     */
    public function __construct()
    {
        $this->post = $_POST;
        $this->validate = new Validate();
    }

    /**
     * Get all request fields
     *
     * @return void
     */
    public function all()
    {
        $validFields = [];

        $this->validate();

        foreach(array_keys($this->post) as $field) {
            $validFields[$field] = $this->post[$field];
        }

        return $validFields;
    }

    /**
     * Validate request fields
     *
     * @return void
     */
    private function validate()
    {        
        $this->validate->email($this->post);
    }
}