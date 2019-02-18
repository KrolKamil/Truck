<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

/*
 *
 *  $data = $request->getParsedBody();
    $task_data = [];
    $task_data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    if($task_data['name'] !="")
    {
        $task = new TaskEntity($task_data);
        $task_mapper = new TaskMapper($this->db);
        $task_mapper->addTask($task);
    }
    $response = $response->withRedirect($this->router->pathFor('task-show'));
    return $response;
 */

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
    //some kind of filter needed i guess ?
    //$sourceAddress, $destinationAddress, $price, $date
    $data = $request->getParsedBody();
    $sourceAddress = $data['source_address'];
    $destinationAddress = $data['destination_address'];
    $price = $data['price'];
    $date = $data['date'];

    $myTransit = new Transit($this->db);
    $myTransit->addTransit($sourceAddress,$destinationAddress, $price, $date);
});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});