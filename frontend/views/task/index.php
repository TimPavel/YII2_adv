<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Task;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //\yii\helpers\VarDumper::dump($searchModel, 10, true);
    //$form->field($model, 'project_id')->dropDownList('projects')

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            [
                'label' => 'Project',
                'attribute' => 'project.title',
//                'filter' => \common\models\User::STATUS_LABELS,
            ],
            'title',
            'description:ntext',
            'executor.username:ntext:Executor',
            'started_at:datetime:Started_At',
            'completed_at:datetime:Completed_At',
            'creator.username:ntext:Creator',
            'updater.username:ntext:Updater',
            'created_at:datetime:Created_At',
            'updated_at:datetime:Updated_At',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take}',
                'buttons' => [
                    'take' => function($url,Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], ['data' => [
                            'confirm' => 'Берете задачу?',
                            'method' => 'post',
                        ],]);
                    },

                ],
                'visibleButtons' => [
                    'update' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity,
                        \common\models\ProjectUser::ROLE_MANAGER);
                    },

                    'delete' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity,
                            \common\models\ProjectUser::ROLE_MANAGER);
                    },

                    'take' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity,
                            \common\models\ProjectUser::ROLE_DEVELOPER);
                    },
                ],
            ],

        ],
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'project_id',
            'executor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
