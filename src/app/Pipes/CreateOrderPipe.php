<?php

namespace App\Pipes;

use App\Dto\OrderDto;
use App\Model\OrderRepository;

class CreateOrderPipe
{
    /**
     * @var OrderRepository
     */
    private OrderRepository $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param OrderDto $payload
     * @return OrderDto
     */
    public function __invoke(OrderDto $payload): OrderDto
    {
        $this->orderRepository->createOrder(
            $payload->getFio(),
            $payload->getPhone(),
            $payload->getProductId()
        );
        return $payload;
    }
}
