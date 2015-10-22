<?php
/**
 * DeleteProjectData.php
 *
 * @package app\components\service\jobs
 * @date: 13.10.2015 20:50
 * @author: Kyshnerev Dmitriy <dimkysh@mail.ru>
 */

namespace app\components\service\jobs;

use app\models\amop\models\ListProfiler\command\DeleteProfilerList;
use app\models\amop\models\ListProfiler;
use app\models\amop\models\Profiler;
use GearmanJob;
use shakura\yii2\gearman\JobBase;

/**
 * Воркер удаления всех данных по проекту
 * Class DeleteProjectData
 * @package app\components\service\jobs
 */
class DeleteProjectData extends JobBase
{
    /**
     * @param GearmanJob|null $job
     * @return mixed
     */
    public function execute(GearmanJob $job = null)
    {
        $id = $data = $this->getWorkload($job)->getParams()['data']['id'];

        if (!is_int($id)) {
            $job->sendStatus(400, 400);
            return false;
        }

        ListProfiler::deleteAll(['project_id' => $id]);
        Profiler::deleteAll(['project_id' => $id]);

        // Удаляем данные из кеша по профайлерам проекта
        $command = new DeleteProfilerList();
        $command->setData($id)->execute();

        $job->sendStatus(200, 200);
        return true;
    }

}