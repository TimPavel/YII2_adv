<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(
            [
                'options' => ['enctype' => 'multipart/form-data'],
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'horizontalCssClasses' => ['label' => 'col-sm-2',]
                ],
            ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')
        ->fileInput(['accept' => 'image/*'])
        ->label(Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_ICO)))
    ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\User::STATUS_LABELS) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
