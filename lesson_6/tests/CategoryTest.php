<?php
require_once "BaseTest.php";

class CategoryTest extends BaseTest
{
    public function testGetCategories(){
        db::getInstance()->Connect(
            Config::get('db_user'), 
            Config::get('db_password'), 
            Config::get('db_base'), 
            Config::get('db_host')
        );
        $list = Category::getCategoryList();
        $this->assertNotNull($list);
        $this->assertIsArray($list);
        $this->assertCount(6, $list);
    }
}

$test = new CategoryTest;
$test->testGetCategories();