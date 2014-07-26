<?php
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: g-nakanishi
 * Date: 2014/07/26
 * Time: 15:50
 */

$app->get('/stats', function () use ($toys) {
    return new Response(json_encode($toys), Response::HTTP_OK);
});

$app->get('/stats/{stockcode}', function () use ($toys) {
    return new Response(json_encode($toys), Response::HTTP_OK);
});