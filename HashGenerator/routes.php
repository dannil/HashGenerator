<?php
// Routes

$app->get('/', 'HashGenerator\Controller\IndexController:index')->setName('index');
$app->post('/hash', 'HashGenerator\Controller\IndexController:hash')->setName('hash');
