<?php 
include 'Db.php';
include 'Render.php';

if (isset($_GET['offset'])) {
	$db = Db::getConnection();
	$goods = $db->getGoods($_GET['offset']);
	$render = new Render();
	$out = $render->renderTemplate('goods.tmpl', ['goods' => $goods]);
	echo $out;
}

?>