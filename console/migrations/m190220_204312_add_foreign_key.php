<?php

use yii\db\Migration;

/**
 * Class m190220_204312_add_foreign_key
 */
class m190220_204312_add_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    // поля executor_id, creator_id и updater_id связаны с полем id таблицы user - три отдельные метода addForeignKey
    // поля creator_id и updater_id связаны с полем id таблицы user
    // поля user_id связано с полем id таблицы user, project_id с полем id таблицы project
    public function safeUp()
    {
        $this->addForeignKey('fx_task_user1', 'task', ['executor_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user2', 'task', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_task_user3', 'task', ['updater_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user1', 'project', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_project_user2', 'project', ['updater_id'], 'user', ['id']);           
        $this->addForeignKey('fx_projectUser_project', 'project_user', ['project_id'], 'project', ['id']);           
        $this->addForeignKey('fx_projectUser_user', 'project_user', ['user_id'], 'user', ['id']);           
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_task_user1', 'task');
        $this->dropForeignKey('fx_task_user2', 'task');
        $this->dropForeignKey('fx_task_user3', 'task');
        $this->dropForeignKey('fx_project_user1', 'project');
        $this->dropForeignKey('fx_project_user2', 'project');
        $this->dropForeignKey('fx_projectUser_project', 'project_user');
        $this->dropForeignKey('fx_projectUser_user', 'project_user');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190220_204312_add_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
