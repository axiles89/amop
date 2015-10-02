<?php

use yii\db\Migration;

/**
 * Таблица списка сообщений профайлера (справочник)
 * Class m151002_163403_list_profiler_message
 */
class m151002_163403_list_profiler_message extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        }

        if ($this->db->schema->getTableSchema('list_profiler', true) === null) {
            $this->createTable("list_profiler", [
                'id' => $this->primaryKey(),
                'date_create' => $this->dateTime(),
                'date_update' => $this->dateTime(),
                'project_id' => $this->integer()->notNull(),
                'message' => $this->text()->notNull()
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('list_profiler');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
