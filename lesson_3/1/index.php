<?php
include_once 'models/config.php';
include_once 'models/photo.php';
include_once 'models/Db.php';
include_once 'models/Render.php';

$dbh = Db::getConnection();
$images = $dbh->getImages();

$render = new Render();
$content = $render->renderTemplate(
    'index.tmpl',
    ['images' => $images, 'message' => $message, 'small' => PHOTO_SMALL]
);
echo $content;