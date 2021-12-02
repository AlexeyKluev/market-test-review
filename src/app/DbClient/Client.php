<?php
namespace App\DbClient;

use App\Model\Order;

class Client implements ClientInterface
{
    public $host;
    public $login;
    public $password;
    private $databasename;

    private $queryExecutor;

    public function __construct($host, $login, $password, $databasename, QueryExecutorInterface $queryExecutor)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
        $this->databasename = $databasename;
        $this->queryExecutor = $queryExecutor;
    }

    private function createExecutorConfig() {
        return [
            "host" => $this->host,
            "login" => $this->login,
            "password" => $this->password,
            "database" => $this->databasename
        ];
    }

    public function getAmount($product_id)
    {
        $sql = "Select amount from products where id = " . $product_id;
        $queryResult = $this->queryExecutor->query($sql, $this->createExecutorConfig());

        foreach($queryResult as $row) {
            return $row['amount'];
        }
    }

    public function createOrder(array $order) {
        $sql = "Insert into orders ('fio', 'phone', 'product_id') VALUES(" . $order["fio"] .", " . $order["phone"] . ", " . $order["product_id"] . ")";
        $this->queryExecutor->query($sql, $this->createExecutorConfig());
    }

    public function getLastOrder($phone, $productID): array
    {
        $sql = "select * from orders where 'phone' = " . $phone . " and 'product_id' = " . $productID . " order by id desc";
        $queryResult = $this->queryExecutor->query($sql, $this->createExecutorConfig());

        foreach($queryResult as $row) {
            return $row;
        }
    }
}