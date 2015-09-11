<?php
/**
 * DbTestCase.php
 *
 * @package app\tests\codeception\unit
 * @date: 11.09.2015 19:40
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit;


/**
 *  ласс дл€ указани€ настроек модульных тестов
 * Class DbTestCase
 * @package tests\codeception\unit
 */
class DbTestCase extends \yii\codeception\DbTestCase
{
    public $appConfig = "@tests/codeception/config/unit.php";

}