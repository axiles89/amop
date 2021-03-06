<?php
/**
 * ProfilerActiveDateTest.php
 *
 * @package tests\codeception\unit\models\amop\commands\lastActiveDate
 * @date: 09.11.2015 20:29
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\models\amop\commands\lastActiveDate;


use app\models\amop\commands\LastActiveDate;
use Codeception\Specify;
use yii\codeception\TestCase;

/**
 * Class ProfilerActiveDateTest
 * @package tests\codeception\unit\models\amop\commands\lastActiveDate
 */
class ProfilerActiveDateTest extends TestCase
{
    use Specify;

    /**
     * @Override
     */
    protected function _before()
    {
        parent::_before(); // TODO: Change the autogenerated stub
    }

    /**
     * @Override
     */
    protected function _after()
    {
        parent::_after(); // TODO: Change the autogenerated stub
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function testSave() {

        $this->specifyConfig()
            ->cloneOnly('db', 'components');

        $redisMock = $this->getMockBuilder('\yii\redis\Connection')->setMethods(['executeCommand', 'hset'])->getMock();
        $redisMock->expects($this->any())->method('hset')->will($this->returnValue(1));
        $redisMock->expects($this->any())->method('executeCommand')->will($this->returnValue(1));

        \Yii::$app->set('redis', $redisMock);

        $this->specify("test save ProfilerActiveDate with array", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData([1, 4])
                ->save();

            $this->assertTrue($command, 'test save ProfilerActiveDate with array is broker');
        });

        $this->specify("test save ProfilerActiveDate with int", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData(1)
                ->save();

            $this->assertTrue($command, 'test save ProfilerActiveDate with int is broker');
        });
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function testGet() {
        $this->specifyConfig()
            ->cloneOnly('db', 'components');

        $redisMock = $this->getMockBuilder('\yii\redis\Connection')->setMethods(['executeCommand', 'hget'])->getMock();
        $redisMock->expects($this->any())->method('executeCommand')->will($this->returnCallback(function() {
            return [
                0 => "2013-06-04 12:12:12",
                1 => "2013-06-02 12:12:12"
            ];
        }));

        $redisMock->expects($this->any())->method('hget')->will($this->returnCallback(function() {
            return "2013-06-04 12:12:12";
        }));

        \Yii::$app->set('redis', $redisMock);

        $this->specify("test get ProfilerActiveDate with array", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData([1, 4])
                ->get();

            $result = [
                1 => "2013-06-04 12:12:12",
                4 => "2013-06-02 12:12:12"
            ];

            $this->assertEquals($command, $result, 'test get ProfilerActiveDate with int is broker');
        });

        $this->specify("test get ProfilerActiveDate with int", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData(1)
                ->get();

            $result = [
                1 => "2013-06-04 12:12:12"
            ];

            $this->assertEquals($command, $result, 'test get ProfilerActiveDate with int is broker');
        });
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function testDelete() {
        $this->specifyConfig()
            ->cloneOnly('db', 'components');

        $redisMock = $this->getMockBuilder('\yii\redis\Connection')->setMethods(['executeCommand', 'hdel'])->getMock();
        $redisMock->expects($this->any())->method('hdel')->will($this->returnValue(1));
        $redisMock->expects($this->any())->method('executeCommand')->will($this->returnValue(1));

        \Yii::$app->set('redis', $redisMock);

        $this->specify("test delete ProfilerActiveDate with array", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData([1, 4])
                ->delete();

            $this->assertTrue($command, 'test delete ProfilerActiveDate with array is broker');
        });

        $this->specify("test delete ProfilerActiveDate with int", function() use ($redisMock){
            $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
                ->setData(1)
                ->delete();

            $this->assertTrue($command, 'test delete ProfilerActiveDate with int is broker');
        });
    }

    /**
     * Тестирование проверки обязательных параметров
     */
    public function testSaveException() {
        $this->setExpectedException('InvalidArgumentException');
        $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
            ->setData("ffff")
            ->save();
    }

    /**
     * Тестирование проверки обязательных параметров
     */
    public function testGetException() {
        $this->setExpectedException('InvalidArgumentException');
        $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
            ->setData("ffff")
            ->get();
    }

    /**
     * Тестирование проверки обязательных параметров
     */
    public function testDeleteException() {
        $this->setExpectedException('InvalidArgumentException');
        $command = LastActiveDate::getModel(LastActiveDate::TYPE_PROFILER)->setUserId(1)
            ->setData("ffff")
            ->delete();
    }
}