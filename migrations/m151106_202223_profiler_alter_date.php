<?php

use yii\db\Migration;


/**
*Migration date integer->bigInteger
*/
class m151106_202223_profiler_alter_date extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->alterColumn("profiler", 'time_start', $this->bigInteger(15));
        $this->alterColumn("profiler", 'time_end', $this->bigInteger(15));
    }

    public function safeDown()
    {
       $this->alterColumn("profiler", 'time_start', $this->integer());
       $this->alterColumn("profiler", 'time_end', $this->integer());
       return true;
    }
    
}
