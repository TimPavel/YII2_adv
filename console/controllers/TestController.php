<?php
namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;


class TestController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->stdout('console');
        return ExitCode::OK;
    }

    /**
     * Displays Hello World page.
     *
     * @return mixed
     */
    public function actionHelloWorld()
    {
        $this->stdout("Hello world".PHP_EOL);
        return ExitCode::OK;
    }
    
}
