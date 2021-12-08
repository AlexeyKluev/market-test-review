<?php

namespace App\Model;

use App\DbClient\Client;

class ProductRepository
{
    private Client $dbClient;

    public function __construct(Client $dbClient) {
        $this->dbClient = $dbClient;
    }

    public function getAmount(int $productId): int
    {
        return $this->dbClient->getAmount($productId);
    }
}
