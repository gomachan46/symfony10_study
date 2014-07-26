<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/vendor/autoload.php';

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

$app->run();
