<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use frontend\modules\api\models\Project;

/**
 * Project controller for the `api` module
 */
class ProjectController extends ActiveController
{
    public $modelClass = Project::class;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    
    }
    
        
    
}
