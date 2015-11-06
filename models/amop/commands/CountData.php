<?php
/**
 * CountData.php
 *
 * @package app\models\amop\commands
 * @date: 06.11.2015 21:56
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands;


/**
 * Class CountData
 * @package app\models\amop\commands
 */
class CountData
{
    /**
     * Type profiler
     */
    const TYPE_PROFILER = 1;

    /**
     * @var array
     */
    protected static $_typeList = [
        self::TYPE_PROFILER => "app\\models\\amop\\commands\\countData\\ProfilerCountData"
    ];

    /**
     * @param $type
     * @return mixed
     */
    public static function getModel($type) {
        if (array_key_exists($type, self::$_typeList)) {
            $class = self::$_typeList[$type];
            $model = new $class;
            return $model;
        } else {
            throw new \InvalidArgumentException("Type model in incorrect");
        }
    }

}