<?php
/**
 * ICommand.php
 *
 * @package app\models\amop\commands\lastActiveDate
 * @date: 05.11.2015 20:02
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\lastActiveDate;


/**
 * Interface ICommand
 * @package app\models\amop\commands\lastActiveDate
 */
interface ICommand
{
    /**
     * @return mixed
     */
    public function save();

    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function delete();
}