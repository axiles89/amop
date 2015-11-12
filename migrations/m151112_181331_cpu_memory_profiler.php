<?php

use yii\db\Migration;

/**
 * Add column for profiler cpu and memory
 * Class m151112_181331_cpu_memory_profiler
 */
class m151112_181331_cpu_memory_profiler extends Migration
{
    public function safeUp()
    {
        $this->addColumn("profiler", "memory", $this->bigInteger());
        $this->addColumn("profiler", "memory_start", $this->bigInteger());
        $this->addColumn("profiler", "memory_end", $this->bigInteger());

        $this->addColumn("profiler", "cpu", $this->bigInteger());
        $this->addColumn("profiler", "cpu_start", $this->bigInteger());
        $this->addColumn("profiler", "cpu_end", $this->bigInteger());
    }

    public function safeDown()
    {
        $this->dropColumn("profiler", 'memory');
        $this->dropColumn("profiler", 'memory_start');
        $this->dropColumn("profiler", 'memory_end');

        $this->dropColumn("profiler", 'cpu');
        $this->dropColumn("profiler", 'cpu_start');
        $this->dropColumn("profiler", 'cpu_end');
    }
}
