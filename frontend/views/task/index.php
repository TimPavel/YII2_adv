<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Task;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Project;

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


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            [
                'label' => 'Project',
                'attribute' => 'project',
                'content' => function($data) {
                    return Html::a($data->project->title, ['project/view', 'id' => $data->project->id]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'project_id', Project::find()
                    ->select('title')
                    ->indexBy('id')
                    ->column()),

//                'filter' => Html::activeDropDownList($searchModel, 'project_id', ArrayHelper::map(Project::find()
//                    ->all(), 'id', 'title')),
            ],
            'title',
            'description:ntext',
            [
                'label' => 'Executor',
                'attribute' => 'executor',
                'content' => function($data) {
                    if (isset($data->executor->username)) {
                        return Html::a($data->executor->username, ['user/view', 'id' => $data->executor->id]);
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'executor',  User::find()
                    ->select('username')
                    ->indexBy('id')
                    ->column()),
            ],
            'started_at:datetime:Started_At',
            'completed_at:datetime:Completed_At',

            [
                'label' => 'Creator',
                'attribute' => 'creator',
                'content' => function($data) {
                    return Html::a($data->creator->username, ['user/view', 'id' => $data->creator->id]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'creator', User::find()
                    ->select('username')
                    ->indexBy('id')
                    ->column()),
            ],
            [
                'label' => 'Updater',
                'attribute' => 'updater',
                'content' => function($data) {
                    return Html::a($data->updater->username, ['user/view', 'id' => $data->updater->id]);
                },
            ],
            'created_at:datetime:Created_At',
            'updated_at:datetime:Updated_At',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {complete}',
                'buttons' => [
                    'take' => function($url,Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['task/take', 'id' => $model->id], ['data' => [
                            'confirm' => 'Берете задачу?',
                            'method' => 'post',
                        ],]);
                    },
                    'complete' => function($url,Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('glyphicon glyphicon-check');
                        return Html::a($icon, ['task/complete', 'id' => $model->id], ['data' => [
                            'confirm' => 'Подтверждаете выполнение?',
                            'method' => 'post',
                        ],]);
                    },

                ],
                'visibleButtons' => [
                    'update' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },

                    'delete' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },

                    'take' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->taskService->canTake($model->project, $model, Yii::$app->user->identity);
                    },

                    'complete' => function(\common\models\Task $model, $key, $index) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                ],
            ],

        ],
    ]);
    ?>

    <?php //\yii\helpers\VarDumper::dump($model->project, 10, true);
    //$form->field($model, 'project_id')->dropDownList('projects')

    ?>
    <?php Pjax::end(); ?>
</div>
