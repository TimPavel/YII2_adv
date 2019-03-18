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

/**
 * Class ProjectService
 * @package common\services
 */
class ProjectService extends \yii\base\Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';

    public function assignRole(Project $project, User $user, $role){
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }

    public function getRoles(Project $project, User $user)
    {
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }

    public function hasRole(Project $project, User $user, $role)
    {
       return in_array($role, $this->getRoles($project, $user));
    }
}