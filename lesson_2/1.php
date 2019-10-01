<?php

/**
 * Товар
 */
abstract class Good
{
	/** @var float Базовая стоимость товара */
	private $price;

	/**
	 * Получить базовую стоимость товара
	 * 
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Задать базовую стоимость товара
	 *
	 * @param $price float Стоимость товара
	 * 
	 * @return void
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * Конструктор
	 * 
	 * @param $price float Стоимость товара
	 * 
	 * @return void
	 */
	public function __construct($price)
	{
		$this->setPrice($price);
	}

	/**
	 * Получить финальную стоимость товара
	 * 
	 * @return float
	 */
	abstract public function getCost();

	public function showGain()
	{
		echo 'Прибыль с продажи товара: ' . $this->getCost() . '<hr>';
	}
}

/**
 * Штучный товар
 */
class SingleGood extends Good
{
	/**
	 * Получить финальную стоимость товара
	 * 
	 * @return float
	 */
	public function getCost()
	{
		return $this->getPrice();
	}
}

/**
 * Цифровой товар
 */
class DigitalGood extends Good
{
	/**
	 * Получить финальную стоимость товара
	 * 
	 * @return float
	 */
	public function getCost()
	{
		return $this->getPrice()/2;
	}
}

/**
 * Весовой товар
 */
class WeightGood extends Good
{
	/** @var float Вес товара */
	private $weight;

	/**
	 * Получить вес товара
	 * 
	 * @return float
	 */
	public function getWeight()
	{
		return $this->weight;
	}

	/**
	 * Задать вес товара
	 * 
	 * @param $weight float Вес товара
	 * 
	 * @return void
	 */
	public function setWeight($weight)
	{
		$this->weight = $weight;
	}

	/**
	 * Конструктор
	 * 
	 * @param $price  float Стоимость товара
	 * @param $weight float Вес товара
	 * 
	 * @return void
	 */
	public function __construct($price, $weight)
	{
		$this->setWeight($weight);
		parent::__construct($price);
	}

	/**
	 * Получить финальную стоимость товара
	 * 
	 * @return float
	 */
	public function getCost()
	{
		return $this->getPrice() * $this->getWeight();
	}
}

$sg = new SingleGood(1);
$sg->showGain();

$dg = new DigitalGood(30);
$dg->showGain();

$wg = new WeightGood(10, 0.7);
$wg->showGain();