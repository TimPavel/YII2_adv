<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_user}}`.
 */
class m190220_202125_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    // id - integer, primaryKey
    // project_id - integer, not null
    // user_id - integer, not null
    // role - enum ('manager', 'developer', 'tester'),* спец. метода в миграциях для типа enum нет, описывается просто SQL кодом*
    // поля user_id связано с полем id таблицы user, project_id с полем id таблицы project
    public function safeUp()
    {
        $this->createTable('{{%project_user}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => "ENUM('manager', 'developer', 'tester')",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_user}}');
        return true;
    }
}
