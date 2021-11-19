<?php
namespace App\DbClient;

interface QueryExecutorInterface {
    function query($query, $config);
}