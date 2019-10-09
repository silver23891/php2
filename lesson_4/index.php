<?php
include 'models/Render.php';

$render = new Render();
echo $render->renderTemplate('index.tmpl');