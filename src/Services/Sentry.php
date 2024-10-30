<?php

namespace Kudobuzz\Services;

use GuzzleHttp\Exception\ClientException;

class Sentry
{
    /**
     * Sentry client
     *
     * @var object
     */
    private $client;

    private $dontReport = [
        ClientException::class
    ];

    /**
     * Class instance
     *
     * @var self
     */
    private static $instance;

    public function __construct()
    {
        $this->client = new \Raven_Client(env('SENTRY_CLIENT_KEY'));
        $this->client->install();
    }

    /**
     * Set the globally available instance of sentry.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Report exception to sentry
     *
     * @param exception $e
     * @param array $params
     * @return void
     */
    public function reportException($e, $params = [])
    {
        $exceptionClass = get_class($e);

        if (!in_array($exceptionClass, $this->dontReport)) {

            $this->client->captureException($e, $params);
        }
    }
}