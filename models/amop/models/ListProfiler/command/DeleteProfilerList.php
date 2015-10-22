<?php
/**
 * DeleteProfilerList.php
 *
 * @package app\models\amop\models\ListProfiler\command
 * @date: 22.10.2015 15:19
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\models\ListProfiler\command;


/**
 * Команда удаления списка профайлеров из кеша по номеру проекта
 * Class DeleteProfilerList
 * @package app\models\amop\models\ListProfiler\command
 */
class DeleteProfilerList extends BaseCommand
{
    /**
     * @var
     */
    protected $data;

    /**
     * @return mixed
     */
    public function execute()
    {
        if (!isset($this->data) or !is_int($this->data)) {
            throw new \BadFunctionCallException("Please set int data for command");
        }

        $result = $this->getCacheComponents()->hdel('list-profiler-project', $this->data);
        return $result;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}