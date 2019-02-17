<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/transits', function(Request $request, Response $response){
    $this->logger->info('fetch all data');
    $transit = new Transit($this->db);
    $data = $transit->getTransits();
    $response = $this->view->render($response,'transits.phtml',['transits' => $data]);
    //die(var_dump($data));

    return $response;
})->setName('transits');


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});