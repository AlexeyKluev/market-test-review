<?php
namespace App\DbClient;

interface ClientInterface {
    function getAmount($product_id);
    function createOrder(array $order);
    function getLastOrder($phone, $productID): array;
}