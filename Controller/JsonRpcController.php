<?php


namespace AgentSIB\JsonRpcBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class JsonRpcController extends Controller{

    public function apiAction($resource, $version = 'v1') {
        if (!preg_match('/^v[0-9]+$/', $version)) {
            throw new \LogicException('Unspecific version');
        }
        return $this->container->get(sprintf('json_rpc.server.%s', $resource, substr($version, 1)))->process($this->getRequest());
    }
} 