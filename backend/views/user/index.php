<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => \common\models\User::STATUS_LABELS,
                'content' => function(\common\models\User $model) {
                    return \common\models\User::STATUS_LABELS[$model->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Created',
                'format' => ['datetime', 'php:Y-m-d h:i:s'],
            ],
            //'updated_at',
            //'access_token',
            //'avatar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
        'model' => $model,
    ]); ?>

    <?php Pjax::end(); ?>
</div>
