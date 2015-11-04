<?php
/**
 * DeleteProjectDataTest.php
 *
 * @package tests\codeception\unit\components\service\jobs
 * @date: 20.10.2015 19:32
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace tests\codeception\unit\components\service\jobs;


use app\components\service\jobs\DeleteProjectData;
use Codeception\Specify;
use shakura\yii2\gearman\JobWorkload;
use yii\codeception\TestCase;

/**
 * ������������ ������� �������� ������ �� �������
 * Class DeleteProjectDataTest
 * @package tests\codeception\unit\components\service\jobs
 */
class DeleteProjectDataTest extends TestCase
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
     *
     */
    public function testExecute() {

        $workLoad = new JobWorkload();

        $jobMock = $this->getMockBuilder('GearmanJob')->setMethods(['workload', 'sendStatus'])->getMock();
        $jobMock->expects($this->any())->method('workload')->will($this->returnCallback(function() use ($workLoad){

            $id = 'ddd';

            $data = [
                'data' => ['id' => $id]
            ];

            $workLoad->setParams($data);
            return serialize($workLoad);
        }));

        $jobMock->expects($this->any())->method('sendStatus')->will($this->returnCallback(function(){
           return true;
        }));

        $jobBase = new DeleteProjectData();
        $result = $jobBase->execute($jobMock);

        $this->assertFalse($result, 'DeleteProjectData job is broken!');

    }


}