<?php
/**
 * ICommand.php
 *
 * @package app\models\amop\models\ListProfiler\command
 * @date: 21.10.2015 18:24
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\models\amop\models\ListProfiler\command;


/**
 * Interface ICommand
 * @package app\models\amop\models\ListProfiler\command
 */
interface ICommand
{
    /**
     * @return mixed
     */
    public function execute();
}