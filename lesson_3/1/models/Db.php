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
                    'mysql:host=db;dbname=gallery', 
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
     * Получить список путей до изображений
     * 
     * @return array
     */
    public function getImages()
    {
        try {
        $stm = self::$db->prepare("
            select *
            from   images
        ");
        $stm->execute();
        } catch (Exception $e) {
            echo 'Ошибка при выполнении запроса: ' . $e->getMessage();
        }
        return $stm->fetchAll();
    }
    
    /**
     * Добавить запись об изображении
     * 
     * @param string $filename
     * @param string $description
     * 
     * @return void
     */
    public function addImage($filename, $description)
    {
        try {
            $stm = self::$db->prepare("
                insert into images (img_path, img_description)
                values (:filename, :description)
            ");
            $stm->execute(
                [':filename' => $filename, ':description' => $description]
            );
        } catch (Exception $e) {
            echo 'Не удалось сохранить запись: ' . $e->getMessage();
        }
    }
    
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}
