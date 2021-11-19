<?php
namespace App\Model;

interface OrderRepositoryInterface {
    function createOrder($fio, $phone, $productID);
    function findOrder($phone, $productID): array;
}