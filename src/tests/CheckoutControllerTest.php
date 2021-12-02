<?php
namespace Tests;

use App\DbClient\QueryExecutorMock;
use App\Http\CheckoutController;

class CheckoutControllerTest extends \PHPUnit_Framework_TestCase {
    public function test_checkout_amount_more_ten() {
        $queryExecutor = new QueryExecutorMock();
        $queryExecutor->amount = 11;
        $queryExecutor->lastOrder = [
            "id" => 1,
            "phone" => "123-456-789",
            "fio" => "First Second Last",
            "product_id" => 2,
        ];
        $tc = new CheckoutController([
                "db_host" => "",
                "db_login" => "",
                "db_password" => "",
                "db_database" => "",
            ], $queryExecutor);

        $_GET["product_id"] = 2;
        $_GET["fio"] = "First Second Last";
        $_GET["phone"] = "123-456-789";
        $result = $tc->checkout();
        $this->assertEquals("ok", $result);
    }

    public function test_checkout_amount_is_null() {
        $queryExecutor = new QueryExecutorMock();
        $queryExecutor->amount = 0;

        $tc = new CheckoutController([
            "db_host" => "",
            "db_login" => "",
            "db_password" => "",
            "db_database" => "",
        ], $queryExecutor);
        $_GET["product_id"] = 2;
        $_GET["fio"] = "First Second Last";
        $_GET["phone"] = "123-456-789";
        $result = $tc->checkout();
        $this->assertEquals("Закончились на складе", $result);
    }
}


