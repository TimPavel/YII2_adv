<?php

namespace frontend\modules\api\models;

use Yii;
use \common\models\Project;

/**
 * This is the model class for table "task".
 *
 */
class Task extends \common\models\Task
{
    const RELATION_PROJECT = 'project';
    
    public function fields()
    {
//        fields - id, title, description_short (обрезанный до 50 символов description); extrafields - project
        return ['id',
            'title',
            'description_short' => function($model) {
                return mb_substr($model->description, 0, 50);
            },
        ];
    }
    
    public function extraFields()
    {
        return [self::RELATION_PROJECT];
    }

}
