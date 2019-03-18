<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $user common\models\User
 * @var $project common\models\Project
 * @var $role string
 */

?>

<div>
    <p>Hi <?= Html::encode($user->username) ?></p>
    <p>In project - <?= $project->title?> , You have a new role - <?= $role ?></p>
</div>
