<?php
/**
 * BaseCommand.php
 *
 * @package app\models\amop\commands\lastActiveDate
 * @date: 05.11.2015 20:07
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\lastActiveDate;


/**
 * Class BaseCommand
 * @package app\models\amop\commands\lastActiveDate
 */
abstract class BaseCommand implements ICommand
{
    /**
     * @var string
     */
    protected $_activeDate;

    /**
     * @var
     */
    protected $_data;

    /**
     * @var
     */
    protected $_userId;

    /**
     * BaseCommand constructor.
     * @param $_activeDate
     */
    public function __construct()
    {
        $date = new \DateTime();
        $this->_activeDate = $date->format('Y-m-d H:i:s');
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        if (is_int($userId)) {
            $this->_userId = $userId;
        } else {
            throw new \InvalidArgumentException("userId must type int");
        }
        return $this;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setActiveDate(\DateTime $date) {
        $this->_activeDate = $date->format('yyyy-MM-dd H:m:s');
        return $this;
    }

    /**
     * @return mixed
     */
    abstract public function save();

    /**
     * @return mixed
     */
    abstract public function get();

    /**
     * @return mixed
     */
    abstract public function delete();

}