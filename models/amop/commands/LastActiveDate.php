<?php
/**
 * LastActiveDate.php
 *
 * @package app\models\amop\commands
 * @date: 05.11.2015 22:35
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands;


use app\models\amop\commands\lastActiveDate\ProfilerActiveDate;

/**
 * Factory LastActiveDate model
 * Class LastActiveDate
 * @package app\models\amop\commands
 */
class LastActiveDate
{
    /**
     * Type profiler
     */
    const TYPE_PROFILER = 1;

    /**
     * @var array
     */
    protected static $_typeList = [
        self::TYPE_PROFILER => "app\\models\\amop\\commands\\lastActiveDate\\ProfilerActiveDate"
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