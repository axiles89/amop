<?php

use yii\db\Migration;

/**
 * Таблица проектов
 * Class m150916_162444_project_table
 */
class m150916_162444_project_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        }

        if ($this->db->schema->getTableSchema('project', true) === null) {
            $this->createTable("project", [
                'id' => $this->primaryKey(),
                'date_create' => $this->dateTime(),
                'date_update' => $this->dateTime(),
                'title' => $this->text()->notNull(),
                'staff_id' => $this->integer()->notNull(),
                'description' => $this->text(),
                'secret_key' => $this->string(30),
            ]);
        }

    }

    public function down()
    {
        $this->dropTable("project");
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
