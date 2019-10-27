<?php

/**
 * Created by PhpStorm.
 * User: apryakhin
 * Date: 29.09.2016
 * Time: 13:13
 */
class Basket extends Model
{
    /**
     * Добавить товар в корзину
     * 
     * @param int $id Идентификатор товара
     */
    public static function addGood($id)
    {
        $basket = [];
        if (isset($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
        }
        if (
            ($index = array_search(
                $_POST['id_good'], 
                array_column($basket, 'id_good')
            )) !== false
        ) {
            $basket[$index]['quantity'] += 1;
        } else {
            $basket[] = [
                'id_good' => $_POST['id_good'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => 1
            ];
        }
        $_SESSION['basket'] = $basket;
    }
    
    /**
     * Получить все товары корзины
     * 
     * @return array
     */
    public static function getBasket()
    {
        $basket = [];
        if (isset($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
        }
        return $basket;
    }
    
    /**
     * Получить количество товаров в корзине
     * 
     * @return int
     */
    public static function getBasketSize()
    {
        $basket = [];
        if (isset($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
        }
        return count($basket);
    }
}