<?php

use yii\db\Migration;

/**
 * Таблица данных профайлера
 * Class m150929_171800_profiler
 */
class m150929_171800_profiler extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        }

        if ($this->db->schema->getTableSchema('profiler', true) === null) {
            $this->createTable("profiler", [
                'id' => $this->primaryKey(),
                'date_create' => $this->dateTime(),
                'date_update' => $this->dateTime(),
                'project_id' => $this->integer()->notNull(),
                'type' => $this->integer()->notNull(),
                'message' => $this->text()->notNull(),
                'duration' => $this->integer()->notNull(),
                'time_start' => $this->integer(),
                'time_end' => $this->integer(),
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('profiler');

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
