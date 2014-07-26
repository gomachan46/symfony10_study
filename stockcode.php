<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: g-nakanishi
 * Date: 2014/07/26
 * Time: 15:50
 */

$app->get('/', function() use ($toys) {
    return json_encode($toys);
});

$app->get('/{stockcode}', function (Silex\Application $app, $stockcode) use ($toys) {
    if (!isset($toys[$stockcode])) {
        $app->abort(404, "Stockcode {$stockcode} does not exist.");
    }

    return json_encode($toys[$stockcode]);
});

$app->post('/', function (Silex\Application $app, Request $request) {
     $name = $request->get('name');
     $quantity = $request->get('quantity');
     $description = $request->get('description');
     $image = $request->get('image');

     // Code to add the toy into the toy db
     // and return a toy id
     //$toy_id = create_toy($name, $quantity, $description, $image);
     //$toy = get_toy($toy_id);

     // For now lets just assume we have saved it
     $toy = array(
         '00003' => array(
             'name' => $name,
             'quantity' => $quantity,
             'description' => $description,
             'image' => $image,
         )
     );

     // Useful to return the newly added details
     // HTTP_CREATED = 201
     return new Response(json_encode($toy), Response::HTTP_CREATED);
 });

function deleteToy($toyId)
{
    return true;
}

$app->delete('/{toyId}', function (Silex\Application $app, Request $request, $toyId) {

     if (deleteToy($toyId)) {
         // The delete went ok and we can now return a no content value
         // HTTP_NO_CONTENT = 204
         $responseMessage = '';
         $responseCode = Response::HTTP_NO_CONTENT;
     } else {
         // Something went wrong
         // HTTP_INTERNAL_SERVER_ERROR = 500
         $responseMessage = 'reason for error';
         $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
     }

     return new Response($responseMessage, $responseCode);
 });

$app->match('/{stockcode}/image', function (Silex\Application $app, $stockcode) use ($toys) {
    if (!isset($toys[$stockcode])) {
        $app->abort(404, "Stockcode {$stockcode} does not exist.");
    }

    return json_encode($toys[$stockcode]['image']);
})->method('GET|POST');