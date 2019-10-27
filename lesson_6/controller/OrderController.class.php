<?php

class OrderController extends Controller
{
    public $view = 'order';
    
    /**
     * Добавить товар в корзину
     * 
     * @return json
     */
    public function add()
    {   
        $_GET['asAjax'] = true;
        $result = [
            'result' => 0
        ];
        if (isset($_POST['id_good'])) {
            Basket::addGood($_POST['id_good']);
            $result['result'] = 1;
        }
        return json_encode($result);
    }
    
    /**
     * Получить товары корзины
     * 
     * @param mixed $data
     * @return array
     */
    public function basket($data)
    {
        return Basket::getBasket();
    }
    
    /**
     * Получить информацию о размере корзины
     * 
     * return string
     */
    public function basketSize()
    {
        $_GET['asAjax'] = true;
        $size = Basket::getBasketSize();
        if ($size > 0) {
            return json_encode(['basketText' => "Корзина ($size)"]);
        }
        return ['basketText' => json_encode('Корзина')];
    }

    /**
     * Оформить заказ
     * 
     * @param mixed $data
     * 
     * @return array
     */
    public function create($data)
    {
        if (isset($_POST['fio']) && isset($_SESSION['basket'])) {
            $order_id = Order::addOrder($_POST['fio'], $_POST['phone']);
            foreach ($_SESSION['basket'] as $good) {
                $id = Order::addOrderGood(
                    $order_id, 
                    $good['id_good'],
                    $good['quantity']
                );
            }
            unset($_SESSION['basket']);
            return [
                'order' => 'Заказ успешно оформлен. Номер заказа: ' . $order_id
            ];
        }
        return ['order' => 'При оформлении заказа произошла ошибка'];
    }
}