<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $users common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['enctype' => 'multipart/form-data'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => ['label' => 'col-sm-2',]
            ],
        ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList(\common\models\Project::STATUS_LABELS) ?>


    <?php if(!$model->isNewRecord) : ?>

        <?= $form->field($model, \common\models\Project::RELATION_PROJECT_USERS)->widget(MultipleInput::class, [

//            https://github.com/unclead/yii2-multiple-input
            'id' => 'project',
            'max' => 10,
            'min' => 0,
            'addButtonPosition' => MultipleInput::POS_HEADER,
            'columns' => [
                [
                    'name'  => 'project_id',
                    'type'  => 'hiddenInput',
                    'defaultValue' => $model->id,
                ],
                [
                    'name'  => 'user_id',
                    'type'  => 'dropDownList',
                    'title' => 'User',
                    'items' => $users,
                ],
                [
                    'name'  => 'role',
                    'type'  => 'dropDownList',
                    'title' => 'Role',
                    'items' => \common\models\ProjectUser::ROLE_LABELS,
                ],
            ]
        ]);
        ?>

    <?php endif; ?>

    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
