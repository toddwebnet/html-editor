<?php
namespace App\Services\Api;

class S3ApiService extends BaseApi
{
    public function __construct()
    {
        $baseUrl = $GLOBALS['s3Url'];
        parent::__construct($baseUrl);
    }

    public function dirtree()
    {
        $response =  $this->call('POST', '/dirtree');
        return $response->getBody();

    }
}