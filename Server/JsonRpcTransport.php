<?php


namespace AgentSIB\JsonRpcBundle\Server;


use AgentSIB\JsonRpc\JsonRpcException;
use AgentSIB\JsonRpc\JsonRpcTransportInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JsonRpcTransport implements JsonRpcTransportInterface
{
    /** @var  ContainerInterface */
    private $container;

    function __construct (ContainerInterface $container)
    {
        $this->container;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest ($request)
    {
        if ($request instanceof Request) {
            return @json_decode($request->getContent(), false, 32);
        }
        throw new JsonRpcException(JsonRpcException::ERROR_PARSE_ERROR);
    }

    /**
     * @inheritdoc
     */
    public function serializeResponse ($response)
    {
        return new JsonResponse($response);
    }
}