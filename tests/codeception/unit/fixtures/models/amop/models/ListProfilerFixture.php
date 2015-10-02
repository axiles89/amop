<?php
/**
 * ListProfilerFixture.php
 *
 * @package tests\codeception\unit\fixtures\models\amop\models
 * @date: 02.10.2015 20:23
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\fixtures\models\amop\models;


use yii\test\ActiveFixture;

/**
 * Class ListProfilerFixture
 * @package tests\codeception\unit\fixtures\models\amop\models
 */
class ListProfilerFixture extends ActiveFixture
{
    public $modelClass = 'app\models\amop\models\ListProfiler';
    public $dataFile = "@tests/codeception/unit/fixtures/data/models/amop/models/ListProfiler.php";
}