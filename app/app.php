<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

use Models\Item;
use Lib\Redis;

/**
 * Add your routes here
 */
$app->map('/', function () use ($app) {
    $app->response->setStatusCode(200);
    $app->response->setJsonContent("Almost there, try /products", JSON_UNESCAPED_SLASHES);
    $app->response->send();
});


$app->get("/users/:id", function() use ($app) {
});

$app->post("/products", function () use ($app) {
    $data = $app->request->getJsonRawBody();
    if(Item::insert($data))
    {
        $app->response->setStatusCode(200);
        $app->response->setJsonContent(["status" => "success", "message" => "successfully added new item ". $data->itemName ." for user " . $data->userId]);
        $app->apiLogger->info("Successfully inserted new item ". $data->itemName ." for user " . $data->userId);
    } else {
        $app->response->setStatusCode(500);
        $app->response->setJsonContent(["status" => "error", "message" => "error while inserting"]);
    }
    $app->response->send();
})->beforeMatch(
    function() use ($app)
    {
        $data = $app->request->getJsonRawBody();
        if(!isset($data->userId) || !isset($data->itemName))
        {
            $app->response->setStatusCode(400, "Bad Request");
            $app->response->setJsonContent(["status" => "error", "message" => "Invalid request, parameter(s) missing."]);
            return false;
        }
        return true;
    }
);

$app->get("/products", function () use ($app) {
    $app->response->setStatusCode(200);
    $app->response->setJsonContent(Item::getAll());

    $app->apiLogger->info("Accessed /products using get");
    $app->response->send();
});