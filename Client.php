<?php

namespace IC\ElasticsearchBundle;

use Exception;

class Client extends \Elasticsearch\Client
{
    public function index($params)
    {
        $id = $this->extractArgument($params, 'id');

        $index = $this->extractArgument($params, 'index');

        $type = $this->extractArgument($params, 'type');

        $body = $this->extractArgument($params, 'body');

        /** @var callback $endpointBuilder */
        $endpointBuilder = $this->dicEndpoints;

        /** @var \Elasticsearch\Endpoints\Index $endpoint */
        $endpoint = $endpointBuilder('Index');
        $endpoint->setID($id)
                 ->setIndex($index)
                 ->setType($type)
                 ->setBody($body);
        $endpoint->setParams($params);
        $response = $endpoint->performRequest();

        switch ($response['status']) {
            case 401:
                throw new Exception($response['data'], $response['status']);
                break;

            default:
        }

        return $response['data'];
    }
}
