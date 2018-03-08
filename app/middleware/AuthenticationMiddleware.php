<?php
/**
 * Created by PhpStorm.
 * User: Rich
 * Date: 3/7/2018
 * Time: 8:28 PM
 */

namespace Middleware;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;
use Phalcon\Events\Event;
use Lib\Redis;

class AuthenticationMiddleware implements MiddlewareInterface
{
    public function beforeHandleRoute(Event $event, Micro $app)
    {
        $client = new Redis();

        if ($client->exists($app->request->getClientAddress()))
        {
            return true;
        }

        if($app->request->getHeader("Authentication"))
        {
            if ($app->request->getHeader("Authentication") == "1234")
            {
                $client->set($app->request->getClientAddress(), 1, "ex", 600);
                return true;
            }
        }

        $app->response->setStatusCode(401);
        $app->response->setJsonContent(["status" => "error", "message" => "Authentication denied."]);

        $app->response->send();
        return false;
    }

    /**
     * Calls the middleware
     *
     * @param Micro $application
     *
     * @returns bool
     */
    public function call(Micro $app)
    {
        return true;
    }
}