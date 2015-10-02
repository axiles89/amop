<?php

use yii\db\Migration;

/**
 * Переименования колонки сообщений профайлера и смена типа
 * Class m151002_163345_rename_profiler_message
 */
class m151002_163345_rename_profiler_message extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->alterColumn("profiler", 'message', $this->integer()->notNull());
        $this->renameColumn('profiler', 'message', 'message_id');
    }

    public function safeDown()
    {
        $this->renameColumn('profiler', 'message_id', 'message');
        return true;
    }

}
