<?php

use yii\db\Migration;

class m150904_201431_User extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        }

        if ($this->db->schema->getTableSchema('user', true) === null) {
            $this->createTable("user", [
                'id' => $this->primaryKey(),
                'date_create' => $this->dateTime(),
                'login' => $this->string(10),
                'password' => $this->text(),
                'name' => $this->string(20),
                'surname' => $this->string(30),
                'email' => $this->string(20),
                'avatar' => $this->string(20)
            ]);
        }

    }

    public function down()
    {
        $this->dropTable('user');
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
