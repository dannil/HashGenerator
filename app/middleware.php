<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// $app->add(new \Slim\HttpCache\Cache('cache', 86400));

// $app->add(new \RKA\SessionMiddleware(['name' => 'hash']));

// Add error middleware
$app->addErrorMiddleware(true, true, true);
