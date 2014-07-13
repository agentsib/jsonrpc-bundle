<?php


namespace AgentSIB\JsonRpcBundle\Server;

use AgentSIB\JsonRpc\JsonRpcSerializerInterface;
use AgentSIB\JsonRpc\JsonRpcServer AS BaseServer;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JsonRpcServer extends BaseServer
{
    /** @var  ContainerInterface */
    private $container;

    private $routing = array();

    public function __construct (ContainerInterface $container, JsonRpcSerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->container = $container;
    }

    public function addToRouting($resource, $namespace, $class) {

        if (!isset($this->routing[$resource])) {
            $this->routing[$resource] = array();
        }

        $namespaceNormalize = strtolower($namespace);

        if (isset($this->routing[$resource][$namespaceNormalize])){
            throw new \Exception('Namespace already exists');
        }

        $this->routing[$resource][$namespaceNormalize] = $class;
    }

    public function processResource ($resource, $request)
    {
        // @TODO RESET!
        if (!isset($this->routing[$resource])) {
            throw new \Exception('Resource not exists');
        }

        foreach ($this->routing[$resource] as $namespace => $class) {
            $this->addService($namespace, $class);
        }

        return $this->process($request);
    }


} 