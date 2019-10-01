<?php

trait getConnection
{
	public static function getConnect()
	{
		if (self::$connect === null) {
			self::$connect = new self;
		}
		return self::$connect;
	}
}

class Db
{
	use getConnection;
	private static $connect;

	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}

$db = Db::getConnect();

?>