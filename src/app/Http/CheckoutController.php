<?php
namespace App\Http;

use App\DbClient\Client;
use App\DbClient\QueryExecutorInterface;
use App\DbClient\QueryExecutorMock;
use App\Model\OrderRepository;

class CheckoutController
{
    public $config;

    public function __construct($config, $queryExecutor) {
        $this->config = $config;
        $this->queryExecutor = $queryExecutor;
    }

    public function checkout(): string
    {
        $fio = $_GET["fio"];
        $phone = $_GET["phone"];
        $product_id = $_GET["product_id"];
        $cnt = $this->productsCnt($product_id);
        if($cnt > 1) {
            $repository = new OrderRepository(new Client(
                $this->config["db_host"],
                $this->config["db_login"],
                $this->config["db_password"],
                $this->config["db_database"],
                $this->queryExecutor
            ));
            $repository->createOrder($fio, $phone, $product_id);
            $order = $repository->findOrder($phone, $product_id);
            if($order != null) {
                $client = new \App\SMS\Client();
                $client->sendOrderConfirm($order["id"], $order['phone']);
            }
            return "ok";
        } else {
            return "Закончились на складе";
        }
    }

    public function productsCnt($productID) {
        $dbClient =  new Client(
            $this->config["db_host"], $this->config["db_login"], $this->config["db_password"], $this->config["db_database"],
            $this->queryExecutor
        );
        return $dbClient->getAmount($productID);
    }

}