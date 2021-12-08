<?php

namespace App\Model;

use App\DbClient\Client;

class OrderRepository implements OrderRepositoryInterface
{
    private Client $dbClient;

    public function __construct(Client $dbClient)
    {
        $this->dbClient = $dbClient;
    }

    public function createOrder(string $fio, string $phone, int $productID)
    {
        $this->dbClient->createOrder([
            "fio" => $fio,
            "phone" => $phone,
            "product_id" => $productID,
        ]);
    }

    public function findOrder(string $phone, int $productID): array
    {
        return $this->dbClient->getLastOrder($phone, $productID);
    }
}
