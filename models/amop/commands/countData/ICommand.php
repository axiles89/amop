<?php
/**
 * ICommand.php
 *
 * @package app\models\amop\commands\countData
 * @date: 05.11.2015 22:48
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\commands\countData;


/**
 * Interface ICommand
 * @package app\models\amop\commands\countData
 */
interface ICommand
{
    /**
     * @return mixed
     */
    public function getCount();
}