<?php
/**
 * Created by PhpStorm.
 * User: ikovalenko
 * Date: 16.07.14
 * Time: 14:14
 */

namespace AgentSIB\JsonRpcBundle\Server\Transports;


use AgentSIB\JsonRpc\Responses\JsonRpcResponse;
use AgentSIB\JsonRpc\Transports\JsonRpcTransportInterface;
use AgentSIB\JsonRpcBundle\Server\JsonRpcServer;
use Symfony\Component\HttpFoundation\JsonResponse;

class InternalJsonRpcTransport implements JsonRpcTransportInterface{

    /** @var  JsonRpcServer */
    protected $server;

    function __construct(JsonRpcServer $server)
    {
        $this->server = $server;
    }


    public function sendRequest($request)
    {
        /** @var JsonResponse $response */
        $response = $this->server->process($request);

        return $response->getContent();
    }
}