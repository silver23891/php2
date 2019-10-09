<?php

/* 
 * Работа с БД
 * Singletone
 */
class Db
{
    /** Экземпляр класса @var self */
    public static $connection;
    /** @var PDO */
    private static $db;
    
    /**
     * Получить экземпляр класса
     * 
     * @return self
     */
    public static function getConnection()
    {
        if (self::$connection == null) {
            try {
                self::$db = new PDO(
                    'mysql:host=db;dbname=geekbrains;charset=utf8', 
                    'root', '123456'
                );
            } catch (Exception $e) {
                echo 'Ошибка при подключении к БД: ' . $e->getMessage();
            }
            self::$connection = new self;
        }
        return self::$connection;
    }
    
    /**\
     * Получить товары
     * 
     * @param int $offset SQL сдвиг
     * @param int $limit  Максимальное кол-во записей
     *
     * @return array
     */
    public function getGoods($offset, $limit = 25)
    {
        try {
        $stm = self::$db->prepare("
            select good_name,
                   good_description
            from   php2_goods
            order  by id
            limit  {$limit} offset {$offset};
        ");
        $stm->execute();
        } catch (PDOException $e) {
            echo 'Ошибка при выполнении запроса: ' . $e->getMessage();
        }
        return $stm->fetchAll();
    }
    
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}
