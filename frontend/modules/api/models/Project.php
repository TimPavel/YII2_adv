<?php

namespace frontend\modules\api\models;

use Yii;
use \common\models\Task;


class Project extends \common\models\Project
{
    const RELATION_TASK = 'task';
    public function fields()
    {
        return ['id',
            'title',
            'description_short' => function($model) {
                return mb_substr($model->description, 0, 50);
            },
            'active',
        ];
    }
    
    public function extraFields()
    {
        return [self::RELATION_TASK];
    }

}
