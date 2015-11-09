<?php
/**
 * ProfilerFixture.php
 *
 * @package tests\codeception\unit\fixtures\models\amop\models
 * @date: 09.11.2015 19:50
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\fixtures\models\amop\models;


use yii\test\ActiveFixture;

/**
 * Class ProfilerFixture
 * @package tests\codeception\unit\fixtures\models\amop\models
 */
class ProfilerFixture extends ActiveFixture
{
    /**
     * @var string
     */
    public $modelClass = 'app\models\amop\models\Profiler';
    /**
     * @var string
     */
    public $dataFile = "@tests/codeception/unit/fixtures/data/models/amop/models/Profiler.php";
}