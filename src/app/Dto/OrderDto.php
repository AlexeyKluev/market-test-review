<?php

namespace App\Dto;

class OrderDto
{
    private string $fio;
    private string $phone;
    private int $productId;

    /**
     * @param string $fio
     * @param string $phone
     * @param int $productID
     */
    public function __construct(string $fio, string $phone, int $productID)
    {
        $this->fio = $fio;
        $this->phone = $phone;
        $this->productId = $productID;
    }

    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }
}
