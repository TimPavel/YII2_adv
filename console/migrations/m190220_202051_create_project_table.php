<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m190220_202051_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    // id - integer, primaryKey
    // title - varchar(255), not null
    // description - text, not null
    // active - bit (boolean), not null, DEFAULT '0'
    // creator_id - integer, not null
    // updater_id - integer, null
    // created_at - integer, not null
    // updated_at - integer, null
    // поля creator_id и updater_id связаны с полем id таблицы user
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue('0'),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
        return true;
    }
}
