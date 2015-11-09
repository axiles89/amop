<?php
/**
 * BaseCommand.php
 *
 * @package app\models\amop\commands\countData
 * @date: 05.11.2015 22:52
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\countData;


abstract class BaseCommand implements ICommand
{
    protected $_data;

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        if (is_callable($data)) {
            $this->_data = call_user_func($data);
        } elseif (is_array($data)){
            $this->_data = $data;
        } else {
            throw new \InvalidArgumentException("Data type must be array or closure");
        }

        return $this;
    }

    /**
     * @return mixed
     */
    abstract public function getCount();

}