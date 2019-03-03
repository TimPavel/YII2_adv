<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\User;

/**
 * User controller for the `api` module
 */
class UserController extends ActiveController
{
    public $modelClass = User::class;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    
    }
    
        
    
}
