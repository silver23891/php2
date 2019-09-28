<?php 

/**
 * Посылка
*/
class Post
{
	/** @var int Номер заказа */
	protected $order;
	/** @var float Вес посылки */
	protected $weight;
	/** @var string Адрес получателя */
	protected $address;

	/**
	 * Задать номер заказа
	 * 
	 * @param $order int
	 * 
	 * @return void
	*/
	public function setOrder($order)
	{
		$this->order = $order;	
	}

	/**
	 * Задать вес посылки
	 * 
	 * @param $weight float
	 * 
	 * @return void
	*/
	public function setWeight($weight)
	{
		$this->weight = $weight;	
	}

	/**
	 * Задать адрес получателя
	 * 
	 * @param $address string
	 * 
	 * @return void
	*/
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * Получить номер заказа
	 * 
	 * @return int
	*/
	public function getOrder()
	{
		return $this->order;
	}

	/**
	 * Получить вес посылки
	 * 
	 * @return float
	*/
	public function getWeight()
	{
		return $this->weight;
	}

	/**
	 * Получить адрес получателя
	 * 
	 * @return string
	*/
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Конструктор
	 * 
	 * @param $order   int
	 * @param $weight  float
	 * @param $address string
	 *
	 * @return void
	*/
	public function __construct($order, $weight, $address)
	{
		$this->setOrder($order);
		$this->setWeight($weight);
		$this->setAddress($address);
	}

	/**
	 * Отправить посылку
	 *
	 * @return void
	*/
	public function send()
	{
		echo "Товары по заказу № {$this->order} отправлены по адресу {$this->address}. Вес посылки составляет {$this->weight} кг.<hr>";
	}
}

/**
 * Посылка со страхованием
 * Добавляются методы set/getGoodsCost, изменяется метод send и __construct
*/
class SafePost extends Post
{
	/** @var float Объявленная ценность товатор */
	protected $goodsCost;

	/**
	 * Задать ценность товаров
	 * 
	 * @param $goodsCost float
	 * 
	 * @return void
	*/
	public function setGoodsCost($goodsCost)
	{
		$this->goodsCost = $goodsCost;	
	}

	/**
	 * Получить ценность товаров
	 * 
	 * @return float
	*/
	public function getGoodsCost()
	{
		return $this->goodsCost;
	}

	/**
	 * Конструктор
	 * 
	 * @return void
	*/
	public function __construct($order, $weight, $address, $goodsCost)
	{
		parent::__construct($order, $weight, $address);
		$this->setGoodsCost($goodsCost);
	}

	/**
	 * Отправить застрахованную посылку
	 *
	 * @return void
	*/
	public function send()
	{
		echo "Товары по заказу № {$this->order} отправлены по адресу {$this->address}. Вес посылки составляет {$this->weight} кг. Объявленная ценность товаров: {$this->goodsCost} р.<hr>";	
	}
}


$p = new Post(1, 3.5, 'г. Новосибирск');
$p->send();

$sp = new SafePost(2, 4, 'г. Москва', 2250);
$sp->send();

?>