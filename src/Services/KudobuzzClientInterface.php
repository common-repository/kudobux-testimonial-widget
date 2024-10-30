<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 3/13/19
 * Time: 4:48 PM
 */

namespace Kudobuzz\Services;

interface KudobuzzClientInterface
{
    /**
     * @param array $payload of business details
     * @return mixed
     */
    public function createBusiness(array $payload);

    /**
     * @param string $siteUrl
     * @return mixed
     */
    public function getBusiness(string  $siteUrl);

    /**
     * @return mixed
     */
    public function getWidget();

}