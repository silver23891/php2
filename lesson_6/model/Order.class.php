<?php

class Order extends Model {
    protected static $table = 'orders';

    protected static function setProperties()
    {
        self::$properties['phone'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['fio'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        /*self::$properties['email'] = [
            'type' => 'float'
        ];*/
    }
    
    /**
     * Сохранить заказ в БД
     * 
     * @param string $fio   ФИО покупателя
     * @param string $phone Телефон покупателя
     * @return int Номер заказа
     */
    public static function addOrder($fio, $phone)
    {
        return db::getInstance()->insert(
            "insert into ". self::$table ." (fio, phone) values (:fio, :phone)",
            [':fio' => $fio, ':phone' => $phone]
        );
    }
    
    /**
     * Добавить товар к заказу
     * 
     * @param int $order_id Номер заказа
     * @param int $id_good  Идентификатор товара
     * @param int $quantity Количество
     * 
     * @return int
     */
    public static function addOrderGood($order_id, $id_good, $quantity)
    {
        return db::getInstance()->insert(
            "insert into order_goods (id_order, id_good, quantity) "
            . "values (:id_order, :id_good, :quantity)",
            [
                ':id_order' => $order_id, 
                ':id_good' => $id_good, 
                ':quantity' => $quantity
            ]
        );
    }
}