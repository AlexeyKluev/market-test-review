<?php

namespace App\Pipes;

use App\Dto\OrderDto;
use App\SMS\SmsClient;

class SendSmsPipe
{
    /**
     * @var SmsClient
     */
    private SmsClient $smsClient;

    /**
     * @param SmsClient $smsClient
     */
    public function __construct(SmsClient $smsClient)
    {
        $this->smsClient = $smsClient;
    }

    /**
     * @param OrderDto $payload
     * @return OrderDto
     */
    public function __invoke(OrderDto $payload): OrderDto
    {
        $this->smsClient->send($payload->getPhone(), 'Текст смс');
        return $payload;
    }
}
