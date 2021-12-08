<?php
namespace App\SMS;

class Client
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
     * @param $orderId
     * @param $phone
     * @return void
     */
    public function sendOrderConfirm($orderId, $phone): void
    {
        $this->smsClient->send($phone, sprintf("Ваш заказ #%d успешно создан", $orderId));
    }
}
