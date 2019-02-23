<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m190220_201437_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
//     id - integer, primaryKey
// title - varchar(255), not null
// description - text, not null
// project_id - integer, null, новое поле
// executor_id - integer, null, новое поле
// started_at - integer, null, новое поле
// completed_at - integer, null, новое поле
// creator_id - integer, not null
// updater_id - integer, null
// created_at - integer, not null
// updated_at - integer, null
// поля executor_id, creator_id и updater_id связаны с полем id таблицы user - три отдельные метода addForeignKey
    public function safeUp()
    {
         $this->createTable('{{%task}}', [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'project_id' => $this->integer(),
                'executor_id' => $this->integer(),
                'started_at' => $this->integer(),
                'completed_at' => $this->integer(),
                'creator_id' => $this->integer()->notNull(),
                'updater_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
        return true;
    }
}
