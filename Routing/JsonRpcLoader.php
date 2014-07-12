<?php


namespace AgentSIB\JsonRpcBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class JsonRpcLoader extends Loader
{

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     * @param string $type The resource type
     */
    public function load ($resource, $type = null)
    {


        $routes = new RouteCollection();

        $routes->add('agentsib_jsonrpc.'.$resource.'.api', new Route('jsonrpc/{version}', array(
            '_controller'   =>  'JsonRpcBundle:JsonRpc:api',
            'version'   =>  'v1',
            'resource'  =>  $resource
        ), array(
            'version' => 'v\d+'
        )));

        return $routes;
    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed $resource A resource
     * @param string $type The resource type
     *
     * @return bool    true if this class supports the given resource, false otherwise
     */
    public function supports ($resource, $type = null)
    {
        return $type === 'jsonrpc' && preg_match('/^[a-z0-9_\-\.]{2,}$/', $resource);
    }
}