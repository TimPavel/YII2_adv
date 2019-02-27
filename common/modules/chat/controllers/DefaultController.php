<?php

namespace common\modules\chat\controllers;

use yii\console\Controller;
use common\modules\chat\components\Chat;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    
    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080
        );
        echo 'server start';
        
        $server->run();
    }
}
