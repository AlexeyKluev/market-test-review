<?php
namespace App\SMS;

class Client
{
    public function sendOrderConfirm($orderId, $phone)
    {
        $client = new SomeSMSSenderClient();
        $client->send($phone, sprintf("Ваш заказ #%d успешно создан", $orderId));
    }
}