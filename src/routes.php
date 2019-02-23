<?php

use Slim\Http\Request;
use Slim\Http\Response;

/*
$app->get('/transits', function(Request $request, Response $response){
    $this->logger->info('fetch all data');
    $transit = new Transit($this->db);
    $data = $transit->getTransits();
    $response = $this->view->render($response,'endpoint.phtml',['results' => $data]);
    return $response;
})->setName('transits');
*/

$app->post('/transits', function (Request $request, Response $response)
{
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
    $startDate = $args['start_date'];
    $endDate = $args['end_date'];
    $myTransit = new Transit($this->db);
    $results = $myTransit->getReport($startDate, $endDate);

    $response = $this->view->render($response,'endpoint.phtml',['results' => $results]);
    return $response;
});

$app->get('/reports/monthly', function(Request $request, Response $response){
    $myTransit = new Transit($this->db);
    $results = $myTransit->getMonthlyReport();

    $myTimeRefactor = new TimeRefactor($results);
    $results = $myTimeRefactor->getMonthDay();

    $response = $this->view->render($response, 'endpoint.phtml', ['results' => $results]);
    return $response;
});

/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/