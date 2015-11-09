<?php
/**
 * ProfilerActiveDate.php
 *
 * @package app\models\amop\commands\lastActiveDate
 * @date: 05.11.2015 20:22
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\lastActiveDate;


/**
 * Команда для работы с датой последнего просмотра профайлеров пользователя
 * Class ProfilerActiveDate
 * @package app\models\amop\commands\lastActiveDate
 */
class ProfilerActiveDate extends BaseCommand
{
    /**
     * Сохранение даты последнего просмотра
     * @return mixed
     */
    public function save()
    {
        if (!isset($this->_userId)) {
            throw new \InvalidArgumentException('Please set userId');
        }

        if (is_array($this->_data)  and count($this->_data) > 0) {

            $data = ["last-active-date-profiler-{$this->_userId}"];

            // Сохранение даты последнего обновления для массива профайлеров
            foreach ($this->_data as $value) {
                $data[] = $value;
                $data[] = $this->_activeDate;
            }

            $result = \Yii::$app->redis->executeCommand('hmset', $data);
            return true;

        } elseif (is_int($this->_data)){
            $result = \Yii::$app->redis->hset("last-active-date-profiler-{$this->_userId}", $this->_data, $this->_activeDate);
            return true;
        } else {
            throw new \InvalidArgumentException('Please set data as int or array');
        }

        return false;
    }

    /**
     * Получение даты последнего просмотра
     * @return mixed
     */
    public function get()
    {
        if (!isset($this->_userId)) {
            throw new \InvalidArgumentException('Please set userId as int');
        }

        $result = [];

        if (is_array($this->_data)) {

            if (count($this->_data) <= 0) {
                return $result;
            }
            $data = ["last-active-date-profiler-{$this->_userId}"];
            $data = array_merge($data, $this->_data);

            $data = \Yii::$app->redis->executeCommand('hmget', $data);

            foreach ($data as $keyResult => $valueResult) {
                $result[$this->_data[$keyResult]] = $valueResult;
            }

            return $result;

        } elseif (is_int($this->_data)){
            $data = \Yii::$app->redis->hget("last-active-date-profiler-{$this->_userId}", $this->_data);
            $result[$this->_data] = $data;
            return $result;
        } else {
            throw new \InvalidArgumentException('Please set data as int or array');
        }

        return false;
    }

    /**
     * Удаление даты последнего просмотра
     * @return mixed
     */
    public function delete()
    {
        if (!isset($this->_userId)) {
            throw new \InvalidArgumentException('Please set userId as int');
        }

        $result = [];

        if (is_array($this->_data)) {

            if (count($this->_data) <= 0) {
                return true;
            }

            $data = ["last-active-date-profiler-{$this->_userId}"];
            $data = array_merge($data, $this->_data);

            $result = \Yii::$app->redis->executeCommand('hdel', $data);

            return true;

        } elseif (is_int($this->_data)){
            $result = \Yii::$app->redis->hdel("last-active-date-profiler-{$this->_userId}", $this->_data);
            return true;
        } else {
            throw new \InvalidArgumentException('Please set data as int or array');
        }

        return false;
    }


}