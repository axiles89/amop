<?php
/**
 * UserFixture.php
 *
 * @package tests\codeception\unit\fixtures\models\amop\models
 * @date: 11.09.2015 20:02
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\fixtures\models\amop\models;


use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'app\models\amop\models\User';
    public $dataFile = "@tests/codeception/unit/fixtures/data/models/amop/models/User.php";
}