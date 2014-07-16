<?php

namespace AgentSIB\JsonRpcBundle\Test;


use AgentSIB\JsonRpc\JsonRpcClient;
use AgentSIB\JsonRpcBundle\Server\JsonRpcServer;
use AgentSIB\JsonRpcBundle\Server\Serializers\JsonRpcSerializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class JsonRpcServiceTestCase extends WebTestCase {

    /** @var  JsonRpcClient */
    protected $client;


    protected function setUp()
    {
        $client = $this->createClient();

        if (!$client->getContainer()->has(sprintf('json_rpc.client.internal.%s', $this->getResourceName()))){
            $this->fail('Client not found');
        }

        $this->client = $client->getContainer()->get(sprintf('json_rpc.client.internal.%s', $this->getResourceName()));


    }


    abstract function getResourceName();

}