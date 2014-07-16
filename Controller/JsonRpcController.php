<?php


namespace AgentSIB\JsonRpcBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class JsonRpcController extends Controller{

    public function apiAction($resource, $version = 'v1') {
        return $this->container->get('json_rpc.server')->process($this->getRequest());
    }
} 