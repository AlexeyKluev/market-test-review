<?php

namespace App\SMS;

interface SmsClient
{
    /**
     * @param $phone
     * @param $body
     * @return mixed
     */
    public function send($phone, $body);
}
