<?php
/**
 * DeleteProfilerListTest.php
 *
 * @package tests\codeception\unit\models\amop\models\ListProfiler
 * @date: 22.10.2015 16:10
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\models\amop\models\ListProfiler;


use app\models\amop\models\ListProfiler\command\DeleteProfilerList;
use Codeception\Specify;
use yii\codeception\TestCase;

/**
 * ���� ������� �������� ����������� ������� �� ����
 * Class DeleteProfilerListTest
 * @package tests\codeception\unit\models\amop\models\ListProfiler
 */
class DeleteProfilerListTest extends TestCase
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
     * ������������ ���������� ����������
     * @throws \yii\base\InvalidConfigException
     */
    public function testExecute() {

        $this->specifyConfig()
            ->cloneOnly('components');

        $redisMock = $this->getMockBuilder('\yii\redis\Connection')->setMethods(['hdel'])->getMock();
        $redisMock->expects($this->any())->method('hdel')->will($this->returnValue(1));

        \Yii::$app->set('redis', $redisMock);

        $this->specify('test success delete', function() use ($redisMock){
            $command = new DeleteProfilerList();
            $command->setData(1);
            $this->assertEquals(1, $command->execute());
        });
    }

    /**
     * ������������ �������� ������������ ����������
     */
    public function testException() {
        $this->setExpectedException('BadFunctionCallException');
        $command = new DeleteProfilerList();
        $command->setData("ddd");
        $command->execute();
    }

}