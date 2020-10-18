<?php


namespace Flyingmana\Shasa\Service;

use Maclof\Kubernetes\Client;

class Kubernetes
{

    /** @var Client */
    public $client;

    public function initClient()
    {
        // kubectl proxy
        $this->client = new Client([
            'master' => 'http://127.0.0.1:8001',
        ]);
    }

    /**
     * @return \Maclof\Kubernetes\Collections\Collection|\Maclof\Kubernetes\Models\Node[]
     */
    public function getNodes()
    {
        return $this->client->nodes()->find();
    }

    public function getSecret(string $name)
    {
        //return $this->client->secrets()->find();
        return $this->client->sendRequest('GET',"/secrets/$name");
    }


    /**
     * @param string $namePattern
     * @return \Maclof\Kubernetes\Models\Secret[]
     */
    public function findSecrets(string $namePattern)
    {
        $result = [];
        foreach ($this->client->secrets()->find() as $secret)
        {
            if (strpos($secret->getMetadata("name"), $namePattern) !== false) {
                $result[] = $secret;
            }
        }
        return $result;
    }
}
