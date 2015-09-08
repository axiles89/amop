<?php

use yii\db\Migration;

/**
 * Добавление поля для авторизации по cookie
 * Class m150908_173949_auth_key_user
 */
class m150908_173949_auth_key_user extends Migration
{
    public function up()
    {
        $this->addColumn("user", "auth_key", 'varchar(50)');
    }

    public function down()
    {
        $this->dropColumn("user", "auth_key");

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
