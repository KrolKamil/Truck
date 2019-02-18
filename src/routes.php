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
    //$data = $request->getParsedBody();
});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});