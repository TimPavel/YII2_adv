<?php

namespace common\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $active
 * @property int $creator_id
 * @property int $updater_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $creator
 * @property User $updater
 * @property ProjectUser[] $projectUsers
 */
class Project extends \yii\db\ActiveRecord
{
    const RELATION_PROJECT_USERS = 'projectUsers';
    const STATUS_NOTACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_NOTACTIVE,
    ];

    const STATUS_LABELS = [
        self::STATUS_ACTIVE => 'активен',
        self::STATUS_NOTACTIVE => 'неактивен',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class],
            ['class' => BlameableBehavior::class,
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => 'updater_id',
            ],
            'SaveRelationsBehavior' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [self::RELATION_PROJECT_USERS]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'creator_id', 'created_at'], 'required'],
            [['description'], 'string'],
            ['active', 'in', 'range' => self::STATUSES],
            [['active', 'creator_id', 'updater_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['updater_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updater_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'active' => 'Active',
            'creator_id' => 'Creator ID',
            'updater_id' => 'Updater ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::class, ['id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUser::class, ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProjectQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }

    public function getUsersData()
    {
        return $this->getProjectUsers()->select('role')->indexBy('user_id')->column();
    }

}
