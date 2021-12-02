<?php
namespace App\Model;

use App\DbClient\Client;

class OrderRepository implements OrderRepositoryInterface
{
    private $dbClient;

    public function __construct(Client $dbClient) {
        $this->dbClient = $dbClient;
    }

    public function createOrder($fio, $phone, $productID) {
        $this->dbClient->createOrder([
            "fio" => $fio,
            "phone" => $phone,
            "product_id" => $productID,
        ]);
    }

    public function findOrder($phone, $productID): array {
        return $this->dbClient->getLastOrder($phone, $productID);
    }
}