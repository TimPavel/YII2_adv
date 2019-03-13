<?php
namespace common\services;

use Yii;
use common\models\Project;
use common\models\User;
use yii\base\Event;

class AssignRoleEvent extends Event
{
    public $project;
    public $user;
    public $role;

    public function dump()
    {
        return ['project' => $this->project->id, 'user' => $this->user->id, 'role' => $this->role];
    }
}

class ProjectService extends \yii\base\Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';

    public function assignRole(Project $project, User $user, $role){
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
//        print_r($event); exit();
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }
}