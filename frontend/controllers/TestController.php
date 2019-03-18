<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Test controller
 */
class TestController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::class,
                 'only' => ['logout', 'signup'],
                 'rules' => [
                     [
                         'actions' => ['signup'],
                         'allow' => true,
                         'roles' => ['?'],
                     ],
                   
                 ],
             ],
             'verbs' => [
                 'class' => VerbFilter::class,
                 'actions' => [
                     'logout' => ['post'],
                 ],
             ],
         ];
     }

    /**
     * {@inheritdoc}
     */

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays Hello World page.
     *
     * @return mixed
     */
    public function actionHelloWorld()
    {
        return $this->render('helloWorld');
    }
    
}
