<?php
/**
 * BaseCommand.php
 *
 * @package app\models\amop\models\ListProfiler\command
 * @date: 21.10.2015 18:25
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\models\ListProfiler\command;


/**
 * Class BaseCommand
 * @package app\models\amop\models\ListProfiler\command
 */
abstract class BaseCommand implements ICommand
{
    /**
     * @var mixed
     */
    protected $cacheComponents;
    /**
     * @var
     */
    protected $classModel;

    /**
     * BaseCommand constructor.
     * @param $cacheComponents
     */
    public function __construct()
    {
        $this->cacheComponents = \Yii::$app->redis;
    }


    /**
     * @return mixed
     */
    abstract public function execute();

    /**
     * @return mixed
     */
    public function getClassModel()
    {
        return $this->classModel;
    }

    /**
     * @param mixed $classModel
     */
    public function setClassModel($classModel)
    {
        if (!class_exists($classModel)) {
            throw new \InvalidArgumentException("Class {$classModel} not exist");
        }
        $this->classModel = $classModel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCacheComponents()
    {
        return $this->cacheComponents;
    }

    /**
     * @param mixed $cacheComponents
     */
    public function setCacheComponents($cacheComponents)
    {
        $this->cacheComponents = $cacheComponents;
        return $this;
    }



}