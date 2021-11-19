<?php
namespace App\DbClient;

class QueryExecutorMock implements QueryExecutorInterface {

    public $amount;
    public $lastOrder;

    function query($query, $config)
    {
        $q = strtolower($query);
        switch (true){
            case $this->startWith($q, "select amount"):
                return [["amount" => $this->amount]];
            case $this->startWith($q, "select *"):
                return [$this->lastOrder];
            default:
                break;
        }
    }

    function startWith(string $str, string $substr): bool {
        return substr($str, 0, strlen($substr)) === $substr;
    }
}