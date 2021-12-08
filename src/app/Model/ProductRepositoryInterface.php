<?php

namespace App\Model;

interface ProductRepositoryInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getAmount(int $productId): int;
}
