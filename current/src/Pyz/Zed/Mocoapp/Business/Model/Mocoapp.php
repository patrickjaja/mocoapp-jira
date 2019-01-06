<?php


namespace Pyz\Zed\Mocoapp\Business\Model;


use GuzzleHttp\Client;

class Mocoapp
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


}