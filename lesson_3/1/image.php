<?php
include_once 'models/config.php';
include_once 'models/photo.php';
include_once 'models/Db.php';
include_once 'models/Render.php';

$image = PHOTO . $_GET['photo'];

$render = new Render();
$content = $render->renderTemplate(
    'image.tmpl',
    ['image' => $image]
);
echo $content;