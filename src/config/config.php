<?php

use App\DbClient\Client;
use App\DbClient\QueryExecutorMock;
use App\SMS\SmsClient;
use App\SMS\SomeSMSSenderClient;

return [
    Client::class => static function () {
        return new Client(
            'postgresql:5432', // TODO: add .env
            'test',
            'test',
            'secret',
            new QueryExecutorMock(),
        );
    },
    SmsClient::class => static function () {
        return new SomeSMSSenderClient();
    },
];
