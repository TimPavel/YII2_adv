<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'emailService' => [
          'class' => \common\services\EmailService::class,
        ],
        'notificationService' => [
            'class' => \common\services\NotificationService::class,
        ],
        'projectService' => [
            'class' => \common\services\ProjectService::class,
            'on '.\common\services\ProjectService::EVENT_ASSIGN_ROLE => function(\common\services\AssignRoleEvent $e) {
//                Yii::info(\common\services\ProjectService::EVENT_ASSIGN_ROLE, '_');

                Yii::$app->notificationService->informAboutNewRole($e->user, $e->project, $e->role);
            },
        ],
        'taskService' => [
            'class' => \common\services\TaskService::class,
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],
        ],

    ],
    'modules' => [
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
        'chat' => common\modules\chat\Module::class,

    ],
];
