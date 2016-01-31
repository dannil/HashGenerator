<?php
// Routes

$app->get('/', 'HashGenerator\Controller\IndexController:index');
$app->post('/hash', 'HashGenerator\Controller\IndexController:hash');
