<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/transits', function(Request $request, Response $response){
    $this->logger->info('fetch all data');
    $transit = new Transit($this->db);
    $data = $transit->getTransits();
    $response = $this->view->render($response,'transits.phtml',['transits' => $data]);
    //die(var_dump($data));

    return $response;
})->setName('transits');

$app->post('/transits', function (Request $request, Response $response)
{
    //die(var_dump("ELO"));
    //some kind of filter needed i guess ?
    //$sourceAddress, $destinationAddress, $price, $date
    $data = $request->getParsedBody();
    $sourceAddress = $data['source_address'];
    $destinationAddress = $data['destination_address'];
    $price = $data['price'];
    $date = $data['date'];

    $myMap = new Map();
    $sourceCoord = $myMap->getCoord($sourceAddress);
    $destinationCoord = $myMap->getCoord($destinationAddress);
    $distance = $myMap->getDistance($sourceCoord,$destinationCoord);

    $myTransit = new Transit($this->db);
    $myTransit->addTransit($sourceAddress,$destinationAddress, $price, $distance, $date);
});

$app->get('/reports/range', function (Request $request, Response $response)
{
    $args = $request->getQueryParams();
    $myMap = new Map();
    $source = $myMap->getCoord($args['source_address']);
    $destination = $myMap->getCoord($args['destination_address']);
    $distance = $myMap->getDistance($source, $destination);

});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
