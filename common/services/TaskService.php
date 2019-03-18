<?php

namespace common\services;

use Yii;
use common\models\Project;
use common\models\User;
use common\models\Task;
use yii\base\Component;
use common\models\ProjectUser;
use common\services\ProjectService;

class TaskService extends Component
{
    /**
     * Может ли пользователь управлять задачами в проекте
     * @param Project $project
     * @param User $user
     * @return boolean
     */
    public function canManage(Project $project, User $user)
    {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);
    }

    /**
     * Может ли пользователь взять задачу в работу
     * @param Project $project
     * @param Task $task
     * @param User $user
     * @return boolean
     */
    public function canTake(Project $project, Task $task, User $user)
    {

        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_DEVELOPER)
            && $task->executor_id === null;
    }

    /**
     * Can user to complete the task
     * @param Task $task
     * @param User $user
     * @return bool
     */
    public function canComplete(Task $task, User $user)
    {
        return $task->executor_id === $user->id && $task->completed_at === null;
    }

    /**
     * @param Task $task
     * @param User $user
     */
    public function takeTask(Task $task, User $user)
    {
        $task->started_at = time();
        $task->executor_id = $user->id;

        if ($task->save()) {
            Yii::$app->session->setFlash('success', "Взят в работу");
        } else {
            Yii::$app->session->setFlash('warning', "Что-то пошло не так...");
        }
    }

    /**
     * @param Task $task
     */
    public function completeTask(Task $task)
    {
        $task->completed_at = time();

        if ($task->save()) {
            Yii::$app->session->setFlash('success', "Успешно сохранено");
        } else {
            Yii::$app->session->setFlash('warning', "Что-то пошло не так...");
        }
    }
}
