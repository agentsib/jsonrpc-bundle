<?php


namespace AgentSIB\JsonRpcBundle\Server;

use AgentSIB\JsonRpc\JsonRpcServer AS BaseServer;
use AgentSIB\JsonRpc\Reflection\JsonRpcReflectionInterface;
use AgentSIB\JsonRpc\Serializers\JsonRpcSerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JsonRpcServer extends BaseServer
{
    /** @var  ContainerInterface */
    private $container;

    public function __construct (ContainerInterface $container, JsonRpcSerializerInterface $serializer, JsonRpcReflectionInterface $reflection = null)
    {
        parent::__construct($serializer, $reflection);
        $this->container = $container;
    }

    public function addService ($namespace, $class, $version = 1)
    {
        parent::addService($namespace, $class, $version); // TODO: Change the autogenerated stub
    }





} 