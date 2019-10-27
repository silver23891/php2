<?php
require_once "BaseTest.php";

class GoodsTest extends BaseTest
{
    public function testGetGoods(){
        db::getInstance()->Connect(
            Config::get('db_user'), 
            Config::get('db_password'), 
            Config::get('db_base'), 
            Config::get('db_host')
        );
        $list = Good::getGoods(1);
        $this->assertNotNull($list);
        $this->assertIsArray($list);
        $this->assertArrayHasKey('name', $list[0]);
    }
}

$test = new GoodsTest;
$test->testGetGoods();