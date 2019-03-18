<?php

namespace common\services;

use Yii;
use yii\base\Component;

class NotificationService extends Component
{

    public function informAboutNewRole($user, $project, $role){

        $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
        $data = ['user' => $user, 'project' => $project, 'role' => $role];

        \Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('New role')
            ->send();
    }

}