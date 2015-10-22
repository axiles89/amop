<?php
/**
 * GetProfilerList.php
 *
 * @package app\models\amop\models\ListProfiler\command
 * @date: 22.10.2015 13:44
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\models\ListProfiler\command;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Команда получения списка профайлера проектов для меню
 * Class GetProfilerList
 * @package app\models\amop\models\ListProfiler\command
 */
class GetProfilerList extends BaseCommand
{
    /**
     * Время жизни кеша
     */
    const CACHE_TIME = 2000;

    /**
     * @var
     */
    protected $data;

    /**
     * @return array
     */
    public function execute()
    {
        if (!isset($this->data) or !isset($this->classModel)) {
            throw new \BadFunctionCallException("Please set data and classmodel for command");
        }

        $profiler = [];
        foreach ($this->data as $value) {

            // Если есть данные в кеше по проекту, то берем оттуда
            if ($this->getCacheComponents()->hexists("list-profiler-project", $value)) {
                $list = $this->getCacheComponents()->hget("list-profiler-project", $value);
                $list = Json::decode($list);
            } else {

                $model = $this->getClassModel();
                $list = $model::find()->where(['project_id' => $value])->asArray()->all();

                // Сохраняем профайлеры в кеш (в хеш, где ключ = id проекта)
                $this->getCacheComponents()->multi();
                $this->getCacheComponents()->hset("list-profiler-project", $value, Json::encode($list));
                $this->getCacheComponents()->expire("list-profiler-project", self::CACHE_TIME);
                $this->getCacheComponents()->exec();
            }

            $profiler = ArrayHelper::merge($profiler, $list);
        }

        return $profiler;
    }

    /**
     * @param mixed $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }



}