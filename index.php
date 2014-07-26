<?php
require_once __DIR__.'/vendor/autoload.php';

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = new Silex\Application();
// Please set to false in a production environment
$app['debug'] = true;

$toys = array(
    '00001'=> array(
        'name' => 'Racing Car',
        'quantity' => '53',
        'description' => '...',
        'image' => 'racing_car.jpg',
    ),
    '00002' => array(
        'name' => 'Raspberry Pi',
        'quantity' => '13',
        'description' => '...',
        'image' => 'raspberry_pi.jpg',
    ),
);

require(__DIR__ . '/giftcodes.php');
require(__DIR__ . '/stats.php');
require(__DIR__ . '/stockcode.php');

$app->run();
