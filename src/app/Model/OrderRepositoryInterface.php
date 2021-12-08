<?php
namespace App\Model;

interface OrderRepositoryInterface {

    /**
     * @param string $fio
     * @param string $phone
     * @param int $productID
     * @return mixed
     */
    public function createOrder(string $fio, string $phone, int $productID);

    /**
     * @param string $phone
     * @param int $productID
     * @return array
     */
    public function findOrder(string $phone, int $productID): array;
}
