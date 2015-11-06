<?php
/**
 * ProfilerCountData.php
 *
 * @package app\models\amop\commands\countData
 * @date: 05.11.2015 22:58
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\countData;


use yii\helpers\ArrayHelper;

/**
 * Class ProfilerCountData
 * @package app\models\amop\commands\countData
 */
class ProfilerCountData extends BaseCommand
{
    /**
     * @return mixed
     */
    public function getCount()
    {
        $table = \app\models\amop\models\Profiler::tableName();
        if (is_array($this->_data)) {

            if (count($this->_data) <= 0) {
                return [];
            }

            $where = [];
            foreach ($this->_data as $key => $value) {
                $where[] = "([[message_id]] = {$key} AND [[date_create]] > '{$value}')";
            }

            $where = implode(" OR ", $where);
            $data = \Yii::$app->db->createCommand("SELECT [[message_id]], count(*) as total FROM {{{$table}}} WHERE $where GROUP BY [[message_id]] ")->queryAll();

            $result = ArrayHelper::map($data, 'message_id', 'total');
        } else {
            throw new \InvalidArgumentException('Please set data as array');
        }

        return $result;
    }

}