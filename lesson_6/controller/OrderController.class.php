<?php

class OrderController extends Controller
{
    public $view = 'order';
    
    public function add()
    {   
        $_GET['asAjax'] = true;
        
        $result = [
            'result' => 0
        ];
        if (isset($_POST['id_good'])) {
            $basket = [];
            if (isset($_SESSION['basket'])) {
                $basket = $_SESSION['basket'];
            }
            if (($index = array_search($_POST['id_good'], array_column($basket, 'id_good'))) !== false) {
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
            
            $result['result'] = 1;
        }
        
        return json_encode($result);
    }
    
    public function basket($data)
    {
        $basket = [];
        if (isset($_SESSION['basket'])) {
            $basket = $_SESSION['basket'];
        }
        return $basket;
    }
    
    public function create($data)
    {
        if (isset($_POST['fio']) && isset($_SESSION['basket'])) {
            $order_id = db::getInstance()->insert(
                "insert into orders (fio, phone) values (:fio, :phone)",
                [':fio' => $_POST['fio'], ':phone' => $_POST['phone']]
            );
            foreach ($_SESSION['basket'] as $good) {
                $id = db::getInstance()->insert(
                    "insert into order_goods (id_order, id_good, quantity) values (:id_order, :id_good, :quantity)",
                    [':id_order' => $order_id, ':id_good' => $good['id_good'], ':quantity' => $good['quantity']]
                );
            }
            unset($_SESSION['basket']);
            return ['order' => 'Заказ успешно оформлен. Номер заказа: ' . $order_id];
        }
        return ['order' => 'При оформлении заказа произошла ошибка'];
    }
    
    
    /*public function add(){
        $_GET['asAjax'] = true;

        $result = [
            'result' => 0
        ];

        $id_good = (int)$_POST['id_good'];
        if($id_good > 0){
            $basket = new Basket();
            $basket->setIdGood($id_good);
            $basket->setPrice(Good::getGoodPrice($id_good));
            $basket->save();

            $result['result'] = 1;
        }

        return json_encode($result);
    }*/
}